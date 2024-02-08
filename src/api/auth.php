<?php
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        session_start();
        if (!isset($_SESSION['logged_in'])) {
            http_response_code(401);
        } else {
            http_response_code(200);
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($_SESSION['logged_in']);
        }
        break;
    case 'POST':
        $servername = "mborper.upv.edu.es";
        $username = "mborper_sprint4";
        $password = "7puB950%y";
        $dbname = "mborper_sprint4";

        // Obtener los datos enviados en el cuerpo de la solicitud
        $nombre = $_POST['nombre'];
        $contrasenya = $_POST['password'];

        // Crear la conexión a la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            http_response_code(500);
            die("Error de conexión: " . $conn->connect_error);
        }

        // Escapar los valores de los campos de nombre y contraseña para evitar inyección de SQL
        $nombre = $conn->real_escape_string($nombre);
        $contrasenya = $conn->real_escape_string($contrasenya);

        // Consulta SQL para obtener los datos del usuario
        $sql = "SELECT `id`, `nombre`, `rol` FROM `usuarios` WHERE `nombre` = '$nombre' AND `contrasenya` = '$contrasenya'";

        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['user'] = $row;

            $response = array(
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'rol' => $row['rol']
            );

            http_response_code(200);
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE');
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($response);
        } else {
            http_response_code(401);
        }

        $conn->close();
        break;
    case 'DELETE':
        session_start();
        session_unset();
        session_destroy();
        break;
    default:
        http_response_code(405);
}
