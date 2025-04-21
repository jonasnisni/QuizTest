<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>REGISTRO</title>
    @vite('resources/css/styles.css')
</head>

<body>
<div id="registro">
    <form method="POST" id="formRegister" action="{{ route('registrarse') }}">
        @csrf
        <label for="username">Nombre de usuario</label>
        <input type="text" id="username" name="username" required> <br>

        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required> <br>

        <input type="submit" value="Registrarme">
    </form>
</div>
</body>

</html>

