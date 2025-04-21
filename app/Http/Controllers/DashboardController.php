<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class DashboardController extends Controller
{

    public function dashboard(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        $preguntasCreadas = $user->questions;

        $preguntasDeOtros = Question::where('user_id', '!=', $user->id)->get();

        return view('dashboard', compact('user', 'preguntasCreadas', 'preguntasDeOtros'));
    }

}
