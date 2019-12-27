<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Rrhhreport;
use Alert;

class SupervisorController extends Controller
{
    public $ODBCdriver, $ODBCuser, $ODBCpwd;

    public function __construct(){
      $this->ODBCdriver = "Driver={Microsoft Visual FoxPro Driver};SourceType=DBC;SourceDB=C:\SAB5\Database\gsm.dbc;Exclusive=No";
      $this->ODBCuser = "";
      $this->ODBCpwd = "";
    }

    public function showSupusers(Request $request){

      $ODBCdriver = $this->ODBCdriver;
      $ODBCuser = $this->ODBCuser;
      $ODBCpwd = $this->ODBCpwd;

      $query_supervisores ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_esta < 1;";

      // $query_supervisores =
      // "SELECT supervisor.supe_codi, supervisor.supe_nomb as name, personal.pers_lega as legajo, empresas.empr_nomb
      // FROM supervisor
      // INNER JOIN personal ON supervisor.supe_nomb = personal.pers_nomb
      // INNER JOIN empresas ON personal.pers_empr = empresas.empr_codi
      // WHERE supervisor.supe_esta <= 1;";

      //$query_supervisores = "SELECT supervisor.supe_codi, supervisor.supe_nomb as name, personal.pers_lega as legajo FROM personal LEFT JOIN supervisor ON personal.pers_supe = supervisor.supe_codi WHERE supe_esta <= 1;";

      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('supervisores', @odbc_exec($conID, $query_supervisores));
      if (supervisores === false) die("Error en query: " . odbc_errormsg($conID));

      return view('administracion.supervisors.supervisores', [
        'supervisores'=> supervisores,
        ]);
      }

    public function addSupuser($id, Request $request){

      $ODBCdriver = $this->ODBCdriver;
      $ODBCuser = $this->ODBCuser;
      $ODBCpwd = $this->ODBCpwd;

      $query_sup ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_codi = '$id';";

      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) {print("No se pudo establecer la conexión!");exit();}
      define ('sup', @odbc_exec($conID, $query_sup));
      if (sup === false) die("Error en query: " . odbc_errormsg($conID));
      $onlySup = odbc_fetch_array(sup);
      //dd($onlySup);

      $user = User::all();
      $ver = "agregar-sup";

        return view('administracion.users.users', [
            'users' => $user,
            'onlySup' => $onlySup,
            'ver' => $ver,
        ]);
    }

    public function showVigs($id, Request $request){

      $ODBCdriver = $this->ODBCdriver;
      $ODBCuser = $this->ODBCuser;
      $ODBCpwd = $this->ODBCpwd;

      $query_vigs = "SELECT pers_codi, pers_lega as legajo ,pers_nomb as name FROM personal WHERE pers_supe = '$id' AND EMPTY(pers_fegr)";
      $query_sup ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_codi = '$id';";

      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('vigs', @odbc_exec($conID, $query_vigs));
      define ('sup', @odbc_exec($conID, $query_sup));
      if (vigs === false) die("Error en query: " . odbc_errormsg($conID));
      if (sup === false) die("Error en query: " . odbc_errormsg($conID));
      $sup = odbc_fetch_array(sup);
      $vigReports = NULL;
      return view('administracion.supervisors.vigiporsupervisor', [
        'vigs'=> vigs,
        'sup'=> $sup,
        'vigReports'=> $vigReports,
      ]);
    }

    public function showVigssup(Request $request){

      $user = $request->user();

      $ODBCdriver = $this->ODBCdriver;
      $ODBCuser = $this->ODBCuser;
      $ODBCpwd = $this->ODBCpwd;

      $query_vigs = "SELECT pers_codi, pers_lega as legajo ,pers_nomb as name FROM personal WHERE pers_supe = ' $user->supe_codi' AND EMPTY(pers_fegr)";
      // $query_sup ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_codi = '$user->supe_codi';";

      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('vigs', @odbc_exec($conID, $query_vigs));
      // define ('sup', @odbc_exec($conID, $query_sup));
      if (vigs === false) die("Error en query: " . odbc_errormsg($conID));
      // if (sup === false) die("Error en query: " . odbc_errormsg($conID));
      // $sup = odbc_fetch_array(sup);
      $vigReports = Rrhhreport::where('user_id', $user->id)->where('estado', 1)->get();
      // dd($vigReports);

      return view('administracion.supervisors.vigiporsupervisor', [
        'vigs'=> vigs,
        // 'sup'=> $sup,
        'vigReports' => $vigReports,
      ]);
    }

    public function createSupuser(Request $request){
          //dd($request->input('supe_codi'));
          $user = User::create([
          'name' => $request->input('sup_name'),
          'supe_codi' => $request->input('supe_codi'),
          //'supe_legajo' => $request->input('supe_legajo'),
          'email' =>$request->input('email'),
          'password' => Hash::make($request->input('password')),
          ]);

          $user->roles()->sync(2);


      return redirect('/users');
    }

    public function reportVig($id, $comentario_sup, Request $request){
        // dd($a);
      $ODBCdriver = $this->ODBCdriver;
      $ODBCuser = $this->ODBCuser;
      $ODBCpwd = $this->ODBCpwd;

      $user = $request->user();

      $query_vig = "SELECT pers_nomb, pers_codi, pers_lega, pers_supe FROM personal WHERE pers_codi = $id ";
      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) {print("No se pudo establecer la conexión!");exit();}
      define ('vig', @odbc_exec($conID, $query_vig));
      if (vig === false) die("Error en query: " . odbc_errormsg($conID));
      $onlyVig = odbc_fetch_array(vig);
      //dd($onlySup);
      if ($onlyVig['pers_supe'] != $user->supe_codi) {return redirect('/show_vigs_sup');}

      $rrhh_report = Rrhhreport::create([
        'user_id' => $user->id,
        'pers_nomb' => $onlyVig['pers_nomb'],
        'pers_codi' => $onlyVig['pers_codi'],
        'pers_lega' => $onlyVig['pers_lega'],
        'pers_supe' => $onlyVig['pers_supe'],
        'comentario_sup' => $comentario_sup,
        'estado' => 1,        //REPORTE SOLICITADO
      ]);

      return redirect('/show_vigs_sup');

    }

    public function showReportvig(Request $request){

      $user = $request->user();

      $rrhhreport = Rrhhreport::where('user_id', $user->id )->orderBy('id', 'DESC')->get();
      return view('administracion.supervisors.vigireports', [
        'rrhhreports'=> $rrhhreport,
      ]);
    }

    public function changeEstatesup($id, Request $request){
      $onlyRrhhreport = $this->findByIdURrhhreport($id);
      $user = $request->user();
      if ($onlyRrhhreport->user_id != $user->id) {return redirect('/');}
      $onlyRrhhreport->estado = 0;
      $onlyRrhhreport->save();

      return redirect('/show_vigs_sup/reports/');
    }

  private function findByIdURrhhreport($id){
      return Rrhhreport::where('id', $id)->firstOrFail();
  }
}
