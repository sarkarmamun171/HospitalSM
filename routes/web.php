<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/',[HomeController::class,'index']);
Route::get('/home',[HomeController::class,'redirect'])->name('home');
//Doctor
Route::get('/add-doctor',[DoctorController::class,'addDoctor'])->name('add-doctor');
Route::get('/add-doctor/index',[DoctorController::class,'addDoctorIndex'])->name('add-doctor.index');
Route::post('/add-doctor/store',[DoctorController::class,'addDoctorStore'])->name('add-doctor.store');
Route::get('/add-doctor/edit/{id}',[DoctorController::class,'addDoctorEdit'])->name('add-doctor.edit');
Route::put('/add-doctor/update/{id}',[DoctorController::class,'addDoctorUpdate'])->name('add-doctor.update');
Route::delete('/add-doctor/delete/{id}',[DoctorController::class,'addDoctorDelete'])->name('add-doctor.delete');
