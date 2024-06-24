<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\ApiController;

class UserController extends Controller
{
    protected $apiController;

    public function __construct(ApiController $apiController)
    {
        $this->apiController = $apiController;
    }

    /**
     * Muestra la página de gestión de usuarios.
     *
     * @return \Illuminate\View\View
     */
    public function user()
    {
        $response = $this->apiController->getAllUsers();
        $users = $this->handleApiResponse($response);

        $isAddFormVisible = false;
        $isEditFormVisible = false;
        $isInfoFormVisible = false;
        return view('user', compact('users', 'isAddFormVisible', 'isEditFormVisible', 'isInfoFormVisible'));
    }

    public function toggleAddFormVisibility()
    {
        $response = $this->apiController->getAllUsers();
        $users = $this->handleApiResponse($response);

        $isAddFormVisible = true;
        $isEditFormVisible = false;
        $isInfoFormVisible = false;
        return view('user', compact('users', 'isAddFormVisible', 'isEditFormVisible', 'isInfoFormVisible'));
    }

    public function toggleInfoFormVisibility($userId)
    {
        $response = $this->apiController->getUser($userId);
        $selectedUser = $this->handleApiResponse($response, true);

        $response = $this->apiController->getAllUsers();
        $users = $this->handleApiResponse($response);

        return view('user', [
            'users' => $users,
            'isAddFormVisible' => false,
            'isEditFormVisible' => false,
            'isInfoFormVisible' => true,
            'selectedUser' => $selectedUser,
        ]);
    }

    public function toggleEditFormVisibility($userId)
    {
        $response = $this->apiController->getUser($userId);
        $selectedUser = $this->handleApiResponse($response, true);

        $response = $this->apiController->getAllUsers();
        $users = $this->handleApiResponse($response);

        return view('user', [
            'users' => $users,
            'isAddFormVisible' => false,
            'isEditFormVisible' => true,
            'isInfoFormVisible' => false,
            'selectedUser' => $selectedUser,
        ]);
    }

    /**
     * Maneja la respuesta de la API.
     *
     * @param array $response
     * @param bool $singleRecord
     * @return mixed
     */
    private function handleApiResponse($response, $singleRecord = false)
    {
        // Verificar si la respuesta tiene un código de estado HTTP 200
        if ($response['status'] === 200) {
            return $response['data']['data'];
        } else {
            // Manejar el error o retornar un valor por defecto
            if ($singleRecord) {
                return null;
            } else {
                return [];
            }
        }
    }
}