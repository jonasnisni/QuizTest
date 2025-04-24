<h2>Bienvenido, {{ $user->username }}</h2>

<head>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
    @foreach ($preguntasCreadas as $q)
        <li
            x-data="{
        edit: false,
        question: '{{ addslashes($q->question) }}',
        answer:   '{{ addslashes($q->answer ?? '') }}'
      }"
            class="mb-2"
        >
            {{-- Vista lectura --}}
            <div x-show="!edit">
                <strong x-text="question"></strong> —
                <em x-text="answer || 'Sin responder'"></em>

                <button
                    @click.prevent="edit = true"
                    class="ml-2 px-2 py-1 bg-blue-500 text-white rounded"
                >Modificar</button>

                {{-- Botón Borrar --}}
                <form
                    action="{{ route('preguntas.borrar') }}"
                    method="POST"
                    style="display:inline"
                >
                    @csrf
                    <input type="hidden" name="id" value="{{ $q->id }}">
                    <button
                        type="submit"
                        onclick="return confirm('¿Seguro que quieres borrar esta pregunta?')"
                        class="ml-1 px-2 py-1 bg-red-500 text-white rounded"
                    >Borrar</button>
                </form>
            </div>

            {{-- Formulario edición --}}
            <div x-show="edit">
                <form
                    action="{{ route('preguntas.modificar', $q->id) }}"
                    method="POST"
                    style="display:inline"
                >
                    @csrf
                    @method('PUT')

                    <input
                        x-model="question"
                        type="text"
                        name="question"
                        placeholder="Nueva pregunta"
                        class="border px-1 py-1 rounded"
                        required
                    >
                    <input
                        x-model="answer"
                        type="text"
                        name="answer"
                        placeholder="Nueva respuesta"
                        class="border px-1 py-1 rounded ml-1"
                    >

                    <button
                        type="submit"
                        class="ml-1 px-2 py-1 bg-green-500 text-white rounded"
                    >Guardar</button>
                    <button
                        type="button"
                        @click.prevent="edit = false"
                        class="ml-1 px-2 py-1 bg-gray-400 text-white rounded"
                    >Cancelar</button>
                </form>
            </div>
        </li>
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
