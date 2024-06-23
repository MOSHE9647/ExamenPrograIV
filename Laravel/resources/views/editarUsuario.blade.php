<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Editar Usuario</h1>
        @if (!empty($usuario))
            <form action="/actualizarUsuario/{{ $usuario['id'] }}" method="POST" class="container">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" name="nombre" value="{{ $usuario['nombre'] }}" required />
                    </div>
                    <div class="col-md-4">
                        <label>Apellido:</label>
                        <input type="text" class="form-control" name="apellido" value="{{ $usuario['apellido'] }}" required />
                    </div>
                    <div class="col-md-4">
                        <label>Cédula:</label>
                        <input type="text" class="form-control" name="cedula" value="{{ $usuario['cedula'] }}" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" value="{{ $usuario['telefono'] }}" required />
                    </div>
                    <div class="col-md-6">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" value="{{ $usuario['email'] }}" required />
                    </div>
                </div>
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Provincia:</label>
                            <input type="text" class="form-control" name="provincia" value="{{ $usuario['direccion']['provincia'] }}" required />
                        </div>
                        <div class="col-md-4">
                            <label>Cantón:</label>
                            <input type="text" class="form-control" name="canton" value="{{ $usuario['direccion']['canton'] }}" required />
                        </div>
                        <div class="col-md-4">
                            <label>Distrito:</label>
                            <input type="text" class="form-control" name="distrito" value="{{ $usuario['direccion']['distrito'] }}" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Barrio:</label>
                            <input type="text" class="form-control" name="barrio" value="{{ $usuario['direccion']['barrio'] }}" required />
                        </div>
                        <div class="col-md-6">
                            <label>Información Adicional:</label>
                            <input type="text" class="form-control" name="informacionAdicional" value="{{ $usuario['direccion']['informacionAdicional'] }}" />
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-md-12">
                        <label>Tipo de Usuario:</label>
                        <select class="form-control" name="tipo" required>
                            <option value="Normal" {{ $usuario['tipo'] == 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Administrador" {{ $usuario['tipo'] == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Contraseña:</label>
                        <input type="password" class="form-control" name="password" required />
                    </div>
                    <div class="col-md-6">
                        <label>Confirmar Contraseña:</label>
                        <input type="password" class="form-control" name="confirmPassword" required />
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    <a href="/" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        @else
            <p>Usuario no encontrado.</p>
        @endif
    </div>
</body>
</html>
