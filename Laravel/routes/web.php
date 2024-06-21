<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('usuarios.index');
});


// routes/web.php

use Illuminate\Support\Facades\Http;

Route::get('/usuarios', function () {
    $response = Http::get('http://localhost:3100/usuarios');
    $usuarios = $response->json();

    return view('usuarios.index', compact('usuarios'));
});

Route::get('/usuarios/active', function () {
    $response = Http::get('http://localhost:3100/usuarios/active');
    $usuarios = $response->json();

    return view('usuarios.active', compact('usuarios'));
});

Route::get('/usuarios/inactive', function () {
    $response = Http::get('http://localhost:3100/usuarios/inactive');
    $usuarios = $response->json();

    return view('usuarios.inactive', compact('usuarios'));
});

Route::get('/usuarios/{id}', function ($id) {
    $response = Http::get("http://localhost:3100/usuarios/{$id}");
    $usuario = $response->json();

    return view('usuarios.show', compact('usuario'));
});

Route::get('/usuarios/{id}/editar', function ($id) {
    $response = Http::get("http://localhost:3100/usuarios/{$id}");
    $usuario = $response->json();

    return view('usuarios.edit', compact('usuario'));
});

// routes/web.php



Route::get('/usuarios', function () {
    return view('usuarios.index');
})->name('usuarios.index');

Route::get('/usuarios/crear', function () {
    return view('usuarios.create');
})->name('usuarios.create');

// Otras rutas para mostrar, editar, actualizar y eliminar usuarios


Route::post('/usuarios', function (Request $request) {
    $response = Http::post('http://localhost:3100/usuarios', [
        'json' => $request->all()
    ]);

    return redirect()->route('usuarios.index');
});

Route::put('/usuarios/{id}', function (Request $request, $id) {
    $response = Http::put("http://localhost:3100/usuarios/{$id}", [
        'json' => $request->all()
    ]);

    return redirect()->route('usuarios.index');
});

Route::delete('/usuarios/{id}', function ($id) {
    $response = Http::delete("http://localhost:3100/usuarios/{$id}/delete/logical");

    return redirect()->route('usuarios.index');
});
