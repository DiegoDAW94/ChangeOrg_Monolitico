@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Listado de Peticiones</h4>
            <a href="{{ route('admin.peticiones.create') }}" class="btn btn-primary">Nueva Petición</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Usuario (ID)</th>
                    <th>Estado</th>
                    <th>Firmantes</th>
                </tr>
                </thead>
                <tbody>
                @foreach($peticiones as $peticion)
                    <tr onclick="window.location='{{ route('admin.peticiones.show', $peticion->id) }}'" style="cursor: pointer;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $peticion->titulo }}</td>
                        <td>{{ $peticion->descripcion }}</td>
                        <td>
                            @if($peticion->user)
                                {{ $peticion->user->name }} ({{ $peticion->user->id }})
                            @else
                                Usuario no encontrado
                            @endif
                        </td>
                        <td>{{ $peticion->estado }}</td>
                        <td>{{ $peticion->firmantes }}</td>
                        <td>
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
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $peticiones->links() }}
        </div>
    </div>
@endsection
