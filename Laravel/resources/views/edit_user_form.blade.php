<div class="card">
    <div class="card-body">
        <h3 class="card-title">Editar Usuario</h3>
        <form id="editUserForm" onsubmit="updateUser(event)">
            <input type="hidden" id="editUserId" name="id" value="{{ $selectedUser['id'] }}">

            <div class="row">
                <div class="col-md-4">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="editNombre" name="nombre"
                        value="{{ $selectedUser['nombre'] }}" required>
                </div>
                <div class="col-md-4">
                    <label>Apellido:</label>
                    <input type="text" class="form-control" id="editApellido" name="apellido"
                        value="{{ $selectedUser['apellido'] }}" required>
                </div>
                <div class="col-md-4">
                    <label>Cédula:</label>
                    <input type="text" class="form-control" id="editCedula" name="cedula"
                        value="{{ $selectedUser['cedula'] }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" id="editTelefono" name="telefono"
                        value="{{ $selectedUser['telefono'] }}" required>
                </div>
                <div class="col-md-6">
                    <label>Email:</label>
                    <input type="email" class="form-control" id="editEmail" name="email"
                        value="{{ $selectedUser['email'] }}" required>
                </div>
            </div>

            <fieldset>
                <div class="row">
                    <div class="col-md-4">
                        <label>Provincia:</label>
                        <input type="text" class="form-control" id="editProvincia" name="direccion[provincia]"
                            value="{{ $selectedUser['direccion']['provincia'] }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>Cantón:</label>
                        <input type="text" class="form-control" id="editCanton" name="direccion[canton]"
                            value="{{ $selectedUser['direccion']['canton'] }}" required>
                    </div>
                    <div class="col-md-4">
                        <label>Distrito:</label>
                        <input type="text" class="form-control" id="editDistrito" name="direccion[distrito]"
                            value="{{ $selectedUser['direccion']['distrito'] }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Barrio:</label>
                        <input type="text" class="form-control" id="editBarrio" name="direccion[barrio]"
                            value="{{ $selectedUser['direccion']['barrio'] }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Información Adicional:</label>
                        <input type="text" class="form-control" id="editInformacionAdicional"
                            name="direccion[informacionAdicional]"
                            value="{{ $selectedUser['direccion']['informacionAdicional'] ?? '' }}">
                    </div>
                </div>
            </fieldset>

            <div class="row">
                <div class="col-md-6">
                    <label>Tipo de Usuario:</label>
                    <select class="form-control" id="editTipo" name="tipo" required>
                        <option value="Normal" {{ $selectedUser['tipo'] === 'Normal' ? 'selected' : '' }}>Normal</option>
                        <option value="Administrador" {{ $selectedUser['tipo'] === 'Administrador' ? 'selected' : '' }}>
                            Administrador</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Estado:</label>
                    <select class="form-control" id="editEstado" name="estado" required>
                        <option value="true" {{ $selectedUser['estado'] ? 'selected' : '' }}>Activo</option>
                        <option value="false" {{ !$selectedUser['estado'] ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label>Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-md-6">
                    <label>Confirmar Contraseña:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
            <button type="button" class="btn btn-danger" onclick="hideEditForm()">Cancelar</button>
        </form>
    </div>
</div>

<script>
    async function updateUser(event) {
        event.preventDefault();
        if (validarPasswords()) {
            const form = document.getElementById('editUserForm');
            const formData = new FormData(form);
            const user = Object.fromEntries(formData.entries());

            const formattedUser = {
                id: user.id,
                nombre: user.nombre,
                apellido: user.apellido,
                cedula: user.cedula,
                telefono: user.telefono,
                email: user.email,
                tipo: user.tipo,
                password: user.password,
                direccion: {
                    provincia: formData.get('direccion[provincia]'),
                    canton: formData.get('direccion[canton]'),
                    distrito: formData.get('direccion[distrito]'),
                    barrio: formData.get('direccion[barrio]'),
                    informacionAdicional: formData.get('direccion[informacionAdicional]')
                },
                estado: formData.get('estado') === 'true' // Conversión adecuada del estado
            };

            try {
                const response = await api.put('/usuarios', formattedUser);
                console.log(response);
                if (response.data.success) {
                    mostrarMensaje(response.data.title, response.data.message, response.data.type);
                    window.location.href = '{{ route("user.index") }}';
                } else {
                    mostrarMensaje(response.data.title, response.data.message, response.data.type);
                }
            } catch (error) {
                console.error('Error al actualizar el usuario:', error);
                mostrarMensaje('Error inesperado', 'Ocurrió un error al actualizar el Usuario', 'error');
            }
        }
    }

    function hideEditForm() {
        window.location.href = '{{ route("user.index") }}';
    }
</script>