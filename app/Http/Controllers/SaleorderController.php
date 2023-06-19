<?php

namespace App\Http\Controllers;

use App\Models\Saleorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleorderController extends Controller
{
    public function index()
    {
        if (Auth::user()->user_roll != 1) {
            abort(403);
        }
        $sales = Saleorder::query()->get();
        return view('viewsaleorder',compact('sales'));
    }
}
