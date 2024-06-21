<div class="card">
    <div class="card-body">
        <h3 class="card-title">Editar Usuario</h3>
        <form class='container' id="form-add-user" action="{{ route('users.update', $user->id ?? '') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4">
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="nombre" value="{{ $user->nombre ?? '' }}" required />
                </div>
                <div class="col-md-4">
                    <label>Apellido:</label>
                    <input type="text" class="form-control" name="apellido" value="{{ $user->apellido ?? '' }}" required />
                </div>
                <div class="col-md-4">
                    <label>Cédula:</label>
                    <input type="text" class="form-control" name="cedula" value="{{ $user->cedula ?? '' }}" required />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" value="{{ $user->telefono ?? '' }}" required />
                </div>
                <div class="col-md-6">
                    <label>Email:</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email ?? '' }}" required />
                </div>
            </div>
            <fieldset>
                <legend>Dirección</legend>
                <div class="row">
                    <div class="col-md-4">
                        <label>Provincia:</label>
                        <input type="text" class="form-control" name="provincia" required />
                    </div>
                    <div class="col-md-4">
                        <label>Cantón:</label>
                        <input type="text" class="form-control" name="canton" required />
                    </div>
                    <div class="col-md-4">
                        <label>Distrito:</label>
                        <input type="text" class="form-control" name="distrito" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Barrio:</label>
                        <input type="text" class="form-control" name="barrio" required />
                    </div>
                    <div class="col-md-6">
                        <label>Información Adicional:</label>
                        <input type="text" class="form-control" name="informacionAdicional" />
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col-md-6">
                    <label>Tipo de Usuario:</label>
                    <select class="form-control" name="tipo" value="{{ $user->tipo ?? '' }}" required>
                        <option value="Normal">Normal</option>
                        <option value="Administrador">Administrador</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Estado:</label>
                    <select class="form-control" name="estado" required>
                    <option value="1" {{ ($user->estado ?? '') == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ ($user->estado ?? '') == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Contraseña:</label>
                    <input type="password" class="form-control" name="password" value="{{ $user->password ?? '' }}" required />
                </div>
                <div class="col-md-6">
                    <label>Confirmar Contraseña:</label>
                    <input type="password" class="form-control" name="confirmPassword" required />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-danger" id="btn-cancel" onclick="toggleEditFormVisibility()">Cancelar</button>
        </form>
    </div>
</div>