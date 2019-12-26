<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\User;
use App\Rrhhreport;

class RrhhController extends Controller
{

    public function showReportvig(Request $request){

      $user = $request->user();

      $rrhhreport = Rrhhreport::orderBy('id', 'DESC')->get();
      return view('administracion.rrhh.vigireports', [
        'rrhhreports'=> $rrhhreport,
      ]);
  }
}
