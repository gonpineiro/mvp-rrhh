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

      $role = Role::all();
        return view('administracion.users.users', [
            'users' => $user,
            'onlySup' => $onlySup,
            'ver' => $ver,
            'roles' => $role,
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

    public function showGerentePersonal($id, Request $request){

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
      return view('administracion.supervisors.gerentepersonal', [
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
        'vigReports' => $vigReports,
      ]);
    }

    public function createSupuser(Request $request){
          $user = User::create([
          'name' => $request->input('sup_name'),
          'supe_codi' => $request->input('supe_codi'),
          'email' =>$request->input('email'),
          'password' => Hash::make($request->input('password')),
          ]);

          $user->roles()->sync($request->input('role'));


      return redirect('/users');
    }

    public function reportVig($id, $comentario_sup, Request $request){
      //dd($comentario_sup);
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

  public function showOnlyVig($id, Request $request){

    $ODBCdriver = $this->ODBCdriver;
    $ODBCuser = $this->ODBCuser;
    $ODBCpwd = $this->ODBCpwd;

    $query_all = "SELECT * FROM personal WHERE pers_codi = $id";

    $query_personal = 
    "SELECT 
    pers_codi as id, 
    pers_lega as legajo,
    pers_nomb as name,
    pers_domi as domicilio,
    pers_loca as localidad,
    provinci.prov_nomb as provincia,
    pers_copo as cp,
    zonas.zona_nomb as zona,    
    paises.pais_nomb as nacionalidad,
    pers_telc as phone_fijo,
    pers_movp as phone_movil,
    pers_ndoc as ndoc,
    pers_fnac as fecha_nac,
    pers_lugn as lugar_nac,
    pers_cuil as cuil,
    pers_fing as fecha_ingreso,
    pers_fegr as fecha_egreso,
    pers_frei as fecha_reincidencia,
    pers_fant as fecha_antecedentes,
    bancos.banc_nomb as banco,
    pers_cur as cur,
    pers_obra as obra_social,
    supervisor.supe_nomb as name_supe,
    empresas.empr_nomb as empresa,
    categori.cate_nomb as categoria
    FROM personal 
    INNER JOIN provinci ON provinci.prov_codi = personal.pers_prov
    INNER JOIN zonas ON zonas.zona_codi = personal.pers_zona
    INNER JOIN paises ON paises.pais_codi = personal.pers_naci
    INNER JOIN bancos ON bancos.banc_codi = personal.pers_banc
    INNER JOIN supervisor ON supervisor.supe_codi = personal.pers_supe
    INNER JOIN empresas ON empresas.empr_codi = personal.pers_empr
    INNER JOIN categori ON categori.cate_codi = personal.pers_cate
    WHERE pers_codi = $id";
    //$query_sup ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_codi = '$id';";

    //CONEXION Y OBTENCION DE DATOS
    $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
    if(!$conID) { print("No se pudo establecer la conexión!");exit();}

    define ('personal', @odbc_exec($conID, $query_personal));
    if (personal === false) die("Error en query: " . odbc_errormsg($conID));

    define ('all', @odbc_exec($conID, $query_all));
    if (personal === false) die("Error en query: " . odbc_errormsg($conID));
   
    $personal = odbc_fetch_array(personal);
    //dd($personal);
   
    $all = odbc_fetch_array(all);
    //dd($all);


    return view('administracion.personal.legajo', [
      'personal'=> $personal,
    ]);
  }

  public function showAsignacionesPersonal($id, Request $request){

    $ODBCdriver = $this->ODBCdriver;
    $ODBCuser = $this->ODBCuser;
    $ODBCpwd = $this->ODBCpwd;

    //GENERAR UN PERIODO DE 30 DIAS DESDE LA FECHA
    $date_now = date('d-m-Y');    
    $date_resta = strtotime('-30 day', strtotime($date_now));
    $date_inicio = date('m-d-Y', $date_resta);
    $date_fin = date('m-d-Y', strtotime($date_now));

    $query_asignaciones = 
    "SELECT
    asig_fech as fecha,
    asig_dhor as desde,
    asig_hhor as hasta,
    asig_time as horario,
    puestos.pues_nomb as puesto,
    puestos.pues_nomb as puesto,  
    objetivo.obje_nomb as objetivo
    FROM asigvigi     
    INNER JOIN objetivo ON objetivo.obje_codi = asigvigi.asig_obje  
    INNER JOIN puestos ON puestos.pues_codi = asigvigi.asig_pues  
    WHERE 
    asig_fech BETWEEN { $date_inicio } AND { $date_fin } 
    AND asig_vigi = $id";

    //CONEXION Y OBTENCION DE DATOS
    $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
    if(!$conID) { print("No se pudo establecer la conexión!");exit();}

    define ('asignaciones', @odbc_exec($conID, $query_asignaciones));
    if (asignaciones === false) die("Error en query: " . odbc_errormsg($conID));
    
    //$asignaciones = odbc_fetch_array(asignaciones);
    //dd($asignaciones);

    return view('administracion.personal.asignaciones', [
      'asignaciones'=> asignaciones,
    ]);
  }
}
