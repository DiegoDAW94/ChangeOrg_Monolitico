@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>
            @if(isset($peticion))
                Petición ID: {{ $peticion->id }} - {{ $peticion->titulo }}
            @else
                Nueva Petición
            @endif
        </h2>
        <form action="{{ isset($peticion) ? route('admin.peticiones.update', $peticion->id) : route('admin.peticiones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($peticion))
                @method('PUT') <!-- Usar método PUT para editar -->
            @endif

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" name="titulo"
                       class="form-control @error('titulo') is-invalid @enderror"
                       value="{{ isset($peticion) ? $peticion->titulo : old('titulo') }}"
                       required>
                @error('titulo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3"
                          class="form-control @error('descripcion') is-invalid @enderror"
                          required>{{ isset($peticion) ? $peticion->descripcion : old('descripcion') }}</textarea>
                @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="destinatario" class="form-label">Destinatario</label>
                <input type="text" id="destinatario" name="destinatario"
                       class="form-control @error('destinatario') is-invalid @enderror"
                       value="{{ isset($peticion) ? $peticion->destinatario : old('destinatario') }}"
                       required>
                @error('destinatario')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ isset($peticion) && $peticion->categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Imagen</label>
                <input type="file" id="file" name="file"
                       class="form-control @error('file') is-invalid @enderror">
                @if(isset($peticion) && $peticion->imagen)
                    <p>Imagen actual: <a href="{{ asset('storage/' . $peticion->imagen) }}" target="_blank">Ver imagen</a></p>
                @endif
                @error('file')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                {{ isset($peticion) ? 'Actualizar Petición' : 'Crear Petición' }}
            </button>
        </form>
    </div>
@endsection
