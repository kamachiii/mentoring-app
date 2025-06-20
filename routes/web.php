<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('landing-page');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes for Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAction'])->name('login.action');

});

// Routes for Admin
Route::middleware(['auth', 'role:admin'])->group(function () {

});

// Routes for Mentor
Route::middleware(['auth', 'role:mentor'])->group(function () {

});

// Routes for User
Route::middleware(['auth', 'role:user'])->group(function () {

});
