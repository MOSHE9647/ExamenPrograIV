<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>N° Cédula</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['cedula'] }}</td>
                    <td>{{ $user['nombre'] }} {{ $user['apellido'] }}</td>
                    <td>{{ $user['telefono'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['tipo'] }}</td>
                    <td>{{ $user['estado'] ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        <button class="btn btn-info" onclick="toggleInfoFormVisibility({{ $user['id'] }})">
                            <i class="las la-info-circle"></i>
                        </button>
                        <button class="btn btn-warning" onclick="toggleEditFormVisibility({{ $user['id'] }})">
                            <i class="las la-user-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="deleteUser({{ $user['id'] }})">
                            <i class="las la-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    function toggleInfoFormVisibility(userId) {
        window.location.href = `{{ route("toggleInfoFormVisibility", ":id") }}`.replace(':id', userId);
    }
    
    function toggleEditFormVisibility(userId) {
        window.location.href = `{{ route("toggleEditFormVisibility", ":id") }}`.replace(':id', userId);
    }

    async function deleteUser(userId) {
        const confirmed = window.confirm('¿Está seguro de querer eliminar al usuario? Esta acción es permanente');
        if (confirmed && userId) {
            try {
                const response = await api.delete(`/usuarios/${userId}/delete/physical`);
                if (response.data.data.success) {
                    mostrarMensaje(response.data.data.title, response.data.data.message, response.data.data.type);
                    window.location.href = '{{ route("user.index") }}';
                } else {
                    mostrarMensaje(response.data.data.title, response.data.data.message, response.data.data.type);
                }
            } catch (error) {
                console.error('Error al eliminar el usuario:', error);
                mostrarMensaje('Error inesperado', 'Ocurrió un error al eliminar el Usuario', 'error');
            }
        }
    }
</script>