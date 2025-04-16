<!-- resources/views/usuarios.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
</head>
<body>
<h1>Usuarios registrados</h1>

<ul>
    @foreach ($usuarios as $usuario)
        <li>{{ $usuario->id }} - {{ $usuario->username }}</li>
    @endforeach
</ul>

</body>
</html>
