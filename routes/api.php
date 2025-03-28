<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\payment\sslcommerzController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::controller(sslcommerzController::class)->group(function () {
    Route::post('/payment-ipn', 'PaymentIPN'); // Instant Payment Notification (IPN) handler
});
