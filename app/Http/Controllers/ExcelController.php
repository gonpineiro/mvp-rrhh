<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SupervisoresExport;

class ExcelController extends Controller
{
    public function showSupusers(Request $request)
    {
        return Excel::download(new SupervisoresExport, 'supervisores.xlsx');
    }
}
