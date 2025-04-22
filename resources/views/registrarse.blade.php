<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>REGISTRO</title>
    @vite('resources/css/register.css')
</head>

<body>
<div id="registro">

    <form method="POST" id="formRegister" action="{{ route('registrarse') }}">
        @csrf
        <h3>REGISTRO DE USUARIOS</h3> <br>
        <label for="username"></label>
        <input type="text" id="username" name="username" required placeholder="USUARIO"> <br>

        <label for="password"></label>
        <input type="password" id="password" name="password" required placeholder="CONTRASEÑA"> <br>

        <input type="submit" value="Registrarme">
    </form>
</div>
</body>

</html>

