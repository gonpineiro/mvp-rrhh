<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SupervisoresExport implements FromView
{
    public $supervisores;

    public function __construct($supervisores)
    {
        $this->supervisores = $supervisores;
    }

    public function view(): View
    {
        return view('exports.supervisores', [
            'supervisores'=>  $this->supervisores,
        ]);
    }
}
