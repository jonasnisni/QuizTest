<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $user = DB::table('users')->where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::loginUsingId($user->id);
            return redirect('/dashboard');
        } else {
            return "DATOS INCORRECTOS"; //Redireccionar a una vista
        }
    }
}
