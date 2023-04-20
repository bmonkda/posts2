{{-- <form method="POST" action="{{ route('posts.store') }}">
    @csrf

    <div class="form-group">
        <label for="titulo">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control">
    </div>

    <div class="form-group">
        <label for="contenido">Contenido</label>
        <textarea name="contenido" id="contenido" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="categoria">Categoría</label>
        <select name="categoria" id="categoria" class="form-control">
            <option value="">Seleccione una categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="subcategoria">Subcategoría</label>
        <select name="subcategoria" id="subcategoria" class="form-control" disabled>
            <option value="">Seleccione una subcategoría</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Crear post</button>
</form> --}}


<div class="form-group">
    <label for="titulo">Título</label>
    <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $post->titulo ?? '') }}">
    @error('titulo')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea class="form-control" id="contenido" name="contenido">{{ old('contenido', $post->contenido ?? '') }}</textarea>
    @error('contenido')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="categoria">Categoría</label>
    <select class="form-control" id="categoria" name="categoria" onchange="actualizarSubcategorias()">
        <option value="">Selecciona una categoría</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ old('categoria', $post->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
    @error('categoria')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="subcategoria">Subcategoría</label>
    <select class="form-control" id="subcategoria" name="subcategoria @error('subcategoria') is-invalid @enderror">
        <option value="">Selecciona una subcategoría</option>
            @foreach ($subcategorias as $subcategoria)
                <option value="{{ $subcategoria->id }}" {{ old('subcategoria', $post->subcategoria_id ?? '') == $subcategoria->id ? 'selected' : '' }}>
                    {{ $subcategoria->nombre }}
                </option>
            @endforeach
    </select>
    @error('subcategoria')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


@push('scripts')
    <script>
        function actualizarSubcategorias() {
            var categoria_id = document.getElementById('categoria').value;

            fetch('/subcategorias/' + categoria_id)
                .then(response => response.json())
                .then(data => {
                    var subcategoria_select = document.getElementById('subcategoria');
                    subcategoria_select.innerHTML = '';

                    var opcion_vacia = document.createElement('option');
                    opcion_vacia.value = '';
                    opcion_vacia.textContent = 'Selecciona una subcategoría';
                    subcategoria_select.appendChild(opcion_vacia);

                    data.forEach(subcategoria => {
                        var opcion = document.createElement('option');
                        opcion.value = subcategoria.id;
                        opcion.textContent = subcategoria.nombre;
                        subcategoria_select.appendChild(opcion);
                    });
                });
        }

        actualizarSubcategorias();
    </script>
@endpush