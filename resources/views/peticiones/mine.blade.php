@extends('layouts.public')

@section('content')
<div class="container mt-4">
    <h1>Mis Peticiones</h1>
    <div class="list-group">
        @if ($peticiones->isEmpty())
        <p class="text-muted">No has creado ninguna petición todavía.</p>
        @else
        @foreach($peticiones as $peticion)
        <div class="list-group-item">
            <h5 class="mb-1">{{ $peticion->titulo }}</h5>
            <p class="mb-1">{{ $peticion->descripcion }}</p>
            <img src="{{ asset('peticiones/' . $peticion->files->file_path) }}" style="max-width: 20em; height: 20em;" alt="imagen peticion">

            <small>Estado: {{ $peticion->estado }}</small>
            <a href="{{ route('peticiones.show', $peticion->id) }}" class="btn btn-primary btn-sm mt-2">Ver más</a>
        </div>
        <br>
        @endforeach
        @endif
    </div>
</div>
@endsection
