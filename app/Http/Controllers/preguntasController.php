<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class preguntasController extends Controller
{
public function verificarRespuesta (Request $request)
{


$pregunta = Question::find($request->input('pregunta_id'));

if (!$pregunta) {
return back()->with('error', 'Pregunta no encontrada');
}

$respuestaCorrecta = strtolower(trim($pregunta->answer));
$respuestaUsuario = strtolower(trim($request->input('respuesta_usuario')));

if ($respuestaCorrecta === $respuestaUsuario) {
    $user = auth()->user();
    $user->points += 1;
    $user->save();
    return back()->with('success', 'CORRECTO');
} else {
    return back()->with('error', 'INCORRECTO');
}
}

public function guardarPregunta(Request $request)
{
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
}

}

