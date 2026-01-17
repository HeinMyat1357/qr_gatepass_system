<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TemporaryPassController;
use App\Http\Controllers\GatePassLogController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
//New
Route::get('/', function () {
    return view('index');
})->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
//old

Route::get('/add-user-type', function () {
    return view('admin.pages.add-user-type');
});

Route::get('/view-user-types', function () {
    return view('admin.pages.view-user-types');
});

Route::get('/add-user', function () {
    return view('admin.pages.add-user');
});

Route::get('/view-users', function () {
    return view('admin.pages.view-users');
});

Route::get('/create-location', function () {
    return view('admin.pages.create-location');
});

Route::get('/view-locations', function () {
    return view('admin.pages.view-locations');
});

Route::get('/create-temp-pass', function () {
    return view('admin.pages.create-temp-pass');
});

Route::get('/view-temp-passes', function () {
    return view('admin.pages.view-temp-passes');
});

Route::get('/gate-pass-logs', function () {
    return view('admin.pages.gate-pass-logs');
});

Route::get('/audit-logs', function () {
    return view('admin.pages.audit-logs');
});

  
// Route::get('/auth/login', function () {
//     return view('admin.pages.auth.login');
// })->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Route::get('/register', function () {
//     return view('admin.pages.auth.register');
// })->name('register');



Route::get('/view-users', [UserController::class, 'viewAllUsers'])->name('users.view');


// Show all users
Route::get('/view-users', [UserController::class, 'index'])->name('users.view');

// Edit user
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

// Update user
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

// Delete user
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Show Add User form
Route::get('/add-user', [UserController::class, 'create'])->name('users.create');

// Store new user
Route::post('/users', [UserController::class, 'store'])->name('users.store');

// View all users
Route::get('/view-users', [UserController::class, 'index'])->name('users.view');
// Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');



// View all locations
Route::get('/view-locations', [LocationController::class, 'index'])->name('locations.index');

// Show create location form
Route::get('/create-location', [LocationController::class, 'create'])->name('locations.create');

// Store new location
Route::post('/create-location', [LocationController::class, 'store'])->name('locations.store');

// Show edit form for specific location
Route::get('/locations/{id}/edit', [LocationController::class, 'edit'])->name('locations.edit');

// Update location
Route::put('/locations/{id}', [LocationController::class, 'update'])->name('locations.update');

// Delete location
Route::delete('/locations/{id}', [LocationController::class, 'destroy'])->name('locations.destroy');



Route::get('/view-temp-passes', [TemporaryPassController::class, 'index'])->name('temp_passes.index');
Route::get('/create-temp-pass', [TemporaryPassController::class, 'create'])->name('temp_passes.create');
Route::post('/create-temp-passes', [TemporaryPassController::class, 'store'])->name('temp_passes.store');
Route::get('/temp_passes/{id}/edit', [TemporaryPassController::class, 'edit'])->name('temp_passes.edit');
Route::put('/temp_passes/{id}', [TemporaryPassController::class, 'update'])->name('temp_passes.update');
Route::delete('/temp_passes/{id}', [TemporaryPassController::class, 'destroy'])->name('temp_passes.destroy');


Route::get('/gate-pass-logs', [GatePassLogController::class, 'index'])->name('gate_pass_logs.index');
Route::get('/create-temp-pass', [TemporaryPassController::class, 'create'])->name('temp_passes.create');
Route::post('/create-temp-passes', [TemporaryPassController::class, 'store'])->name('temp_passes.store');
Route::get('/gate-pass-logs/{id}/edit', [GatePassLogController::class, 'edit'])->name('gate_pass_logs.edit');
Route::put('/gate-pass-logs/{id}', [GatePassLogController::class, 'update'])->name('gate_pass_logs.update');
Route::delete('/gate-pass-logs/{id}', [GatePassLogController::class, 'destroy'])->name('gate_pass_logs.destroy');


use App\Http\Controllers\UserTypeController;

Route::get('/view-user-types', [UserTypeController::class, 'index'])->name('user_types.index');
Route::get('/add-user-type', [UserTypeController::class, 'create'])->name('user_types.create');
Route::post('/user-types', [UserTypeController::class, 'store'])->name('user_types.store');
Route::get('/user-types/{id}/edit', [UserTypeController::class, 'edit'])->name('user_types.edit');
Route::put('/user-types/{id}', [UserTypeController::class, 'update'])->name('user_types.update');
Route::delete('/user-types/{id}', [UserTypeController::class, 'destroy'])->name('user_types.destroy');



Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->middleware('auth')->name('profile.show');

Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile.changePassword');



use App\Http\Controllers\AdminController;
// Login Routes
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('login.post');

// Logout Route
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Protected Dashboard (requires authentication)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->middleware('auth')
    ->name('admin.dashboard');


Route::prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'viewUsers'])->name('admin.users');
    Route::post('/users/approve/{id}', [AdminController::class, 'approveUser'])->name('admin.users.approve');
});

// Route::get('/admin/users', [AdminController::class, 'index'])->name('users.view');


use App\Http\Controllers\ModeratorController;
use App\Models\TemporaryPass;

Route::get('/moderator/home', function () {
    return view('moderator.pages.home');
})->name('moderator.home');

Route::get('/moderator/dashboard', [ModeratorController::class, 'dashboard'])->name('moderator.dashboard');

Route::get('/moderator/scan', [ModeratorController::class, 'scan'])->name('moderator.scan');

Route::get('/moderator/visitors', [ModeratorController::class, 'visitor'])
->name('moderator.visitors');

// View users page
Route::get('/moderator/users', [ModeratorController::class, 'user'])->name('moderator.users');

Route::get('/moderator/profile', function () {
    return view('moderator.pages.profile');
})->name('moderator.profile');

Route::get('/my-qrcode', function () {
    return view('moderator.pages.my-qrcode');
})->name('moderator.qrcode');



// Route::get('/moderator/reports', [ModeratorController::class, 'reports'])->name('moderator.reports');


// Logout
Route::post('/login', [ModeratorController::class, 'logout'])->name('moderator.logout');

// Route::get('/login', [ModeratorController::class, 'showLoginForm'])->name('login.form');

// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/moderator/profile', [ModeratorController::class, 'showProfile'])->name('moderator.profile');

Route::put('/profile/update', [ModeratorController::class, 'updateProfile'])->name('profile.update');

Route::get('/moderator/my-qrcode', [ModeratorController::class, 'myQrcode'])->name('moderator.qrcode');
Route::get('/my-qrcode', [ModeratorController::class, 'myQrcode'])->name('moderator.qrcode');


Route::get('/moderator/my-qrcode', [ModeratorController::class, 'myQrcode'])->name('moderator.myqrcode');
Route::get('/moderator/download-qr', [ModeratorController::class, 'downloadQr'])->name('moderator.qrcode.download');

// Route::get('/user', [UserController::class, 'show'])->name('user.profile');
// Route::get('/user', [UserController::class, 'show'])->name('user.qrcode');
use App\Models\User;
Route::get('/user', function () {
    $id = request('id');

    // Optional: return 404 if user not found
    $user = User::findOrFail($id); // Will throw 404 if not found

    return view('user.view', compact('user'));
});

Route::get('/user/dashboard', function () {
    return view('user.pages.dashboard');
})->name('user.dashboard');

Route::get('/visitor/dashboard', function () {
    return view('visitor.pages.dashboard');
})->name('visitor.dashboard');
Route::get('/user/download-qr/{id}', [UserController::class, 'downloadQR'])->name('user.download.qr');
Route::get('/visitor/download-qr/{id}', [TemporaryPassController::class, 'downloadQR'])->name('visitor.download.qr');

Route::get('/generate-qr/{id}', [UserController::class, 'generateQrCode'])->name('generate.qr');

// use Illuminate\Http\Request;
// Route::get('/user', function (Request $request) {
//     $id = $request->id;
//     $user = App\Models\User::findOrFail($id);
//     return view('user.pages.my-qrcode', compact('user'));
// });

// Route::get('/user/{id}', function ($id) {
//     $user = User::findOrFail($id);
//     return view('user.pages.my-qrcode', compact('user'));
// });


// use App\Http\Controllers\UserController;




Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.test');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.test');

Route::post('/login', [AuthController::class, 'login'])->name('login.save');
Route::post('/logout', [AuthController::class, 'logout'])->name('moderator.logout');

Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/my-qrcode', [UserController::class, 'myQRCode'])->name('user.qrcode');
Route::get('/visitor/profile', [TemporaryPassController::class, 'profile'])->name('visitor.profile');
Route::get('/visitor/my-qrcode', [TemporaryPassController::class, 'myQRCode'])->name('visitor.qrcode');
Route::get('/user/home', function () {
    return view('user.pages.home'); // blade file: resources/views/user/home.blade.php
})->name('user.pages.home');
Route::get('/visitor/home', function () {
    return view('visitor.pages.home'); // blade file: resources/views/user/home.blade.php
})->name('visitor.pages.home');
Route::post('/check-qrcode', [App\Http\Controllers\ModeratorController::class, 'checkQRCode'])
    ->name('check.qrcode');

    // Route::get('/api/latest-scans', [ModeratorController::class, 'latestScans'])->name('api.latest.scans');


// Show forgot password form
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Send reset link
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Show reset password form
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Handle reset password
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
