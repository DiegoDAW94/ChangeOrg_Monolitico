@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Categorías</h4>
            <a href="{{ route('admin.categorias.create') }}" class="btn btn-primary">Nueva Categoría</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td>
                            <!-- Botón para editar -->
                            <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-success btn-sm">Editar</a>

                            <!-- Botón para borrar -->
                            <form action="{{ route('admin.categorias.delete', $categoria->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!-- Paginación -->
            {{ $categorias->links() }}
        </div>
    </div>
@endsection
