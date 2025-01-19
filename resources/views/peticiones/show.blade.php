@extends('layouts.public')

@section('content')
    <div class="container mt-4">
        <h1>{{ $peticion->titulo }}</h1>

        <p>{{ $peticion->descripcion }}</p>
        <img src="{{ asset('peticiones/' . $peticion->files->file_path) }}" style="max-width: 20em; height: 20em;" alt="imagen peticion">

        <small>Estado: {{ $peticion->estado }}</small>
        <br>
        <small>{{ $peticion->firmas()->count() }} personas han firmado esta petición.</small>

        <!-- Verificar si el usuario ya firmó la petición -->
        @if(auth()->check() && !$peticion->firmas->contains(auth()->user()))
            <form action="{{ route('peticiones.firmar', $peticion->id) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-success mt-3">Firmar</button>
            </form>
        @elseif(auth()->check())
            <p>Ya has firmado esta petición.</p>
        @endif

        <!-- Botón de Volver -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
@endsection
