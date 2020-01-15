<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

use App\User;
use Alert;

class FacturacionController extends Controller
{
    public $ODBCdriver, $ODBCuser, $ODBCpwd;

    public function __construct(){
      $this->ODBCdriver = "Driver={Microsoft Visual FoxPro Driver};SourceType=DBC;SourceDB=C:\SAB5\Database\gsm.dbc;Exclusive=No";
      $this->ODBCuser = "";
      $this->ODBCpwd = "";
    }

    public function showEstadofacturacion(Request $request){
      $ODBCdriver = $this->ODBCdriver;
      $ODBCuser = $this->ODBCuser;
      $ODBCpwd = $this->ODBCpwd;

      $user = $request->user();

      $query_fac ="SELECT fact_obje as cliente, fact_empr as empresa, fact_dfec as fecha, sum(fact_can1) as cantidad_uno, fact_prof as proforma, fact_time as tiempo FROM factvigi WHERE fact_tango = 0 GROUP BY proforma;";

      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('facturas', @odbc_exec($conID, $query_fac));
      if (facturas === false) die("Error en query: " . odbc_errormsg($conID));

      return view('administracion.facturacion.estado', [
        'facturas'=> facturas,
        ]);
    }
}
