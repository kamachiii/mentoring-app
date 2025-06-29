<?php

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MentoringController;
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

// untuk admin mentor sama user harus nya sudah bisa bang cuman middlewarenya masih blm jalan jadi dia ga kebaca rolenya saya kasih catatan agar tidak lupa
// Routes for Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::resource('mentoring', App\Http\Controllers\MentoringController::class);

});

// Routes for Mentor
Route::middleware(['auth', 'role:mentor'])->group(function () {
    // Route::resource('mentoring', App\Http\Controllers\MentoringController::class); 

});

// Routes for User
Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    // Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('schedule.show');


});

// Admin Jadwal Monitoring
    Route::resource('mentoring', App\Http\Controllers\MentoringController::class);

// User Jadwal Monitoring
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('schedule.show');

// Routes for Forum
Route::get('/forum',function(){
    return view('layouts.forum');    

});
// Routes for Forum
Route::get('/dashboard',function(){
    return view('dashboard');    

});