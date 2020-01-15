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
      DB::table('users')->insert(['name' => 'administrador','email' => 'administrador@sab5.com.ar','password' => '$2y$10$6gJTsnUyPc8XJ7J/C1f14euqL1pgDKnQt8xzPkNbkgZo53syKl3aK']);
      Role::create(['name'  => 'Admin','slug'  => 'admin','special'  => 'all-access']);  //ADMIN ROLL
      DB::table('role_user')->insert(['role_id' => '1','user_id' => 1]);

      //ROLEs
      DB::table('roles')->insert(['name'  => 'Supervisor'  ,'slug'  => 'supervisor'   ,'description'  => 'Supervisores']);
      DB::table('roles')->insert(['name'  => 'RRHH'  ,'slug'  => 'rrhh'   ,'description'  => 'RRHH']);
      DB::table('roles')->insert(['name'  => 'Facturación'  ,'slug'  => 'facturacion'   ,'description'  => 'Facturacion']);

      DB::table('permissions')->insert(['name'  => 'Supervisor'  ,'slug'  => 'supervisor'   ,'description'  => 'Supervisores']);
      DB::table('permissions')->insert(['name'  => 'RRHH'  ,'slug'  => 'rrhh'   ,'description'  => 'rrhh']);
      DB::table('permissions')->insert(['name'  => 'Facturación'  ,'slug'  => 'facturacion'   ,'description'  => 'facturacion']);

      DB::table('permission_role')->insert(['permission_id'  => 1  ,'role_id'  => 2]);
      DB::table('permission_role')->insert(['permission_id'  => 2  ,'role_id'  => 3]);
      DB::table('permission_role')->insert(['permission_id'  => 3  ,'role_id'  => 4]);

    }
}
