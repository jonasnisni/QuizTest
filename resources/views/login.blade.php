<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite('resources/css/styles.css')

</head>
<body>

<div id="login_y_registro">

<h1>Login</h1>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <label for="username"></label><br>
    <input type="text" id="username" name="username" placeholder="USUARIO"><br><br>

    <label for="password"></label><br>
    <input type="password" id="password" name="password" placeholder="CONTRASEÑA"><br><br>

    <button type="submit">Ingresar</button>
</form>

    <div>
        <h1>¿Sin cuenta?</h1>
        <button onclick="window.open('{{ route('registrarse') }}', '_blank');">
            REGISTRATE
        </button>
    </div>

</div>

</body>
</html>
