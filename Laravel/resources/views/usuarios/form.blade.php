<div class="card">
    <div class="card-body">
        <h3 class="card-title">{{ $action }} Usuario</h3>
        <form action="{{ $route }}" method="POST" class="container">
            @csrf
            @if($method !== 'POST')
                @method($method)
            @endif
            <div class="row">
                <div class="col-md-4">
                    <label>Nombre:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="nombre"
                        value="{{ old('nombre', $usuario['nombre'] ?? '') }}"
                        required
                    />
                </div>
                <div class="col-md-4">
                    <label>Apellido:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="apellido"
                        value="{{ old('apellido', $usuario['apellido'] ?? '') }}"
                        required
                    />
                </div>
                <div class="col-md-4">
                    <label>Cédula:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="cedula"
                        value="{{ old('cedula', $usuario['cedula'] ?? '') }}"
                        required
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Teléfono:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="telefono"
                        value="{{ old('telefono', $usuario['telefono'] ?? '') }}"
                        required
                    />
                </div>
                <div class="col-md-6">
                    <label>Email:</label>
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        value="{{ old('email', $usuario['email'] ?? '') }}"
                        required
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>Provincia:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="direccion[provincia]"
                        value="{{ old('direccion.provincia', $usuario['direccion']['provincia'] ?? '') }}"
                        required
                    />
                </div>
                <div class="col-md-4">
                    <label>Cantón:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="direccion[canton]"
                        value="{{ old('direccion.canton', $usuario['direccion']['canton'] ?? '') }}"
                        required
                    />
                </div>
                <div class="col-md-4">
                    <label>Distrito:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="direccion[distrito]"
                        value="{{ old('direccion.distrito', $usuario['direccion']['distrito'] ?? '') }}"
                        required
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Barrio:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="direccion[barrio]"
                        value="{{ old('direccion.barrio', $usuario['direccion']['barrio'] ?? '') }}"
                    />
                </div>
                <div class="col-md-6">
                    <label>Información Adicional:</label>
                    <input
                        type="text"
                        class="form-control"
                        name="direccion[informacionAdicional]"
                        value="{{ old('direccion.informacionAdicional', $usuario['direccion']['informacionAdicional'] ?? '') }}"
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Tipo de Usuario:</label>
                    <select
                        class="form-control"
                        name="tipo"
                        required
                    >
                        <option value="Normal" {{ old('tipo', $usuario['tipo'] ?? '') === 'Normal' ? 'selected' : '' }}>Normal</option>
                        <option value="Administrador" {{ old('tipo', $usuario['tipo'] ?? '') === 'Administrador' ? 'selected' : '' }}>Administrador</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Contraseña:</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        {{ $method === 'POST' ? 'required' : '' }}
                    />
                </div>
                <div class="col-md-6">
                    <label>Confirmar Contraseña:</label>
                    <input
                        type="password"
                        class="form-control"
                        name="password_confirmation"
                        {{ $method === 'POST' ? 'required' : '' }}
                    />
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">{{ $action }}</button>
        </form>
    </div>
</div>
