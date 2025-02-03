@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Detalles de la Petición</h4>
        </div>
        <div class="card-body">
            <p><strong>Título:</strong> {{ $peticion->titulo }}</p>
            <img src="{{ asset('peticiones/' . $peticion->files->file_path) }}" style="max-width: 20em; height: 20em;" alt="imagen peticion">
            <p><strong>Descripción:</strong> {{ $peticion->descripcion }}</p>
            <p><strong>Destinatario:</strong> {{ $peticion->destinatario }}</p>
            <p><strong>Estado:</strong> {{ $peticion->estado }}</p>
            <p><strong>Firmantes:</strong> {{ $peticion->firmantes }}</p>

            <a href="{{ route('admin.peticiones.edit', $peticion->id) }}" class="btn btn-success btn-sm">Editar</a>
            <form action="{{ route('admin.peticiones.delete', $peticion->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
            <form action="{{ route('admin.peticiones.estado', $peticion->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-warning btn-sm">
                    {{ $peticion->estado === 'pendiente' ? 'Aceptar' : 'Revertir' }}
                </button>
            </form>
        </div>
    </div>
@endsection
