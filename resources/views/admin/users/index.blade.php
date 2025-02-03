@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Usuarios</h4>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <!-- Botón para editar -->
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm">Editar</a>

                            <!-- Botón para borrar -->
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline">
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
            {{ $users->links() }}
        </div>
    </div>
@endsection

