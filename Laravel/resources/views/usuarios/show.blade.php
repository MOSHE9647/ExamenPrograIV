@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles del Usuario</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID:</th>
            <td>{{ $usuario['id'] }}</td>
        </tr>
        <tr>
            <th>Nombre:</th>
            <td>{{ $usuario['nombre'] }} {{ $usuario['apellido'] }}</td>
        </tr>
        <tr>
            <th>Cédula:</th>
            <td>{{ $usuario['cedula'] }}</td>
        </tr>
        <tr>
            <th>Teléfono:</th>
            <td>{{ $usuario['telefono'] }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $usuario['email'] }}</td>
        </tr>
        <tr>
            <th>Tipo:</th>
            <td>{{ $usuario['tipo'] }}</td>
        </tr>
        <tr>
            <th>Estado:</th>
            <td>{{ $usuario['estado'] ? 'Activo' : 'Inactivo' }}</td>
        </tr>
        <tr>
            <th>Dirección:</th>
            <td>
                Provincia: {{ $usuario['direccion']['provincia'] }}<br>
                Cantón: {{ $usuario['direccion']['canton'] }}<br>
                Distrito: {{ $usuario['direccion']['distrito'] }}<br>
                Barrio: {{ $usuario['direccion']['barrio'] }}<br>
                Información Adicional: {{ $usuario['direccion']['informacionAdicional'] }}
            </td>
        </tr>
    </table>
    <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
