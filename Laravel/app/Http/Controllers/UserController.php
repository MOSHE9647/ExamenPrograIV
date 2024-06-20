<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://localhost:3100/']);
    }

    public function getAllUsers()
    {
        $response = $this->client->request('GET', 'usuarios');
        return response()->json(json_decode($response->getBody()->getContents(), true));
    }

    public function getUser($id)
    {
        $response = $this->client->request('GET', "usuarios/{$id}");
        return response()->json(json_decode($response->getBody()->getContents(), true));
    }

    public function createUser(Request $request)
    {
        $response = $this->client->request('POST', 'usuarios', [
            'json' => $request->all()
        ]);
        return response()->json(json_decode($response->getBody()->getContents(), true));
    }

    public function updateUser(Request $request, $id)
    {
        $response = $this->client->request('PUT', "usuarios/{$id}", [
            'json' => $request->all()
        ]);
        return response()->json(json_decode($response->getBody()->getContents(), true));
    }

    public function deleteUserLogical($id)
    {
        $response = $this->client->request('DELETE', "usuarios/{$id}/delete/logical");
        return response()->json(json_decode($response->getBody()->getContents(), true));
    }

    public function deleteUserPhysical($id)
    {
        $response = $this->client->request('DELETE', "usuarios/{$id}/delete/physical");
        return response()->json(json_decode($response->getBody()->getContents(), true));
    }
}