<?php

use App\Http\Controllers\{
    ProfileController,
    DashboardController
};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Subscribe\{
    CreateController,
    StoreController,
    DestroyController,
};
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('subscribe')->as('subscribe.')->middleware('redirect.subscribed')->group(function(){
        Route::get('create',CreateController::class)->name('create');
        Route::post('store',StoreController::class)->name('store');
        Route::delete('destroy', DestroyController::class)->name('destroy')->withoutMiddleware('redirect.subscribed');
    });
    Route::get('/basic',fn()=>dd('basic access'))->name('basic')->middleware('redirect.not.subscribed');
    Route::get('/premium',fn()=>dd('premium access'))->name('premium')->middleware('redirect.not.prenium');
    Route::get('/dashboard',DashboardController::class)->name('dashboard');
    Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId, [
            'vendor' => 'Your Company',
            'product' => 'Your Product',
            'street' => 'Main Str. 1',
            'location' => '2000 Antwerp, Belgium',
            'phone' => '+32 499 00 00 00',
            'email' => 'info@example.com',
            'url' => config('app.url'),
            'vendorVat' => 'BE123456789',
        ]);
    })->name('invoices');
   
    
});
require __DIR__.'/auth.php';
