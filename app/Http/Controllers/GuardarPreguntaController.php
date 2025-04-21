<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuardarPreguntaController extends Controller
{
    public function __invoke(Request $request)
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
