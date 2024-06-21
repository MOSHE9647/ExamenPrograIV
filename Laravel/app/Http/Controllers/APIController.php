<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class APIController extends Controller
{
    protected $nodeBaseUrl = 'http://localhost:3100';

    public function getAllUsers()
    {
        return $this->forwardToNode('/usuarios', 'GET');
    }

    public function getActiveUsers()
    {
        return $this->forwardToNode('/usuarios/active', 'GET');
    }

    public function getInactiveUsers()
    {
        return $this->forwardToNode('/usuarios/inactive', 'GET');
    }

    public function getUserById($id)
    {
        return $this->forwardToNode("/usuarios/{$id}", 'GET');
    }

    public function createUser(Request $request)
    {
        return $this->forwardToNode('/usuarios', 'POST', $request->all());
    }

    public function updateUser(Request $request)
    {
        return $this->forwardToNode('/usuarios', 'PUT', $request->all());
    }

    public function deleteLogicalUser($id)
    {
        return $this->forwardToNode("/usuarios/{$id}/delete/logical", 'DELETE');
    }

    public function deletePhysicalUser($id)
    {
        return $this->forwardToNode("/usuarios/{$id}/delete/physical", 'DELETE');
    }

    // Función para reenviar las peticiones a Node.js
    private function forwardToNode($path, $method, $data = [])
    {
        try {
            $response = Http::send($method, $this->nodeBaseUrl . $path, [
                'headers' => ['Content-Type' => 'application/json'],
                'json' => $data,
            ]);

            return $response->json();
        } catch (\Exception $e) {
            return ['error' => 'Error forwarding request'];
        }
    }
}