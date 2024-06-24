<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    protected $apiBaseUrl = 'http://localhost:3100';

    public function getAllUsers()
    {
        try {
            $response = Http::get($this->apiBaseUrl . '/usuarios');
            // Verifica el estado de la respuesta
            if ($response->successful()) {
                return $response->json();
            } else {
                // Maneja el caso en que la respuesta no sea exitosa
                return ['success' => false, 'message' => 'Error al obtener el usuario: ' . $response->status()];
            }
        } catch (\Exception $e) {
            // Manejar errores de la API externa
            return ['success' => false, 'message' => 'Error fetching users from API: ' . $e->getMessage()];
        }
    }
    
    public function getUser($id)
    {
        try {
            $response = Http::get($this->apiBaseUrl . '/usuarios/' . $id);
            // Verifica el estado de la respuesta
            if ($response->successful()) {
                return $response->json();
            } else {
                // Maneja el caso en que la respuesta no sea exitosa
                return ['success' => false, 'message' => 'Error al obtener el usuario: ' . $response->status()];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Error al obtener el usuario: ' . $e->getMessage()];
        }
    }
}
