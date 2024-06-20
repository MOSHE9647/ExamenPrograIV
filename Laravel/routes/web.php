use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('index');
});

// Ruta para Vue.js (simplemente redirige a Vue por ahora)
Route::get('/usuarios/vue', function () {
    return "Redirigir a la aplicación Vue.js"; // Aquí puedes redirigir a la ruta Vue.js correspondiente
});

// Ruta para Laravel
Route::get('/usuarios/laravel', function () {
    return view('usuarios.laravel');
});

// Ruta para obtener los usuarios
Route::get('/usuarios', function () {
    // Simulación de datos de usuarios
    $usuarios = [
        ['id' => 1, 'nombre' => 'Juan', 'apellido' => 'Pérez', 'cedula' => '12345678', 'telefono' => '+506 1234 5678', 'email' => 'juan@example.com'],
        ['id' => 2, 'nombre' => 'Ana', 'apellido' => 'Gómez', 'cedula' => '87654321', 'telefono' => '+506 8765 4321', 'email' => 'ana@example.com'],
    ];

    return response()->json($usuarios);
});

// Rutas para las acciones de usuario
Route::get('/usuarios/{id}/edit', function ($id) {
    return "Formulario para editar usuario con ID: $id"; // Aquí iría la vista de edición
});

Route::get('/usuarios/{id}', function ($id) {
    return "Detalles del usuario con ID: $id"; // Aquí iría la vista de detalles del usuario
});

Route::delete('/usuarios/{id}', function ($id) {
    return response()->json(['success' => true, 'message' => 'Usuario eliminado con éxito']);
});
