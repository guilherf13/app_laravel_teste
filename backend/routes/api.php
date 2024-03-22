<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//EndPoints de login. registro e CRUDs.
Route::post('/login', [LoginController::class, 'login'])->name('loguin');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('update.password');
Route::post('/send-email-validate', [LoginController::class, 'sendEmailValidate'])->name('send.email.validate');
Route::post('/form-reset-password', [LoginController::class, 'formResetPassword'])->name('reset.password');
Route::delete('/delete-user/{id}', [LoginController::class, 'deleteUser'])->name('delete.user');
//Agenda CRUD
Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
Route::get('/schedules/{id}', [ScheduleController::class, 'show'])->name('schedules.show');
Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->name('schedules.update');
Route::delete('/schedules/{id}', [ScheduleController::class, 'delete'])->name('schedules.delete');
//Relatorio por nomes
Route::get('/report', [ScheduleController::class, 'report'])->name('schedules.report');


Route::fallback(function () {
    return response()->json(['message' => 'Recurso não encontrado.']);
});
