<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegistrarseController extends Controller
{
    /**
     * Maneja el registro de un nuevo usuario.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registrarse(Request $request)
    {
        // Obtener credenciales desde el formulario
        $username = $request->input('username');
        $password = $request->input('password');

        // Log de intento de registro
        Log::info("Intento de registro - username: $username");

        // Verificar si el usuario ya existe
        $existingUser = DB::table('users')
            ->where('username', $username)
            ->first();

        if ($existingUser) {
            return response("USUARIO YA REGISTRADO", 409); //Devolver una vista
        }

        // Hashear la contraseña
        $hashedPassword = Hash::make($password);

        // Insertar usuario y obtener su ID
        $userId = DB::table('users')->insertGetId([
            'username'   => $username,
            'password'   => $hashedPassword,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Guardar ID en sesión
        Session::put('user_id', $userId);

        // Log de registro exitoso
        Log::info("USUARIO REGISTRADO. ID: $userId");

        // Redirigir al dashboard
        return redirect('/dashboard');
    }
}
