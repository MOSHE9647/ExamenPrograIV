<?php
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Hacer la solicitud GET a tu aplicación Node.js para obtener la lista de usuarios
    $response = Http::get('http://localhost:3100/usuarios');

    // Verificar si la solicitud fue exitosa y obtener la lista de usuarios
    if ($response->ok()) {
        $usuarios = $response->json();
        // Pasar la lista de usuarios a la vista
        return view('welcome', ['usuarios' => $usuarios]);
    } else {
        // Manejar el error si la solicitud falla
        return response()->json(['error' => 'Error al obtener la lista de usuarios desde Node.js'], 500);
    }
});

Route::get('/editarUsuario/{id}', function ($id) {
    // Hacer la solicitud GET a tu aplicación Node.js para obtener el usuario por ID
    $response = Http::get("http://localhost:3100/usuarios/{$id}");

    // Verificar si la solicitud fue exitosa y obtener los detalles del usuario
    if ($response->ok()) {
        $usuario = $response->json();
        // Pasar los detalles del usuario a la vista
        return view('editarUsuario', ['usuario' => $usuario]);
    } else {
        // Manejar el error si la solicitud falla
        return response()->json(['error' => 'Error al obtener los detalles del usuario desde Node.js'], 500);
    }
});

Route::get('/detalleUsuario/{id}', function ($id) {
    // Hacer la solicitud GET a tu aplicación Node.js para obtener el usuario por ID
    $response = Http::get("http://localhost:3100/usuarios/{$id}");

    // Verificar si la solicitud fue exitosa y obtener los detalles del usuario
    if ($response->ok()) {
        $usuario = $response->json();
        // Pasar los detalles del usuario a la vista
        return view('detalleUsuario', ['usuario' => $usuario]);
    } else {
        // Manejar el error si la solicitud falla
        return response()->json(['error' => 'Error al obtener los detalles del usuario desde Node.js'], 500);
    }
});
