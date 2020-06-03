<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
        'name' => 'administrador',
        'email' => 'administrador@sab5.com.ar',
        'password' => Hash::make('admin')]);    
        
          //ROLEs
      Role::create(['name'  => 'Admin','slug'  => 'admin','special'  => 'all-access']);  //ADMIN ROLL
      DB::table('role_user')->insert(['role_id' => '1','user_id' => 1]);
      
      DB::table('roles')->insert(['name'  => 'Supervisor operaciones'  ,'slug'  => 'supervisor'   ,'description'  => 'Supervisores operaciones']);
      DB::table('roles')->insert(['name'  => 'Gerente de cuenta'  ,'slug'  => 'gerente.cuente'   ,'description'  => 'Gerente de cuenta']);
      DB::table('roles')->insert(['name'  => 'Recursos humanos'  ,'slug'  => 'Recursos humanos'   ,'description'  => 'Recursos humanos']);
      DB::table('roles')->insert(['name'  => 'Facturación'  ,'slug'  => 'facturacion'   ,'description'  => 'Facturacion']);

      DB::table('permissions')->insert(['name'  => 'Consultar supervisores'  ,'slug'  => 'consultar.supervisor','description'  => 'Consultar Supervisores']);
      //SUPERVISORES
      DB::table('permissions')->insert(['name'  => 'Consultar personal'  ,'slug'  => 'consultar.personal','description'  => 'Consultar personal']);
      DB::table('permissions')->insert(['name'  => 'Reportar personal'  ,'slug'  => 'reportar.personal','description'  => 'Reportar personal']);
      DB::table('permissions')->insert(['name'  => 'Consultar legajo'  ,'slug'  => 'consultar.legajo','description'  => 'Consultar legajo']);
      
      //GERENTES
      DB::table('permissions')->insert(['name'  => 'Consultar personal sup'  ,'slug'  => 'personal.supervisores','description'  => 'Consultar personal sup']);
      DB::table('permissions')->insert(['name'  => 'Consultar asginaciones'  ,'slug'  => 'consultar.asignaciones','description'  => 'Consultar asginaciones']);


      DB::table('permissions')->insert(['name'  => 'RRHH'  ,'slug'  => 'rrhh'   ,'description'  => 'rrhh']);

      DB::table('permissions')->insert(['name'  => 'Facturación'  ,'slug'  => 'facturacion'   ,'description'  => 'facturacion']);

      DB::table('permissions')->insert(['name'  => 'Crear user supervisor'  ,'slug'  => 'crearuser.supervisor','description'  => 'Crear user Supervisor']);

      DB::table('permission_role')->insert(['permission_id'  => 2  ,'role_id'  => 2]);
      DB::table('permission_role')->insert(['permission_id'  => 3  ,'role_id'  => 2]);
      DB::table('permission_role')->insert(['permission_id'  => 4  ,'role_id'  => 2]);
      DB::table('permission_role')->insert(['permission_id'  => 6  ,'role_id'  => 2]);


      DB::table('permission_role')->insert(['permission_id'  => 1  ,'role_id'  => 3]);
      DB::table('permission_role')->insert(['permission_id'  => 2  ,'role_id'  => 3]);
      DB::table('permission_role')->insert(['permission_id'  => 3  ,'role_id'  => 3]);
      DB::table('permission_role')->insert(['permission_id'  => 4  ,'role_id'  => 3]);
      DB::table('permission_role')->insert(['permission_id'  => 5  ,'role_id'  => 3]);
      DB::table('permission_role')->insert(['permission_id'  => 6  ,'role_id'  => 3]);

      DB::table('permission_role')->insert(['permission_id'  => 7  ,'role_id'  => 4]);

      DB::table('permission_role')->insert(['permission_id'  => 8  ,'role_id'  => 5]);


/*       $this->call(UsersSeeder::class);
      $this->call(RolesSeeder::class);
      $this->call(PermissionsSeeder::class);
      $this->call(PermissionRoleSeeder::class); */

    }
}
