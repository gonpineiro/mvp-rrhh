<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SupervisoresExport implements FromView
{
    public function view(): View
    {
        $ODBCdriver = "Driver={Microsoft Visual FoxPro Driver};SourceType=DBC;SourceDB=C:\SAB5\Database\gsm.dbc;Exclusive=No";
        $ODBCuser = "";
        $ODBCpwd = "";
        $inicio_periodo = '03/01/20';
        $fin_periodo = '03/31/20';

        $query_supervisores ="SELECT supe_codi, supe_nomb as name FROM supervisor WHERE supe_esta < 1;";

        $conID = odbc_pconnect($ODBCdriver, $ODBCuser, $ODBCpwd);
        define('supervisores', @odbc_exec($conID, $query_supervisores));
        
        return view('exports.supervisores', [
            'supervisores'=>  supervisores,
        ]);
    }
}
