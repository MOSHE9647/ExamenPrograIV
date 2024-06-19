<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsuarioController extends Controller
{
    private $baseUrl = 'http://localhost:3000';

    public function index()
    {
        $response = Http::get("{$this->baseUrl}/usuarios");
        return response()->json($response->json(), $response->status());
    }

    public function getActive()
    {
        $response = Http::get("{$this->baseUrl}/usuarios/active");
        return response()->json($response->json(), $response->status());
    }

    public function getInactive()
    {
        $response = Http::get("{$this->baseUrl}/usuarios/inactive");
        return response()->json($response->json(), $response->status());
    }

    public function show($id)
    {
        $response = Http::get("{$this->baseUrl}/usuarios/{$id}");
        return response()->json($response->json(), $response->status());
    }

    public function store(Request $request)
    {
        $response = Http::post("{$this->baseUrl}/usuarios", $request->all());
        return response()->json($response->json(), $response->status());
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['id'] = $id;
        $response = Http::put("{$this->baseUrl}/usuarios/{$id}", $data);
        return response()->json($response->json(), $response->status());
    }

    public function deleteLogical($id)
    {
        $response = Http::delete("{$this->baseUrl}/usuarios/{$id}/delete/logical");
        return response()->json($response->json(), $response->status());
    }

    public function deletePhysical($id)
    {
        $response = Http::delete("{$this->baseUrl}/usuarios/{$id}/delete/physical");
        return response()->json($response->json(), $response->status());
    }
}
