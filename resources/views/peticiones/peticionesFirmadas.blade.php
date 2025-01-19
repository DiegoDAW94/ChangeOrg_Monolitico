@extends('layouts.public')

@section('content')
    <div class="container mt-4">
        <h1>Peticiones Firmadas</h1>

        @if ($peticiones->isEmpty())
            <p>No has firmado ninguna petición aún.</p>
        @else
            <div class="list-group">
                @foreach($peticiones as $peticion)
                    <div class="list-group-item">
                        <h5 class="mb-1">{{ $peticion->titulo }}</h5>
                        <p class="mb-1">{{ $peticion->descripcion }}</p>
                        <img src="{{ asset('peticiones/' . $peticion->files->file_path) }}" style="max-width: 20em; height: 20em;" alt="imagen peticion">

                        <small>Estado: {{ $peticion->estado }}</small>
                        <br>
                        <small>{{ $peticion->firmas()->count() }} personas han firmado esta petición.</small>
                        <br>
                        <a href="{{ route('peticiones.show', $peticion->id) }}" class="btn btn-danger mt-2">Entrar</a>
                    </div>
                    <br>
                @endforeach
            </div>
        @endif
    </div>
@endsection
