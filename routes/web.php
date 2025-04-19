<?php

use App\Http\Controllers\DashboardController;
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


Route::get('/login', function () {
    return view('login');
});

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    Log::info("Intento de login - username: $username");

    $user = DB::table('users')->where('username', $username)->first();

    if ($user && Hash::check($password, $user->password)) {
        Session::put('user_id', $user->id);
        return redirect('/dashboard');
    } else {
        return "DATOS INCORRECTOS";
    }
})->name('login');



Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

Route::post('/verificar', [RespuestaController::class, 'verificar'])->name('verificar.respuesta');



Route::post('/guardar-pregunta', function (Request $request) {
    $userId = Session::get('user_id');

    if (!$userId) {
        return redirect('/login')->with('error', 'Debes iniciar sesión.');
    }

    Question::create([
        'user_id' => $userId,
        'question' => $request->input('question'),
        'answer' => $request->input('answer'),
    ]);

    return redirect('/dashboard')->with('success', 'Pregunta creada con éxito.');
})->name('guardar.pregunta');

Route::get('/logout', function () {
    Session::forget('user_id');

    return redirect('/login')->with('success', 'Sesión cerrada correctamente.');
})->name('logout');


Route::get('/usuarios', function () {
    $usuarios = User::all(); //Modificar aca
    return view('usuarios', ['usuarios' => $usuarios]);
});


Route::get('/registrarse', function () {
    return view('registrarse');
})->name('registrarse.form');

Route::post('/registrarse',[RegistrarseController::class,'registrarse'])->name('registrarse');







