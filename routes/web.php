<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route Login
Route::get('/login', [UserAccountController::class,'index']);
Route::post('/login/get-login', [UserAccountController::class,'getLogin']);
Route::get('/login/refresh', [UserAccountController::class,'refreshToken']);

Route::get('/logout', [UserAccountController::class,'getLogout']);

Route::get('/', function () {
    return view('layouts.login');
});
