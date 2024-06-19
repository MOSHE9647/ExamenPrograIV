@extends('layouts.app')

@section('title', 'Listado de Usuarios')

@section('content')
    <h1>Listado de Usuarios</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Cédula</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="usuarios-table">
            <!-- Aquí se cargarán los usuarios con JavaScript -->
        </tbody>
    </table>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/usuarios')
                .then(response => response.json())
                .then(data => {
                    const usuariosTable = document.getElementById('usuarios-table');
                    usuariosTable.innerHTML = '';
                    data.forEach(usuario => {
                        usuariosTable.innerHTML += `
                            <tr>
                                <td>${usuario.id}</td>
                                <td>${usuario.nombre}</td>
                                <td>${usuario.apellido}</td>
                                <td>${usuario.cedula}</td>
                                <td>${usuario.telefono}</td>
                                <td>${usuario.email}</td>
                                <td>
                                    <a href="/usuarios/${usuario.id}/edit" class="btn btn-primary btn-sm">Actualizar</a>
                                    <a href="/usuarios/${usuario.id}" class="btn btn-info btn-sm">Desplegar Usuario</a>
                                    <button class="btn btn-danger btn-sm" onclick="eliminarUsuario(${usuario.id})">Eliminar</button>
                                </td>
                            </tr>
                        `;
                    });
                })
                .catch(error => console.error('Error:', error));
        });

        function eliminarUsuario(id) {
            fetch(`/usuarios/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert('Usuario eliminado con éxito');
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
