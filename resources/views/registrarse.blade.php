<head>
    <title>REGISTRO</title>
    @vite('resources/css/styles.css')
</head>


<form method="POST" id="formRegister" action="{{ route('registrarse') }}">
    @csrf
    <label for="username">Nombre de usuario</label>
    <input type="text" name="username" required>

    <label for="password">Contraseña</label>
    <input type="password" name="password" required>

    <input type="submit" value="Registrarme">
</form>
