<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BankController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('bank', BankController::class);
});

Route::get('/login', function(){
    return '';
})->name('login');

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [AuthController::class,'register']);

