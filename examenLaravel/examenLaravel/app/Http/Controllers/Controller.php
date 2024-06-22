<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function obtenerUsuariosDesdeNode()
    {
        // Hacer la solicitud GET a tu aplicación Node.js para obtener la lista de proveedores
        $response = Http::get('http://localhost:3100/usuarios');

        // Verificar si la solicitud fue exitosa y obtener la lista de proveedores
        if ($response->ok()) {
            $usuarios = $response->json();
            // Pasar la lista de proveedores a la vista
            return view('welcome', ['usuarios' => $usuarios]);
        } else {
            // Manejar el error si la solicitud falla
            return response()->json(['error' => 'Error al obtener la lista de usuarios desde Node.js'], 500);
        }
    }
}
