<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Hash;

use app\User;

class UserController extends Controller
{
    public $ODBCdriver, $user, $pwd;

    public function __construct(){
      $this->ODBCdriver = "Driver={Microsoft Visual FoxPro Driver};SourceType=DBC;SourceDB=C:\SAB5\Database\gsm.dbc;Exclusive=No";
      $this->user = "";
      $this->pwd = "";
    }

    public function showUsers(Request $request){
      $user = User::all();
      $role = Role::all();
      $ver = "agregar";
      return view('administracion.users.users', [
        'users' => $user,
        'roles' => $role,
        'ver' => $ver,
      ]);

    }

    public function createUser(Request $request){

          $user = User::create([
          'name' => $request->input('name'),
          'email' =>$request->input('email'),
          'password' => Hash::make($request->input('password')),
          ]);

          $user->roles()->sync($request->input('role'));


      return redirect('/users');
    }

    public function editUser($id, Request $request){
      $user = User::all();
      $onlyUser = $this->findByIdUser($id);
      $rol = $onlyUser->roles[0];
      $role = Role::all();
      $ver = "editar";

        return view('administracion.users.users', [
            'users' => $user,
            'onlyUser' => $onlyUser,
            'roles' => $role,
            'ver' => $ver,
            'rol' => $rol,
        ]);

    }

    public function updateUser($id, Request $request){

        $onlyUser = $this->findByIdUser($id);
        $onlyUser->name = $request->input('name');
        if (!is_null($request->input('password'))) { $onlyUser->password = Hash::make($request->input('password'));  }
        $onlyUser->email = $request->input('email');
        $onlyUser->save();

        $onlyUser->roles()->sync($request->input('role'));

        return redirect('/users/');
      }

    public function showSupusers(Request $request){

      $ODBCdriver = $this->ODBCdriver;
      $user = $this->user;
      $pwd = $this->pwd;

      $query_supervisores ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_esta < 1;";

      // $query_supervisores =
      // "SELECT supervisor.supe_codi, supervisor.supe_nomb as name, personal.pers_lega as legajo, empresas.empr_nomb
      // FROM supervisor
      // INNER JOIN personal ON supervisor.supe_nomb = personal.pers_nomb
      // INNER JOIN empresas ON personal.pers_empr = empresas.empr_codi
      // WHERE supervisor.supe_esta <= 1;";

      //$query_supervisores = "SELECT supervisor.supe_codi, supervisor.supe_nomb as name, personal.pers_lega as legajo FROM personal LEFT JOIN supervisor ON personal.pers_supe = supervisor.supe_codi WHERE supe_esta <= 1;";

      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$user,$pwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('supervisores', @odbc_exec($conID, $query_supervisores));
      if (supervisores === false) die("Error en query: " . odbc_errormsg($conID));

      return view('administracion.users.supervisores', [
        'supervisores'=> supervisores,
      ]);
    }

    public function showVigs($id, Request $request){

      $ODBCdriver = $this->ODBCdriver;
      $user = $this->user;
      $pwd = $this->pwd;

      $query_vigs = "SELECT pers_codi, pers_lega as legajo ,pers_nomb as name FROM personal WHERE pers_supe = '$id' AND EMPTY(pers_fegr)";
      $query_sup ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_codi = '$id';";

      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$user,$pwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('vigs', @odbc_exec($conID, $query_vigs));
      define ('sup', @odbc_exec($conID, $query_sup));
      if (vigs === false) die("Error en query: " . odbc_errormsg($conID));
      if (sup === false) die("Error en query: " . odbc_errormsg($conID));
      $sup = odbc_fetch_array(sup);

      return view('administracion.users.vigiporsupervisor', [
        'vigs'=> vigs,
        'sup'=> $sup,
      ]);
    }

    public function addSupuser($id, Request $request){

      $ODBCdriver = $this->ODBCdriver;
      $user = $this->user;
      $pwd = $this->pwd;

      $query_sup ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_codi = '$id';";

      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$user,$pwd);
      if(!$conID) {print("No se pudo establecer la conexión!");exit();}
      define ('sup', @odbc_exec($conID, $query_sup));
      if (sup === false) die("Error en query: " . odbc_errormsg($conID));
      $onlySup = odbc_fetch_array(sup);
      //dd($onlySup);

      $user = User::all();
      $ver = "editar";

        return view('administracion.users.users', [
            'users' => $user,
            'onlySup' => $onlySup,
            'ver' => $ver,
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

          $user->persmissions()->sync(1);


      return redirect('/users');
    }

    public function showVigssup(Request $request){

      $user = $request->user();
      $id = $user->supe_codi;

      $ODBCdriver = $this->ODBCdriver;
      $user = $this->user;
      $pwd = $this->pwd;

      $query_vigs = "SELECT pers_codi, pers_lega as legajo ,pers_nomb as name FROM personal WHERE pers_supe = ' $id' AND EMPTY(pers_fegr)";
      $query_sup ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_codi = '$id';";

      //CONEXION Y OBTENCION DE DATOS
      $conID = odbc_pconnect($ODBCdriver,$user,$pwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('vigs', @odbc_exec($conID, $query_vigs));
      define ('sup', @odbc_exec($conID, $query_sup));
      if (vigs === false) die("Error en query: " . odbc_errormsg($conID));
      if (sup === false) die("Error en query: " . odbc_errormsg($conID));
      $sup = odbc_fetch_array(sup);

      return view('administracion.users.vigiporsupervisor', [
        'vigs'=> vigs,
        'sup'=> $sup,
      ]);
    }

    private function findByIdUser($id){
        return User::where('id', $id)->firstOrFail();
    }

    function limpia_get($cadena){
      $cadena = str_replace('%20', ' ', $cadena);
      return $cadena;
    }
}
