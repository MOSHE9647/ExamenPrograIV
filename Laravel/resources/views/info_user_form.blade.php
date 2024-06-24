<div class="card">
    <div class="card-body">
        <h3 class="card-title">Información del Usuario</h3>
        <?php if ($selectedUser): ?>
            <form class="container">
                <div class="row">
                    <div class="col-md-4">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" value="{{ $selectedUser['nombre'] }}" readonly />
                    </div>
                    <div class="col-md-4">
                        <label>Apellido:</label>
                        <input type="text" class="form-control" value="{{ $selectedUser['apellido'] }}" readonly />
                    </div>
                    <div class="col-md-4">
                        <label>Cédula:</label>
                        <input type="text" class="form-control" value="{{ $selectedUser['cedula'] }}" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Teléfono:</label>
                        <input type="text" class="form-control" value="{{ $selectedUser['telefono'] }}" readonly />
                    </div>
                    <div class="col-md-6">
                        <label>Email:</label>
                        <input type="email" class="form-control" value="{{ $selectedUser['email'] }}" readonly />
                    </div>
                </div>
                <fieldset>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Provincia:</label>
                            <input type="text" class="form-control" value="{{ $selectedUser['direccion']['provincia'] }}" readonly />
                        </div>
                        <div class="col-md-4">
                            <label>Cantón:</label>
                            <input type="text" class="form-control" value="{{ $selectedUser['direccion']['canton'] }}" readonly />
                        </div>
                        <div class="col-md-4">
                            <label>Distrito:</label>
                            <input type="text" class="form-control" value="{{ $selectedUser['direccion']['distrito'] }}" readonly />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Barrio:</label>
                            <input type="text" class="form-control" value="{{ $selectedUser['direccion']['barrio'] }}" readonly />
                        </div>
                        <div class="col-md-6">
                            <label>Información Adicional:</label>
                            <input type="text" class="form-control" value="{{ $selectedUser['direccion']['informacionAdicional'] ?? '' }}" readonly />
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col-md-6">
                        <label>Estado:</label>
                        <select class="form-control" disabled>
                            <option value="true" {{ $selectedUser['estado'] ? 'selected' : '' }}>Activo</option>
                            <option value="false" {{ !$selectedUser['estado'] ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Fecha de Creación:</label>
                        <input type="datetime-local" class="form-control" value="{{ $selectedUser['fechaCreacion'] ? date('Y-m-d\TH:i', strtotime($selectedUser['fechaCreacion'])) : '' }}" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Contraseña:</label>
                        <input type="password" class="form-control" value="{{ $selectedUser['password'] }}" readonly />
                    </div>
                    <div class="col-md-6">
                        <label>Tipo de Usuario:</label>
                        <select class="form-control" disabled>
                            <option value="Normal" {{ $selectedUser['tipo'] === 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Administrador" {{ $selectedUser['tipo'] === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        </select>
                    </div>
                </div>
                <button type="button" class="btn btn-danger" onclick="hideInfoForm()">Cancelar</button>
            </form>
        <?php else : ?>
            <h6 class="card-title">Usuario no encontrado</h6>
        <?php endif; ?>
    </div>
</div>

<script>
    function hideInfoForm() {
        window.location.href = '{{ route("user.index") }}';
    }
</script>