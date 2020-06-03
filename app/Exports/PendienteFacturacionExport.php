<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PendienteFacturacionExport implements FromView
{
    public $pendientes;

    public function __construct($pendientes)
    {
        $this->pendientes = $pendientes;
    }

    public function view(): View
    {
        return view('exports.facturacion.pendientes', [
            'pendientes'=>  $this->pendientes,
        ]);
    }
}
