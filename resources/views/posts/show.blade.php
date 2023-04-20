@extends('plantillas.plantilla')

@section('title', 'VER')

@section('content')

<div class="container">
    
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Contenido</th>
                <th>Categoría</th>
                <th>Subcategoría</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($posts as $post) --}}

                <tr>
                    <td scope="row">{{ $post->id }}</td>
                    <td>{{ $post->titulo }}</td>
                    <td>{{ $post->contenido }}</td>
                    <td>{{ $post->categoria->nombre }}</td>
                    <td>{{ $post->subcategoria->nombre }}</td>
                </tr>
            
            {{-- @endforeach --}}
           
        </tbody>
    </table>
    
</div>

@endsection

@section('scripts')
    <script>
        // Aquí van los scripts específicos de esta vista
    </script>
@endsection