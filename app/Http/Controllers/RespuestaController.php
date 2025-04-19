<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class RespuestaController extends Controller
{
public function verificar(Request $request)
{
$pregunta = Question::find($request->input('pregunta_id'));

if (!$pregunta) {
return back()->with('error', 'Pregunta no encontrada');
}

$respuestaCorrecta = strtolower(trim($pregunta->answer));
$respuestaUsuario = strtolower(trim($request->input('respuesta_usuario')));

if ($respuestaCorrecta === $respuestaUsuario) {
    //SUMAR PUNTOS ACA
return back()->with('success', 'CORRECTO');
} else {
return back()->with('error', 'INCORRECTO');
}
}
}
