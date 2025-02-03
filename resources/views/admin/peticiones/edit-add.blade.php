@extends('layouts.public')

@section('content')
    <div class="container mt-5">
        @if (session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif
        <h2>Crear una nueva petición</h2>
        <form action="{{ route('peticiones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="validationServer01" required>
                @error('titulo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror" id="validationServer01" required></textarea>
                @error('titulo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="destinatario" class="form-label">Destinatario</label>
                <input type="text" class="form-control" id="destinatario" name="destinatario" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Sube una Imagen</label>
                <input type="file" id="file" name="file" class="btn phxxl @error('file') is-invalid @enderror" aria-describedby=""
                       placeholder="Elige una imagen" aria-required="true">
                @error('file')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-danger">Crear Petición</button>
        </form>
    </div>
@endsection
