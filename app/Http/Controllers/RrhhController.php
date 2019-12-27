<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Rrhhreport;
use Alert;

class RrhhController extends Controller
{

    public function showReportvig(Request $request){

      $user = $request->user();

      $rrhhreport = Rrhhreport::orderBy('id', 'DESC')->get();
      return view('administracion.rrhh.vigireports', [
        'rrhhreports'=> $rrhhreport,
      ]);
  }

  public function changeEstaterrhh($id, $comentario_rrhh, Request $request){
    $onlyRrhhreport = $this->findByIdURrhhreport($id);
    // dd($comentario_rrhh);
    // $user = $request->user();
    // if ($onlyRrhhreport->user_id != $user->id) {return redirect('/');}
    $onlyRrhhreport->comentario_rrhh = $comentario_rrhh;
    $onlyRrhhreport->estado = 2;  //RESUELTO
    $onlyRrhhreport->save();
    // dd($onlyRrhhreport);

    return redirect('/show_vigs_sup/reports/rrhh');
  }

  private function findByIdURrhhreport($id){
      return Rrhhreport::where('id', $id)->firstOrFail();
  }
}
