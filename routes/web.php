<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresenceController; // Import PresenceController
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MentoringGroupController;

Route::get('/', function () {
    return view('landing-page');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard'); // Ini yang benar
    Route::get('/user/dashboard', [AuthController::class, 'dashboard'])->name('user.index'); // Atau nama controller/metode lain yang sesuai
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes for Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginAction'])->name('login.action');
});

Route::middleware(['role:admin'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('mentoring-group', MentoringGroupController::class);
    Route::post('/mentoring-group/member', [MentoringGroupController::class, 'storeMember'])->name('mentoringGroup.storeMember');
});

Route::middleware(['role:admin,mentor'])->group(function () {
    Route::resource('schedule', ScheduleController::class)->only(['store', 'update','destroy']);
    Route::resource('forum', ForumController::class)->only(['store', 'update','destroy']);
    Route::resource('presence', PresenceController::class)->only(['store', 'update','destroy']);
});

Route::middleware(['role:admin,mentor,user'])->group(function () {
    Route::resource('schedule', ScheduleController::class)->except(['store', 'update', 'destroy']);
    Route::resource('presence', PresenceController::class)->except(['store', 'update', 'destroy']);
    Route::resource('forum', ForumController::class)->except(['store', 'destroy']);
    Route::post('/forum/comment', [ForumController::class, 'storeComment'])->name('forum.storeComment');
});
