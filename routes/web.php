<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;

Route::middleware(['web'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/', fn() => view('dashboard'))->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */
    Route::resource('patients', PatientController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('appointments', AppointmentController::class);

    // AJAX routes for modal add

    Route::post('doctors/ajax-store', [DoctorController::class, 'ajaxStore'])->name('doctors.ajaxStore');
    Route::post('patients/ajax-store', [PatientController::class, 'ajaxStore'])->name('patients.ajaxStore');

});