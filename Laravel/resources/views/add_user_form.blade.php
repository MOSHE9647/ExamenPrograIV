<div class="card">
    <div class="card-body">
        <h3 class="card-title">Agregar Usuario</h3>
        <form class='container' id="addUserForm" onsubmit="createUser(event)">
            <div class="row">
                <div class="col-md-4">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required />
                </div>
                <div class="col-md-4">
                    <label>Apellido:</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required />
                </div>
                <div class="col-md-4">
                    <label>Cédula:</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" required />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required />
                </div>
                <div class="col-md-6">
                    <label>Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required />
                </div>
            </div>
            <fieldset formGroupName="direccion">
                <div class="row">
                    <div class="col-md-4">
                        <label>Provincia:</label>
                        <input type="text" class="form-control" id="provincia" name="direccion.provincia" required />
                    </div>
                    <div class="col-md-4">
                        <label>Cantón:</label>
                        <input type="text" class="form-control" id="canton" name="direccion.canton" required />
                    </div>
                    <div class="col-md-4">
                        <label>Distrito:</label>
                        <input type="text" class="form-control" id="distrito" name="direccion.distrito" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Barrio:</label>
                        <input type="text" class="form-control" id="barrio" name="direccion.barrio" required />
                    </div>
                    <div class="col-md-6">
                        <label>Información Adicional:</label>
                        <input type="text" class="form-control" id="informacionAdicional"
                            name="direccion.informacionAdicional" />
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col-md-12">
                    <label>Tipo de Usuario:</label>
                    <select class="form-control" id="tipo" name="tipo" required>
                        <option value="Normal">Normal</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required />
                </div>
                <div class="col-md-6">
                    <label>Confirmar Contraseña:</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Usuario</button>
            <button type="button" class="btn btn-danger" onclick="hideAddForm()">Cancelar</button>
        </form>
    </div>
</div>

<script>
    async function createUser(event) {
        event.preventDefault();
        if (validarPasswords()) {
            const form = document.getElementById('addUserForm');
            const formData = new FormData(form);
            const user = Object.fromEntries(formData.entries());

            const formattedUser = {
                estado: true,
                nombre: user.nombre,
                apellido: user.apellido,
                cedula: user.cedula,
                telefono: user.telefono,
                email: user.email,
                tipo: user.tipo,
                password: user.password,
                direccion: {
                    provincia: user['direccion.provincia'],
                    canton: user['direccion.canton'],
                    distrito: user['direccion.distrito'],
                    barrio: user['direccion.barrio'],
                    informacionAdicional: user['direccion.informacionAdicional']
                }
            };

            try {
                const response = await api.post('/usuarios', formattedUser);
                console.log(response);
                if (response.data.data.success) {
                    mostrarMensaje(response.data.data.title, response.data.data.message, response.data.data.type);
                    window.location.href = '{{ route("user.index") }}';
                } else {
                    mostrarMensaje(response.data.data.title, response.data.data.message, response.data.data.type);
                }
            } catch (error) {
                console.error('Error al crear el usuario:', error);
                mostrarMensaje('Error inesperado', 'Ocurrió un error al crear el Usuario', 'error');
            }
        }
    }

    function hideAddForm() {
        window.location.href = '{{ route("user.index") }}';
    }
</script>