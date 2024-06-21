@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Agregar Usuario</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>N° Cédula</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario['id'] }}</td>
                    <td>{{ $usuario['cedula'] }}</td>
                    <td>{{ $usuario['nombre'] }} {{ $usuario['apellido'] }}</td>
                    <td>{{ $usuario['telefono'] }}</td>
                    <td>{{ $usuario['email'] }}</td>
                    <td>{{ $usuario['tipo'] }}</td>
                    <td>{{ $usuario['estado'] ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        <a href="{{ route('usuarios.show', $usuario['id']) }}" class="btn btn-info btn-sm mr-2">Ver</a>
                        <a href="{{ route('usuarios.edit', $usuario['id']) }}" class="btn btn-warning btn-sm mr-2">Editar</a>
                        <form action="{{ route('usuarios.destroy', $usuario['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
