<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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

    public function editSupuser($id, Request $request){
      $user = User::all();
      $onlySup = $this->findByIdUser($id);
      // $rol = $onlyUser->roles[0];
      // $role = Role::all();
      $ver = "editar-sup";

        return view('administracion.users.users', [
            'users' => $user,
            'onlySup' => $onlySup,
            // 'roles' => $role,
            'ver' => $ver,
            // 'rol' => $rol,
        ]);

    }

    public function updateUser($id, Request $request){

        $onlyUser = $this->findByIdUser($id);
        $onlyUser->name = $request->input('name');
        if (!is_null($request->input('password'))) { $onlyUser->password = Hash::make($request->input('password'));  }
        $onlyUser->email = $request->input('email');
        $onlyUser->supe_codi = $request->input('supe_codi');
        $onlyUser->supe_legajo = $request->input('supe_legajo');
        $onlyUser->save();

        $onlyUser->roles()->sync($request->input('role'));

        return redirect('/users/');
      }

    private function findByIdUser($id){
        return User::where('id', $id)->firstOrFail();
    }

    function limpia_get($cadena){
      $cadena = str_replace('%20', ' ', $cadena);
      return $cadena;
    }
}
