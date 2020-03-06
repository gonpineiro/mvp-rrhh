<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use App\Charts\PieChart;
use Carbon\Carbon;

use App\User;
use Alert;

class FacturacionController extends Controller
{


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

      //CONEXION CON BBDD OBDC
      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}

      //PUESTOS PENDIENTES A FACTURAR AGRUPADOS POR CLIENTE
      $query_fac = "SELECT
      asig_obje as id,
      objetivo.obje_nomb as cliente,
      count(DISTINCT asig_pues) as total
      FROM asigvigi
      INNER JOIN objetivo ON objetivo.obje_codi = asigvigi.asig_obje
      WHERE asig_esta < 3 AND EMPTY (asig_fact) AND asig_fech BETWEEN {01/01/20} AND {01/31/20}
      GROUP BY cliente;";

      define ('pendientes', @odbc_exec($conID, $query_fac));
      if (pendientes === false) die("Error en query: " . odbc_errormsg($conID));

      //CANTIDAD DE PUESTOS FACTURADOS
      $query_cant_fac = "SELECT count(DISTINCT asig_pues) as cantidad_asig FROM asigvigi WHERE asig_esta = 3 AND NOT EMPTY (asig_fact) AND asig_fech BETWEEN {02/01/20} AND {02/29/20}";
      define ('cantidad_fac', @odbc_exec($conID, $query_cant_fac));
      if (cantidad_fac === false) die("Error en query: " . odbc_errormsg($conID));
      //CANTIDAD DE PUESTOS NO FACTURADOS
      $query_cant_no_fac = "SELECT count(DISTINCT asig_pues) as cantidad_asig FROM asigvigi WHERE asig_esta < 3 AND EMPTY (asig_fact) AND asig_fech BETWEEN {02/01/20} AND {02/29/20}";
      define ('cantidad_no_fac', @odbc_exec($conID, $query_cant_no_fac));
      if (cantidad_no_fac === false) die("Error en query: " . odbc_errormsg($conID));
      //CANTIDAD DE CLIENTES NO FACTURADOS
      $query_cant_no_fac_cli = "SELECT count(DISTINCT asig_obje) as cantidad_asig FROM asigvigi WHERE asig_esta < 3 AND EMPTY (asig_fact) AND asig_fech BETWEEN {02/01/20} AND {02/29/20}";
      define ('cantidad_no_fac_cli', @odbc_exec($conID, $query_cant_no_fac_cli));
      if (cantidad_no_fac_cli === false) die("Error en query: " . odbc_errormsg($conID));
      //CANTIDAD DE CLIENTES
      $query_cant_cli = "SELECT count(DISTINCT asig_obje) as cantidad_asig FROM asigvigi WHERE asig_fech BETWEEN {02/01/20} AND {02/29/20}";
      define ('cantidad_cli', @odbc_exec($conID, $query_cant_cli));
      if (cantidad_cli === false) die("Error en query: " . odbc_errormsg($conID));

       $puestosFac = (int)odbc_fetch_array(cantidad_fac)['cantidad_asig'];
       $puestosNofac = (int)odbc_fetch_array(cantidad_no_fac)['cantidad_asig'];
       $cantidadPuestos = $puestosFac + $puestosNofac;

       $cantidadClientes = (int)odbc_fetch_array(cantidad_cli)['cantidad_asig'];
       $clientesNofac = (int)odbc_fetch_array(cantidad_no_fac_cli)['cantidad_asig'];
       $clientesfac = $cantidadClientes - $clientesNofac;

      //GRAFICO DE PUESTOS
      $puestoChart = new PieChart;
      $puestoChart->labels(["Facturado: $puestosFac / $cantidadPuestos", "No facturado: $puestosNofac / $cantidadPuestos"])
            ->dataset('PIE', 'pie', [$puestosFac,$puestosNofac])
            ->backgroundcolor(["rgb(15, 50, 170)","rgb(185, 15, 20)"]);
      //GRAFICO DE CLIENTES
      $clienteChart = new PieChart;
      $clienteChart->labels(["Facturado: $clientesfac", "No facturado: $clientesNofac"])
            ->dataset('PIE', 'pie', [$clientesfac, $clientesNofac])
            ->backgroundcolor(["rgb(15, 50, 170)","rgb(185, 15, 20)"]);

      return view('administracion.facturacion.pendiente', [
        'pendientes'=> pendientes,
        'puestoChart' => $puestoChart,
        'clienteChart' => $clienteChart,
        'cantidadClientes' => $cantidadClientes,
        'cantidadPuestos' => $cantidadPuestos,
        ]);
    }

    public function showPendientecliente($id, Request $request){
      $ODBCdriver = $this->ODBCdriver;
      $ODBCuser = $this->ODBCuser;
      $ODBCpwd = $this->ODBCpwd;

      $user = $request->user();

      $conID = odbc_pconnect($ODBCdriver,$ODBCuser,$ODBCpwd);
      if(!$conID) { print("No se pudo establecer la conexión!");exit();}

      $query_fac = "SELECT
      pues_codi,
      objetivo.obje_nomb as cliente,
      puestos.pues_nomb as puesto,
      count(pues_codi) as cantidad_asig,
      puestos.pues_dhor as desde,
      puestos.pues_hhor as hasta,
      asig_dhor,
      asig_hhor,
      CONVERT (varchar, asig_dhor, 103) as dhor,
      CONVERT (varchar, asig_dhor, 103) as hhor
      FROM asigvigi
      INNER JOIN objetivo ON objetivo.obje_codi = asigvigi.asig_obje
      INNER JOIN puestos ON puestos.pues_codi = asigvigi.asig_pues
      WHERE asig_esta < 3 AND EMPTY (asig_fact) AND asig_fech BETWEEN {01/01/20} AND {01/31/20} AND asig_obje = $id
      GROUP BY pues_codi;";

      // $query_fac = "SELECT
      // pues_codi,
      // objetivo.obje_nomb as cliente,
      // puestos.pues_nomb as puesto,
      // count(pues_codi) as cantidad_asig,
      // puestos.pues_dhor as desde,
      // puestos.pues_hhor as hasta
      // FROM asigvigi
      // INNER JOIN objetivo ON objetivo.obje_codi = asigvigi.asig_obje
      // INNER JOIN puestos ON puestos.pues_codi = asigvigi.asig_pues
      // WHERE asig_esta < 3 AND EMPTY (asig_fact) AND asig_fech BETWEEN {01/01/20} AND {01/31/20} AND asig_obje = $id
      // GROUP BY pues_codi;";


      define ('pendientes', @odbc_exec($conID, $query_fac));
      if (pendientes === false) die("Error en query: " . odbc_errormsg($conID));

      $query_cliente = "SELECT obje_nomb as cliente FROM objetivo WHERE obje_codi = $id;";

      define ('cliente', @odbc_exec($conID, $query_cliente));
      if (cliente === false) die("Error en query: " . odbc_errormsg($conID));
      $cliente = odbc_fetch_array(cliente);
      // dd(facturas);
      return view('administracion.facturacion.pendiente_cliente', [
        'pendientes'=> pendientes,
        'cliente'=> $cliente,
        ]);
    }
}
