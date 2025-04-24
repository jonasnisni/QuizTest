<?php

namespace App\Http\Controllers;

use App\Models\AnsweredQuestion;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;

class DashboardController extends Controller
{

    public function dashboard(Request $request)
    {

        $user = auth()->user();
        $top5 = User::orderBy('points', 'desc')->limit(5)->get();


        if (!$user) {
            return redirect('/login');
        }

        $preguntasRespondidas = AnsweredQuestion::where('user_id', $user->id)
            ->pluck('question_id')
            ->toArray();


        $preguntasCreadas = $user->questions;

        $preguntasDeOtros = Question::where('user_id', '!=', $user->id)->get();

        return view('dashboard', compact('user', 'preguntasCreadas', 'preguntasDeOtros','top5','preguntasRespondidas'));
    }


}
