<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\DoctorController;
use \App\Http\Controllers\PatientController;

Route::post('/register' , [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login' , [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user' , [AuthController::class, 'user']);
    Route::post('logout' , [AuthController::class, 'logout']);

    Route::post('addImage' , [AuthController::class, 'addImage']);
    Route::get('specializations', [DoctorController::class, 'getSpecializations']);
    Route::post('addDoctor', [DoctorController::class, 'addDoctor']);
    Route::get('getDoctors', [DoctorController::class, 'getDoctors']);
    Route::get('getAllDoctors', [DoctorController::class, 'getAllDoctors']);
    Route::post('editDoctor', [DoctorController::class, 'editDoctor']);
    Route::post('deleteDoctor', [DoctorController::class, 'deleteDoctor']);
    Route::get('doctor/{id}/reservations', [DoctorController::class, 'getDoctorReservations']);
    Route::post('userByName', [PatientController::class, 'getPatientName']);
    Route::post('reserve', [PatientController::class, 'makeReservation']);
    Route::delete('reservation/{id}', [PatientController::class, 'deleteReservation']);
    Route::post('reservation/{id}/update', [PatientController::class, 'updateReservation']);

});

