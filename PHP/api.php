<?php
// URL del servicio de Spring Boot para usuarios
$baseUrl = "http://localhost:8080/api/v1/usuarios";

// Obtener el ID del usuario desde la URL (si aplica)
$idUsuario = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : null;

// Inicializar cURL para enviar la solicitud a la API de Spring Boot
$ch = curl_init();
$headers = ['Content-Type: application/json'];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $url = $idUsuario == null ? $baseUrl . "/getAll" : $baseUrl . "/get?id=" . $idUsuario;
        curl_setopt($ch, CURLOPT_URL, $url);
        break;

    case 'POST':
        $url = $baseUrl . "/create";
        $jsonData = file_get_contents('php://input');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        break;

    case 'PUT':
        $url = $baseUrl . "/update";
        $jsonData = file_get_contents('php://input');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        break;

    case 'DELETE':
        if ($idUsuario != null) {
            $url = $baseUrl . "/delete/physical?id=" . $idUsuario;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'ID de usuario no proporcionado.']);
            exit();
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Método no permitido.']);
        exit();
}

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($response === false) {
    $error = curl_error($ch);
    curl_close($ch);
    http_response_code(500);
    echo json_encode(['message' => 'Error de cURL: ' . $error]);
    exit();
}

curl_close($ch);

// Verificar si la respuesta es válida JSON
$responseData = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode(['message' => 'Respuesta no válida de la API de Spring Boot']);
    exit();
}

// Enviar la respuesta del servidor al cliente
http_response_code($httpCode);
header('Content-Type: application/json');
echo json_encode($responseData);
?>
