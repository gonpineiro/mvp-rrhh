<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\PieChart;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chart = new PieChart;
        $chart->labels(['One', 'Two', 'Three']);
        $chart->dataset('My dataset 1', 'pie', [1, 2, 3]);
        return view('home',['chart' => $chart]);
    }
}
