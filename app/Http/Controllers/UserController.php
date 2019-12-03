<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;

use app\User;



class UserController extends Controller
{

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
      if (!is_null($request->input('password'))) {  $onlyUser->password = Hash::make($request->input('password'));  }
      $onlyUser->email = $request->input('email');
      $onlyUser->save();

      $onlyUser->roles()->sync($request->input('role'));

      return redirect('/users/');
    }

    public function showSupusers(Request $request){
      $user = User::all();
      $role = Role::all();
      $ver = "agregar";
      return view('administracion.users.supervisores', [
        'users' => $user,
        'roles' => $role,
        'ver' => $ver,
      ]);

    }

  private function findByIdUser($id){
      return User::where('id', $id)->firstOrFail();
  }
}
