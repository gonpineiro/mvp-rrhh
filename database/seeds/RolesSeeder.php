<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //ROLEs
      Role::create(['name'  => 'Admin','slug'  => 'admin','special'  => 'all-access']);  //ADMIN ROLL
      DB::table('role_user')->insert(['role_id' => '1','user_id' => 1]);
      
      DB::table('roles')->insert(['name'  => 'Supervisor operaciones'  ,'slug'  => 'supervisor'   ,'description'  => 'Supervisores operaciones']);
      DB::table('roles')->insert(['name'  => 'Gerente de cuenta'  ,'slug'  => 'gerente.cuente'   ,'description'  => 'Gerente de cuenta']);
      DB::table('roles')->insert(['name'  => 'RRHH'  ,'slug'  => 'rrhh'   ,'description'  => 'RRHH']);
      DB::table('roles')->insert(['name'  => 'Facturación'  ,'slug'  => 'facturacion'   ,'description'  => 'Facturacion']);
    }
}
