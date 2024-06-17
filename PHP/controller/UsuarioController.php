<?php

class UsuarioController {

    // Método genérico para realizar solicitudes HTTP usando cURL
    private static function curlRequest($url, $method = 'GET', $data = null) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        if ($data) {
            $jsonData = json_encode($data);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        }

        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }

    // Método para reenviar las solicitudes a Node.js
    private static function forwardToNode($path, $method = 'GET', $data = null) {
        $url = 'http://localhost:3000' . $path;
        return self::curlRequest($url, $method, $data);
    }

    // Método para obtener todos los usuarios desde Node.js
    public static function getAllUsuarios() {
        $response = self::forwardToNode('/usuarios');
        echo $response;
    }

    // Método para obtener usuarios activos desde Node.js
    public static function getActiveUsuarios() {
        $response = self::forwardToNode('/usuarios/active');
        echo $response;
    }

    // Método para obtener usuarios inactivos desde Node.js
    public static function getInactiveUsuarios() {
        $response = self::forwardToNode('/usuarios/inactive');
        echo $response;
    }

    // Método para obtener un usuario por su ID desde Node.js
    public static function getUsuarioById() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $response = self::forwardToNode('/usuarios/' . $id);
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID de usuario no proporcionado"));
        }
    }

    // Método para crear un nuevo usuario en Node.js
    public static function createUsuario() {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data) {
            $response = self::forwardToNode('/usuarios', 'POST', $data);
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Datos de usuario no proporcionados"));
        }
    }

    // Método para actualizar un usuario existente en Node.js
    public static function updateUsuario() {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data && isset($data['id'])) {
            $id = $data['id'];
            $response = self::forwardToNode('/usuarios/' . $id, 'PUT', $data);
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Datos de usuario o ID no proporcionados"));
        }
    }

    // Método para eliminar lógicamente un usuario en Node.js
    public static function deleteUsuarioLogico() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $response = self::forwardToNode('/usuarios/' . $id . '/delete/logical', 'DELETE');
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID de usuario no proporcionado"));
        }
    }

    // Método para eliminar físicamente un usuario en Node.js
    public static function deleteUsuarioFisico() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $response = self::forwardToNode('/usuarios/' . $id . '/delete/physical', 'DELETE');
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID de usuario no proporcionado"));
        }
    }
}

?>
