<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Question;

class DashboardController extends Controller
{

    public function dashboard(Request $request)
    {
        $userId = Session::get('user_id');

        if (!$userId) {
            return redirect('/login');
        }

        $user = User::find($userId);

        $preguntasCreadas = $user->questions;

        $preguntasDeOtros = Question::where('user_id', '!=', $userId)->get();

        return view('dashboard', compact('user', 'preguntasCreadas', 'preguntasDeOtros'));
    }
}
