<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EstadoFacturacionExport implements FromView
{
    public $facturas;

    public function __construct($facturas)
    {
        $this->facturas = $facturas;
    }
    
    public function view(): View
    {
        return view('exports.estadoFacturacion', [
            'facturas' => $this->facturas
        ]);
    }
}
