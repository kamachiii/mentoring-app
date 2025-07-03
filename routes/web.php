<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PresenceController; // Import PresenceController
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MentoringController;
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

// Routes for Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::resource('mentoring', App\Http\Controllers\MentoringController::class);
});

// Routes for Mentor
Route::middleware(['auth', 'role:mentor'])->group(function () {
    // Route::resource('mentoring', App\Http\Controllers\MentoringController::class);

    // [CATATAN]: Setelah middleware 'role:mentor' berfungsi,
    //           Anda bisa pindahkan route presensi di bawah ini ke dalam group ini.
    // Route::match(['get', 'post'], '/presensi', [PresenceController::class, 'index'])->name('presensi');
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
Route::get('/forum',function(){
    return view('layouts.forum');
});



Route::match(['get', 'post'], '/presensi', [PresenceController::class, 'index'])->name('presensi');



// use App\Http\Controllers\ScheduleController;
// use App\Http\Controllers\MentoringController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('landing-page');
// });

// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });

// // Routes for Guest
// Route::middleware('guest')->group(function () {
//     Route::get('/login', [AuthController::class, 'login'])->name('login');
//     Route::post('/login', [AuthController::class, 'loginAction'])->name('login.action');

// });

// // Routes for Admin
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::resource('mentoring', MentoringController::class);
//     Route::resource('user', UserController::class);

// });

// // Routes for Mentor
// Route::middleware(['auth', 'role:mentor'])->group(function () {
//     Route::resource('mentoring', MentoringController::class);

// });

// // Routes for User
// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
//     Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('schedule.show');
// });

// // Admin Jadwal Monitoring
//     Route::resource('mentoring', MentoringController::class);

// // User Jadwal Monitoring
//     Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
//     Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('schedule.show');

// // Routes for Forum
// Route::get('/forum', [App\Http\Controllers\DiscussionController::class, 'index'])->name('forum.index');
// // Routes for Forum
// Route::get('/dashboard-progress',function(){
//     return view('dashboard');

// });

// Route::get('/absensi', function () {
//     return view('absensi');
// });
