<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\CheckVoucher;

class CheckVouchersController extends Controller
{
    public function index()
    {   
        $cv = CheckVoucher::all();
        return view('check_vouchers.index', compact('cv'));
    }

    public function create()
    {
        
    }
}
