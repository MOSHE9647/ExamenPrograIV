<?php

$request_uri = $_SERVER['REQUEST_URI'];

// Manejar rutas
switch ($request_uri) {
    case '/api/v1/usuarios/getAll':
        include 'controllers/UsuarioController.php';
        UsuarioController::getAllUsuarios();
        break;
    case '/api/v1/usuarios/getActive':
        include 'controllers/UsuarioController.php';
        UsuarioController::getActiveUsuarios();
        break;
    case '/api/v1/usuarios/getInactive':
        include 'controllers/UsuarioController.php';
        UsuarioController::getInactiveUsuarios();
        break;
    case '/api/v1/usuarios/get':
        include 'controllers/UsuarioController.php';
        UsuarioController::getUsuarioById();
        break;
    case '/api/v1/usuarios/create':
        include 'controllers/UsuarioController.php';
        UsuarioController::createUsuario();
        break;
    case '/api/v1/usuarios/update':
        include 'controllers/UsuarioController.php';
        UsuarioController::updateUsuario();
        break;
    case '/api/v1/usuarios/delete/logical':
        include 'controllers/UsuarioController.php';
        UsuarioController::deleteUsuarioLogico();
        break;
    case '/api/v1/usuarios/delete/physical':
        include 'controllers/UsuarioController.php';
        UsuarioController::deleteUsuarioFisico();
        break;
    default:
        http_response_code(404);
        echo json_encode(array("message" => "Not Found"));
        break;
}

?>
