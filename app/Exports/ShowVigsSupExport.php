<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ShowVigsSupExport implements FromView
{
    public $vigs;

    public function __construct($vigs)
    {
        $this->vigs = $vigs;
    }
    
    public function view(): View
    {       
        return view('exports.vigiporsupervisor', [
            'vigs' => $this->vigs
        ]);
    }
}
