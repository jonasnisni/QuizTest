<h2>Bienvenido, {{ $user->username }}</h2>

<head>
    <title>DASHBOARD</title>
    @vite('resources/css/stylesDashboard.css')
</head>

@if(session('success'))
    <div style="color: green">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div style="color: red">{{ session('error') }}</div>
@endif


<h3>Tus puntos : {{$user->points}}</h3> <br>

<div id="ranking">
    <h3>Top 5 mejores usuarios</h3>

    <ul class="list-group">
        @forelse($top5 as $user)
            <li class="list-group-item d-flex justify-content-between">
                <strong>{{ $user->username }}</strong>
                <span>{{ $user->points }} puntos</span>
            </li>
        @empty
            <li class="list-group-item">No hay usuarios para mostrar.</li>
        @endforelse
    </ul>
</div>

<h3>Tus preguntas</h3>
<ul>
    @foreach ($preguntasCreadas as $q) <br>
        <li>{{ $q->question }} {{$q->id}} - Respuesta: {{ $q->answer ?? 'Sin responder' }}</li>
    @endforeach
</ul>

<h3>Agregar una nueva pregunta</h3>

<form action="{{ route('guardar.pregunta') }}" method="POST">
    @csrf
    <label for="question">Pregunta :</label><br>
    <input type="text" name="question" id="question" required><br><br>

    <label for="answer">Respuesta :</label><br>
    <input type="text" name="answer" id="answer"><br><br>

    <button type="submit">Guardar pregunta</button>
</form>



@php //Modificar esto en algun momento. Es horrible.
    $usuarioActual = auth()->user();
    $preguntasRespondidas = App\Models\AnsweredQuestion::where('user_id', $usuarioActual->id)
                                                       ->pluck('question_id')
                                                       ->toArray();
@endphp

<h3>Preguntas hechas por otros usuarios</h3>
<ul>
    @foreach ($preguntasDeOtros as $q)
        @if (!in_array($q->id, $preguntasRespondidas))
            <li style="margin-bottom: 1.5rem;">
                <p><strong>Pregunta:</strong> {{ $q->question }}</p>
                <p><strong>Hecha por:</strong> {{ $q->user->username }}</p>

                <form action="{{ route('verificar.respuesta') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pregunta_id" value="{{ $q->id }}">
                    <label>Tu respuesta:</label><br>
                    <input type="text" name="respuesta_usuario" required>
                    <button type="submit">Responder</button>
                </form>
            </li>
        @endif
    @endforeach
</ul>




</ul>

<form action="{{ route('logout') }}" method="GET" style="display:inline;">
    <button type="submit" id="logout">Cerrar sesión</button>
</form>
