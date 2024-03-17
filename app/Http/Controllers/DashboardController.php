<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data=[
            'invoices'=>auth()->user()->invoices(),
        ];
        return view('dashboard',$data);
    }
}
