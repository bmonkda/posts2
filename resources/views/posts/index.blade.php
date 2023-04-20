@extends('plantillas.plantilla')

@section('title', 'LISTA')

@section('content')

<div class="container">
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Contenido</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)

                <tr>
                    <td scope="row">{{ $post->id }}</td>
                    <td>{{ $post->titulo }}</td>
                    <td>{{ $post->contenido }}</td>
                    <td>
                        <a href="{{ route('posts.show', $post) }}">Ver</a>
                        <a href="{{ route('posts.edit', $post) }}">Editar</a>
                        <form action="{{ route('posts.destroy', $post) }}" method ="POST" >
                            @csrf
                            @method('DELETE')
                            
                            <input type="submit" value="Eliminar" onclick="return EliminarRegistro('Eliminar Profesor')">
                        </form>
                        {{-- <a href="{{ route('posts.destroy', $post) }}">Eliminar</a> --}}
                    </td>
                </tr>
            
            @endforeach
           
        </tbody>
    </table>
    
</div>

@endsection

@section('scripts')
    <script>
        // Aquí van los scripts específicos de esta vista
    </script>
@endsection