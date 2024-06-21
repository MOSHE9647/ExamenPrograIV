<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
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
                <td>{{ $user->id }}</td>
                <td>{{ $user->cedula }}</td>
                <td>{{ $user->nombre }} {{ $user->apellido }}</td>
                <td>{{ $user->telefono }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->tipo }}</td>
                <td>{{ $user->estado ? 'Activo' : 'Inactivo' }}</td>
                <td>
                    <button class="btn btn-info btn-sm mr-2" onclick="toggleInfoFormVisibility({{ $user }})">
                        <i class="las la-info-circle"></i>
                    </button>
                    <button class="btn btn-warning btn-sm mr-2" onclick="toggleEditFormVisibility({{ $user }})">
                        <i class="las la-user-edit"></i>
                    </button>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="las la-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
