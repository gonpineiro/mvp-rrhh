<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AsignacionExport implements FromView
{
    public $asignaciones;

    public function __construct($asignaciones)
    {
        $this->asignaciones = $asignaciones;
    }
    
    public function view(): View
    {       
        return view('exports.asignaciones', [
            'asignaciones' => $this->asignaciones
        ]);
    }
}
