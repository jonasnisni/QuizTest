<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\preguntasController;
use App\Http\Controllers\RegistrarseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;



Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login',LoginController::class)->name('login');

Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

Route::post('/registrarse',[RegistrarseController::class,'registrarse'])->name('registrarse');



Route::post('/verificar-respuesta', [preguntasController::class,'verificarRespuesta'])->name('verificar.respuesta');
Route::post('/guardar-pregunta',[preguntasController::class,'guardarPregunta'])->name('guardar.pregunta');
//Route::post('/preguntas',[preguntaController::class,'sumarPuntos'])->name('sumarPuntos.pregunta');


Route::get('/logout', function () {
    Session::forget('user_id');
    return redirect('/login');})->name('logout');


Route::get('/registrarse', function () {
    return view('registrarse');
})->name('registrarse.form');








