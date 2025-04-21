<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuardarPreguntaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrarseController;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RespuestaController;


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login',LoginController::class)->name('login');

Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

Route::post('/verificar', [RespuestaController::class, 'verificar'])->name('verificar.respuesta');

Route::post('/registrarse',[RegistrarseController::class,'registrarse'])->name('registrarse');

Route::post('/guardar-pregunta', GuardarPreguntaController::class)->name('guardar.pregunta');


Route::get('/logout', function () {
    Session::forget('user_id');
    return redirect('/login');})->name('logout');


Route::get('/registrarse', function () {
    return view('registrarse');
})->name('registrarse.form');








