<?php
// URL del servicio de Spring Boot para listar usuarios
$urlListar = "http://localhost:8080/api/v1/usuarios";
// URL del servicio de Spring Boot para eliminar un usuario por ID
$urlEliminar = "http://localhost:8080/api/v1/usuarios";

// Obtener el ID del usuario desde la URL
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
            $ch = curl_init($urlListar);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            enviarRespuesta($httpCode, $response);
        } else {
            // Obtener usuario por ID
            $urlGet = $urlListar . "/" . $idUsuario;
            $ch = curl_init($urlGet);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            enviarRespuesta($httpCode, $response);
        }
        break;

    case 'POST':
        // Leer los datos JSON enviados en el cuerpo de la solicitud
        $jsonData = file_get_contents('php://input');
        $datosRecibidos = json_decode($jsonData, true);

        // URL del servicio de Spring Boot para crear usuario
        $urlCrear = $urlListar;

        // Inicializar cURL para la creación de usuario
        $ch = curl_init($urlCrear);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        // Ejecutar la solicitud y obtener la respuesta de Spring Boot
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Cerrar cURL
        curl_close($ch);

        // Enviar respuesta al cliente
        enviarRespuesta($httpCode, $response);
        break;

    case 'PUT':
        // Leer los datos JSON enviados en el cuerpo de la solicitud
        $jsonData = file_get_contents('php://input');
        $datosRecibidos = json_decode($jsonData, true);

        // URL del servicio de Spring Boot para actualizar usuario
        $urlActualizar = $urlListar;

        // Construir URL específica para actualizar usuario
        if (isset($datosRecibidos['id'])) {
            $urlActualizar .= "/" . $datosRecibidos['id'];
        }

        // Inicializar cURL para la actualización de usuario
        $ch = curl_init($urlActualizar);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        // Ejecutar la solicitud y obtener la respuesta de Spring Boot
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Cerrar cURL
        curl_close($ch);

        // Enviar respuesta al cliente
        enviarRespuesta($httpCode, $response);
        break;

    case 'DELETE':
        if ($idUsuario != null) {
            // URL completa para eliminar un usuario por ID
            $urlEliminarCompleta = $urlEliminar . "/" . $idUsuario;

            // Inicializar cURL para enviar la solicitud de eliminación
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlEliminarCompleta);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Cerrar cURL
            curl_close($ch);

            // Enviar respuesta al cliente
            enviarRespuesta($httpCode, $response);
        } else {
            // Si no se proporciona un ID de usuario, devolver una respuesta de error
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID de usuario no proporcionado.']);
        }
        break;

    default:
        // Responder con un error 405 (Método no permitido) para otros métodos HTTP
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
        break;
}
?>
