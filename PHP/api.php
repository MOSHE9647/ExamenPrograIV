<?php
// URL del servicio de Spring Boot para usuarios
$baseUrl = "http://localhost:8081/api/v1/usuarios";

// Obtener el ID del usuario desde la URL (si aplica)
$idUsuario = isset($_GET['id']) ? $_GET['id'] : null;

function enviarRespuesta($codigoHttp, $respuesta) {
    http_response_code($codigoHttp);
    header('Content-Type: application/json');
    echo $respuesta;
}

// Verificar el tipo de solicitud HTTP
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ($idUsuario == null) {
            // Obtener lista de usuarios
            $url = $baseUrl . "/getAll";
        } else {
            // Obtener usuario por ID
            $url = $baseUrl . "/get?id=" . $idUsuario;
        }
        break;

    case 'POST':
        // Crear usuario
        $url = $baseUrl . "/create";
        $jsonData = file_get_contents('php://input');
        break;

    case 'PUT':
        // Actualizar usuario
        $url = $baseUrl . "/update";
        $jsonData = file_get_contents('php://input');
        break;

    case 'DELETE':
        if ($idUsuario != null) {
            // Eliminar usuario (lógica)
            $url = $baseUrl . "/delete/logical?id=" . $idUsuario;
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID de usuario no proporcionado.']);
            exit();
        }
        break;

    default:
        // Responder con un error 405 (Método no permitido) para otros métodos HTTP
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        exit();
}

// Inicializar cURL para enviar la solicitud a la API de Spring Boot
$ch = curl_init($url);

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT') {
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
}

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Enviar respuesta al cliente
enviarRespuesta($httpCode, $response);
?>
