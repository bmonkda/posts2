@extends('plantillas.plantilla')

@section('title', 'CREAR')

@section('content')
    {{-- @include('posts.partials.form') --}}

    <form method="POST" action="{{ route('posts.update', $post) }}">
        
        @csrf

        @method('PUT')
    
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $post->titulo }}">
        </div>
    
        <div class="form-group">
            <label for="contenido">Contenido</label>
            <textarea name="contenido" id="contenido" class="form-control">{{ $post->contenido }}</textarea>
        </div>
    
        <div class="form-group">
            <label for="categoria">Categoría</label>
            <select name="categoria" id="categoria" class="form-control">
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria', $post->categoria_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subcategoria">Subcategoría</label>
            <select class="form-control" name="subcategoria" id="subcategoria" {{ $post->categoria_id ? '' : 'disabled' }}>
                <option value="">Seleccione una subcategoría</option>
                @foreach ($subcategorias as $subcategoria)
                    <option value="{{ $subcategoria->id }}" {{ old('subcategoria', $post->subcategoria_id) == $subcategoria->id ? 'selected' : '' }}>
                        {{ $subcategoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <button type="submit" class="btn btn-primary">Crear post</button>
    </form>


@endsection

@section('scripts')
    
    {{-- <script>
        const categoriaSelect = document.getElementById('categoria_id');
        const subcategoriaSelect = document.getElementById('subcategoria_id');
        
        // Obtener las subcategorías disponibles al cargar la página

        categoriaSelect.addEventListener('change', event => {
            // console.log("El id de la categoría es: " + $categoriaSelect.value)
            subcategoriaSelect.innerHTML = '<option value="">Seleccione una subcategoría</option>';
            
            const categoriaId = event.target.value;
            if (categoriaId) {
                fetch(`/categorias/${categoriaId}/subcategorias`)
                    .then(response => response.json())
                    .then(subcategorias => {
                        subcategorias.forEach(subcategoria => {
                            const option = document.createElement('option');
                            option.value = subcategoria.id;
                            option.text = subcategoria.nombre;
                            subcategoriaSelect.add(option);
                        });
                    })
                    .catch(error => console.error(error));
            }
        });
        
        // Envío del formulario por AJAX
        const postForm = document.getElementById('post-form');
        postForm.addEventListener('submit', event => {
            event.preventDefault();
            const formData = new FormData(postForm);
            const postId = {{ $post->id ?? 'null' }};
            const url = postId ? `/posts/${postId}` : '/posts';
            fetch(url, {
                method: postId ? 'PUT' : 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                // Mostrar mensaje de éxito o error y redirigir al listado de posts
                if (data.success) {
                    alert('El post se ha guardado correctamente.');
                    window.location.href = '/posts';
                } else {
                    alert('Ha ocurrido un error al guardar el post. Por favor, inténtelo de nuevo.');
                }
            })
            .catch(error => console.error(error));
        });
    </script> --}}

    <script>
        const categoriaSelect = document.getElementById('categoria');
        const subcategoriaSelect = document.getElementById('subcategoria');
    
        categoriaSelect.addEventListener('change', () => {
            const categoriaId = categoriaSelect.value;
    
            // Si no se ha seleccionado una categoría, deshabilitamos el select de subcategorías
            if (categoriaId === '') {
                subcategoriaSelect.innerHTML = '<option value="">Seleccione una subcategoría</option>';
                subcategoriaSelect.disabled = true;
                return;
            }
    
            // Si se seleccionó una categoría, habilitamos el select de subcategorías y hacemos una petición Fetch para obtener las subcategorías
            subcategoriaSelect.disabled = false;
            fetch(`/api/categorias/${categoriaId}/subcategorias`)
                .then(response => response.json())
                .then(data => {
                    subcategoriaSelect.innerHTML = '<option value="">Seleccione una subcategoría</option>';
                    data.forEach(subcategoria => {
                        const option = document.createElement('option');
                        option.value = subcategoria.id;
                        option.textContent = subcategoria.nombre;
                        subcategoriaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error(error));
        });
    </script>

@endsection