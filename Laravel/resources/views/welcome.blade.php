<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Lista de Usuarios</h1>
        @if (!empty($usuarios))
            <ul class="list-group">
                @foreach ($usuarios as $usuario)
                    <li class="list-group-item">
                        {{ $usuario['nombre'] }} {{ $usuario['apellido'] }}
                        <a href="/detalleUsuario/{{ $usuario['id'] }}" class="btn btn-info btn-sm ml-3">Detalles</a>
                        <a href="/editarUsuario/{{ $usuario['id'] }}" class="btn btn-warning btn-sm ml-3">Editar</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No hay usuarios disponibles.</p>
        @endif
    </div>
</body>
</html>
