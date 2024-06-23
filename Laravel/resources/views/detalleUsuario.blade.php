<!DOCTYPE html>
<html>
<head>
    <title>Detalles del Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Detalles del Usuario</h1>
        @if (!empty($usuario))
            <p>Nombre: {{ $usuario['nombre'] }}</p>
            <p>Apellido: {{ $usuario['apellido'] }}</p>
            <p>Cédula: {{ $usuario['cedula'] }}</p>
            <p>Teléfono: {{ $usuario['telefono'] }}</p>
            <p>Email: {{ $usuario['email'] }}</p>
            <p>Dirección:</p>
            <ul>
                <li>Provincia: {{ $usuario['direccion']['provincia'] }}</li>
                <li>Cantón: {{ $usuario['direccion']['canton'] }}</li>
                <li>Distrito: {{ $usuario['direccion']['distrito'] }}</li>
                <li>Barrio: {{ $usuario['direccion']['barrio'] }}</li>
                <li>Información Adicional: {{ $usuario['direccion']['informacionAdicional'] }}</li>
            </ul>
            <p>Tipo de Usuario: {{ $usuario['tipo'] }}</p>
        @else
            <p>Usuario no encontrado.</p>
        @endif
    </div>
</body>
</html>
