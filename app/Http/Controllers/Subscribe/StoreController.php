<?php

namespace App\Http\Controllers\Subscribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated=$request->validate([
            'paymentMethod'=>['required','string'],
            'selectedProductId'=>['required','exists:products,id'],
        ]);

        $selectedProduct=Product::findOrFail($validated['selectedProductId']);
        auth()->user()->newSubscription(
            'default',  $selectedProduct->stripe_product_id
        )->create($validated['paymentMethod']);
     
    }
}
