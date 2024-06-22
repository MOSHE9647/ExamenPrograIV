<!-- resources/views/proveedor.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .card-custom {
            background-color: #f8f9fa;
            border: 1px solid #e3e6f0;
        }
        .card-header-custom {
            background-color: #007bff;
            color: white;
        }
        .card-body-custom {
            background-color: #fdfdfe;
        }
        .text-orange {
            color: #ff7f0e;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card card-custom">
            <div class="card-header card-header-custom">
                <h5 class="mb-0">Información del Proveedor</h5>
            </div>
            <div class="card-body card-body-custom">
                <div class="row mb-3">
                    <div class="col-sm-3"><strong class="text-orange">Nombre:</strong></div>
                    <div class="col-sm-9">{{ $proveedor['nombreProveedor'] }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong class="text-orange">Teléfono:</strong></div>
                    <div class="col-sm-9">{{ $proveedor['telefonoProveedor'] }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong class="text-orange">Descripción:</strong></div>
                    <div class="col-sm-9">{{ $proveedor['descripcionProveedor'] }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong class="text-orange">Correo Electrónico:</strong></div>
                    <div class="col-sm-9">{{ $proveedor['correo'] }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong class="text-orange">Dirección:</strong></div>
                    <div class="col-sm-9">{{ $proveedor['direccionProveedor'] }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong class="text-orange">Categoría del Servicio:</strong></div>
                    <div class="col-sm-9">{{ $proveedor['categoriaServicio'] }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-3"><strong class="text-orange">Información Adicional:</strong></div>
                    <div class="col-sm-9">{{ $proveedor['informacionAdicional'] }}</div>
                </div>
                <input type="button" value="Cerrar" onclick="window.location.href = '/'" class="btn btn-danger">
            </div>
        </div>
    </div>
</body>
</html>