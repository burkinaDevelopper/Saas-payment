<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data=[
            'intent' => auth()->user()->createSetupIntent(),
            'products'=>Product::all(),
        ];
        return view('subscribe.create',$data);
    }
}
