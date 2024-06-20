<?php
// URL del servicio de Spring Boot para usuarios
$baseUrl = "http://localhost:8080/api/v1/usuarios";

// Obtener el ID del usuario desde la URL (si aplica)
$idUsuario = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;

function enviarRespuesta($codigoHttp, $respuesta) {
    http_response_code($codigoHttp);
    header('Content-Type: application/json');
    echo json_encode(['success' => $codigoHttp < 400, 'data' => json_decode($respuesta), 'httpCode' => $codigoHttp]);
}

// Verificar el tipo de solicitud HTTP
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $url = $idUsuario == null ? $baseUrl . "/getAll" : $baseUrl . "/get?id=" . $idUsuario;
        break;

    case 'POST':
        $url = $baseUrl . "/create";
        $jsonData = file_get_contents('php://input');
        break;

    case 'PUT':
        $url = $baseUrl . "/update";
        $jsonData = file_get_contents('php://input');
        break;

    case 'DELETE':
        if ($idUsuario != null) {
            $url = $baseUrl . "/delete/logical?id=" . $idUsuario;
        } else {
            enviarRespuesta(400, json_encode(['message' => 'ID de usuario no proporcionado.']));
            exit();
        }
        break;

    default:
        enviarRespuesta(405, json_encode(['message' => 'Método no permitido.']));
        exit();
}

// Inicializar cURL para enviar la solicitud a la API de Spring Boot
$ch = curl_init($url);

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT') {
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
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

if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    enviarRespuesta(500, json_encode(['message' => 'Error de cURL: ' . $error]));
    exit();
}

curl_close($ch);

// Enviar respuesta al cliente
enviarRespuesta($httpCode, $response);
?>
