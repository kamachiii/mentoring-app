<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MentoringController;
use App\Http\Controllers\MentoringGroupController;

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
Route::middleware(['role:admin'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('mentoring-group', MentoringGroupController::class);
});

// Routes for Mentor
Route::middleware(['role:admin,mentor'])->group(function () {
    Route::resource('mentoring', MentoringController::class);
    Route::resource('schedule', ScheduleController::class);
});

// Routes for User
Route::middleware(['role:user'])->group(function () {
});

// Routes for Forum
Route::get('/forum', [App\Http\Controllers\DiscussionController::class, 'index'])->name('forum.index');
Route::post('/forum', [App\Http\Controllers\DiscussionController::class, 'store'])->name('forum.store');
// Routes for Forum
Route::get('/dashboard-progress',function(){
    return view('dashboard');
});

Route::get('/absensi', function () {
    return view('absensi');
});
