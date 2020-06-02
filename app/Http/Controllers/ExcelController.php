<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SupervisoresExport;
use App\Exports\VigsSupervisorExport;
use App\Exports\EstadoFacturacionExport;
use App\Exports\AsignacionExport;

class ExcelController extends Controller
{
    public function showSupusers(Request $request)
    {
        $ODBCdriver = $this->ODBCdriver;
        $ODBCuser = $this->ODBCuser;
        $ODBCpwd = $this->ODBCpwd;

        $query_supervisores ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_esta < 1;";

        $conID = odbc_pconnect($ODBCdriver, $ODBCuser, $ODBCpwd);
        define('supervisores', @odbc_exec($conID, $query_supervisores));
        
        return Excel::download(new SupervisoresExport(supervisores), 'supervisores.xlsx');
    }

    public function showGerentePersonal($id, Request $request)
    {
        $ODBCdriver = $this->ODBCdriver;
        $ODBCuser = $this->ODBCuser;
        $ODBCpwd = $this->ODBCpwd;

        $query_vigs = "SELECT pers_codi, pers_lega as legajo ,pers_nomb as name FROM personal WHERE pers_supe = '$id' AND EMPTY(pers_fegr)";

        $conID = odbc_pconnect($ODBCdriver, $ODBCuser, $ODBCpwd);
        define('vigs', @odbc_exec($conID, $query_vigs));
        
        return Excel::download(new VigsSupervisorExport(vigs), 'personal.xlsx');
    }

    public function showEstadofacturacion(Request $request)
    {
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
  
        $conID = odbc_pconnect($ODBCdriver, $ODBCuser, $ODBCpwd);
        if (!$conID) {
            print("No se pudo establecer la conexión!");
            exit();
        }
        define('facturas', @odbc_exec($conID, $query_fac));
        if (facturas === false) {
            die("Error en query: " . odbc_errormsg($conID));
        }
  
        return Excel::download(new EstadoFacturacionExport(facturas), 'estadoFacturacion.xlsx');
    }

    

    public function showAsignacionesPersonal($id, Request $request)
    {
        $ODBCdriver = $this->ODBCdriver;
        $ODBCuser = $this->ODBCuser;
        $ODBCpwd = $this->ODBCpwd;

        //GENERAR UN PERIODO DE 30 DIAS DESDE LA FECHA
        $date_now = date('d-m-Y');
        $date_resta = strtotime('-30 day', strtotime($date_now));
        $date_inicio = date('m-d-Y', $date_resta);
        $date_fin = date('m-d-Y', strtotime($date_now));

        $query_asignaciones =
        "SELECT
        asig_fech as fecha,
        asig_dhor as desde,
        asig_hhor as hasta,
        asig_time as horario,
        puestos.pues_nomb as puesto,
        puestos.pues_nomb as puesto,  
        objetivo.obje_nomb as objetivo
        FROM asigvigi     
        INNER JOIN objetivo ON objetivo.obje_codi = asigvigi.asig_obje  
        INNER JOIN puestos ON puestos.pues_codi = asigvigi.asig_pues  
        WHERE 
        asig_fech BETWEEN { $date_inicio } AND { $date_fin } 
        AND asig_vigi = $id";

        //CONEXION Y OBTENCION DE DATOS
        $conID = odbc_pconnect($ODBCdriver, $ODBCuser, $ODBCpwd);
        if (!$conID) {
            print("No se pudo establecer la conexión!");
            exit();
        }

        define('asignaciones', @odbc_exec($conID, $query_asignaciones));
        if (asignaciones === false) {
            die("Error en query: " . odbc_errormsg($conID));
        }
  
        return Excel::download(new AsignacionExport(asignaciones), 'asignaciones.xlsx');
    }
}
