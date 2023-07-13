<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Product;
use App\Models\Saleorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    //use App\Models\Data;
    public function filterByYear($year)
    {
        if (Auth::user()->user_roll != 1) {
            abort(403);
        }
        $filteredrevenue = DB::table('saleorders')
        ->whereYear('created_at', $year)
            ->get();

        $filteredcost = DB::table('invoices')
        ->whereYear('created_at', $year)
        ->get();

        $revenue = $filteredrevenue->sum('total_price');
        $cost = $filteredcost->sum('total_price');

        return view('filterByYearDashboard', compact('cost','revenue', 'year'));
    }

    public function index()
    {
        if (Auth::user()->user_roll != 1) {
            abort(403);
        }
        $revenue = DB::table('saleorders')->sum('total_price');
        $cost = DB::table('invoices')->sum('total_price');
        return view('dashboard', compact('revenue','cost'));
    }

}
