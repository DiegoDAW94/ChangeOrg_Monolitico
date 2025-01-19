@extends('layouts.public')

@section('content')
    <div class="container mt-4">
        <h1>Peticiones</h1>
        <div class="list-group">
            @foreach($peticiones as $peticion)
                    <h5 class="mb-1">{{ $peticion->titulo }}</h5>
                    <p class="mb-1">{{ $peticion->descripcion }}</p>
                <img src="{{ asset('peticiones/' . $peticion->files->file_path) }}" style="max-width: 20em; height: 20em;" alt="imagen peticion">
                    <small>Estado: {{ $peticion->estado }}</small>
                    <a href ="{{route('peticiones.show', $peticion-> id)}}" class="btn btn-danger">Entrar</a>
            @endforeach
        </div>
    </div>
@endsection
