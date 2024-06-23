<!DOCTYPE html>
<html xmls:th="http://thymeleaf.org">
<head>
    <title>Editar Proveedor</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JS de Bootstrap (opcional, para funcionalidades como dropdowns, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/scriptProveedores.js') }}"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-primary">Editar Información de proveedor</h1>
    </div>

    <div class="container">
        <form action="http://localhost:3000/editarProveedor" method="POST" class="editForm" id="editForm">
            @method('PUT')
            @csrf
            <input type="hidden" name="proveedor" id="id" value="{{ $proveedor['idProveedor'] }}">
            
            <div class="form-group">
                <label for="nombre" class="text">Nombre: </label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $proveedor['nombreProveedor'] }}" required>
            </div>
            
            <div class="form-group">
                <label for="telefono" class="text">Teléfono: </label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $proveedor['telefonoProveedor'] }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion" class="text">Descripción: </label>
                <textarea name="descripcion" id="descripcion" class="form-control" required>{{ $proveedor['descripcionProveedor'] }}</textarea>
            </div>

            <div class="form-group">
                <label for="correo" class="text">Correo: </label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ $proveedor['correo'] }}" required>
            </div>

            <div class="form-group">
                <label for="direccion" class="text">Dirección: </label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $proveedor['direccionProveedor'] }}" required>
            </div>

            <div class="form-group">
                <label for="categoria" class="text">Categoría: </label>
                <input type="text" name="categoria" id="categoria" class="form-control" value="{{ $proveedor['categoriaServicio'] }}" required>
            </div>

            <div class="form-group">
                <label for="informacionadicional" class="text">Información adicional: </label>
                <textarea name="informacionadicional" id="informacionadicional" class="form-control" required>{{ $proveedor['informacionAdicional'] }}</textarea>
            </div>

            <br>
            <input type="submit" class="btn btn-primary" value="Actualizar" onclick="submitFormProveedor()">
            <input type="button" value="Cancelar" onclick="window.location.href = '/'" class="btn btn-danger">
        </form>
        <br><br>
        <div class="container" id="mensaje_container"></div>
    </div>
</body>
</html>