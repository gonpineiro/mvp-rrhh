<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
