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

      $query_fac =
       "SELECT
       objetivo.obje_nomb as cliente,
       empresas.empr_nomb as empresa,
       fact_dfec as fecha,
       sum(fact_can1) as cantidad_uno,
       fact_prof as proforma,
       fact_time as tiempo
       FROM factvigi
       INNER JOIN empresas ON empresas.empr_codi = factvigi.fact_empr
       INNER JOIN objetivo ON objetivo.obje_codi = factvigi.fact_obje
       WHERE fact_tango = 0
       GROUP BY proforma;";

      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('facturas', @odbc_exec($conID, $query_fac));
      if (facturas === false) die("Error en query: " . odbc_errormsg($conID));

      return view('administracion.facturacion.estado', [
        'facturas'=> facturas,
        ]);
    }

    public function showPendientefacturacion(Request $request){
      $ODBCdriver = $this->ODBCdriver;
      $ODBCuser = $this->ODBCuser;
      $ODBCpwd = $this->ODBCpwd;

      $user = $request->user();

      $query_fac = "SELECT
      objetivo.obje_nomb as cliente,
      count(DISTINCT asig_pues) as total
      FROM asigvigi
      INNER JOIN objetivo ON objetivo.obje_codi = asigvigi.asig_obje
      WHERE asig_esta < 3 AND EMPTY (asig_fact) AND asig_fech BETWEEN {12/01/19} AND {12/31/19}
      GROUP BY cliente;";
      // $query_fac =
      // "SELECT asig_obje as cliente
      //  FROM asigvigi WHERE asig_esta < 3 GROUP BY cliente;";

      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}
      define ('pendientes', @odbc_exec($conID, $query_fac));
      if (pendientes === false) die("Error en query: " . odbc_errormsg($conID));

      // dd(facturas);
      return view('administracion.facturacion.pendiente', [
        'pendientes'=> pendientes,
        ]);
    }
}
