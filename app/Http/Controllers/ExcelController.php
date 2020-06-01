<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SupervisoresExport;
use App\Exports\VigsSupervisorExport;

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
}
