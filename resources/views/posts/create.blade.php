@extends('plantillas.plantilla')

@section('title', 'CREAR')

@section('content')

    {{-- <form method="POST" action="{{ route('posts.store') }}">

        @csrf --}}

        @include('posts.partials.form')

        {{-- <button type="submit" class="btn btn-primary">Crear post</button>

    </form> --}}

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