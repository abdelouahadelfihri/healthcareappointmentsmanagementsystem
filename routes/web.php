<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Guest Routes (non connecté seulement)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // Password Reset
    Route::get('/password/reset', [PasswordResetController::class, 'showResetRequestForm'])->name('password.request');
    Route::post('/password/reset', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/update', [PasswordResetController::class, 'resetPassword'])->name('password.update');

});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Password Change (utilisateur connecté)
    Route::get('/password/change', [PasswordChangeController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/password/change', [PasswordChangeController::class, 'updatePassword'])->name('password.change.update');

    // Master Data
    Route::resource('patients', PatientController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('appointments', AppointmentController::class);

    // AJAX Routes
    Route::post('/doctors/ajax-store', [DoctorController::class, 'ajaxStore'])->name('doctors.ajaxStore');
    Route::post('/patients/ajax-store', [PatientController::class, 'ajaxStore'])->name('patients.ajaxStore');

});