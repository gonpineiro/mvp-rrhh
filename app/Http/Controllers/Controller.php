<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $ODBCdriver, $ODBCuser, $ODBCpwd, $inicio_periodo, $fin_periodo;

    public function __construct(){
      $this->ODBCdriver = "Driver={Microsoft Visual FoxPro Driver};SourceType=DBC;SourceDB=Y:\gsm.dbc;Exclusive=No";
      $this->ODBCuser = "";
      $this->ODBCpwd = "";
      $this->inicio_periodo = '06/01/20';
      $this->fin_periodo = '06/30/20';
    }
}
