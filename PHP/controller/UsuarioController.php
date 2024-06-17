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

    // Método para obtener todos los usuarios desde Spring Boot
    public static function getAllUsuarios() {
        $url = 'http://localhost:8080/api/usuarios';
        $response = self::curlRequest($url);
        echo $response;
    }

    // Método para obtener usuarios activos desde Spring Boot
    public static function getActiveUsuarios() {
        $url = 'http://localhost:8080/api/usuarios/active';
        $response = self::curlRequest($url);
        echo $response;
    }

    // Método para obtener usuarios inactivos desde Spring Boot
    public static function getInactiveUsuarios() {
        $url = 'http://localhost:8080/api/usuarios/inactive';
        $response = self::curlRequest($url);
        echo $response;
    }

    // Método para obtener un usuario por su ID desde Spring Boot
    public static function getUsuarioById() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $url = 'http://localhost:8080/api/usuarios/' . $id;
            $response = self::curlRequest($url);
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID de usuario no proporcionado"));
        }
    }

    // Método para crear un nuevo usuario en Spring Boot
    public static function createUsuario() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if ($data) {
            $url = 'http://localhost:8080/api/usuarios';
            $response = self::curlRequest($url, 'POST', $data);
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Datos de usuario no proporcionados"));
        }
    }

    // Método para actualizar un usuario existente en Spring Boot
    public static function updateUsuario() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if ($data && isset($data['id'])) {
            $id = $data['id'];
            $url = 'http://localhost:8080/api/usuarios/' . $id;
            $response = self::curlRequest($url, 'PUT', $data);
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Datos de usuario o ID no proporcionados"));
        }
    }

    // Método para eliminar lógicamente un usuario en Spring Boot
    public static function deleteUsuarioLogico() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $url = 'http://localhost:8080/api/usuarios/' . $id . '/delete/logical';
            $response = self::curlRequest($url, 'DELETE');
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID de usuario no proporcionado"));
        }
    }

    // Método para eliminar físicamente un usuario en Spring Boot
    public static function deleteUsuarioFisico() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $url = 'http://localhost:8080/api/usuarios/' . $id . '/delete/physical';
            $response = self::curlRequest($url, 'DELETE');
            echo $response;
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "ID de usuario no proporcionado"));
        }
    }

}

?>
