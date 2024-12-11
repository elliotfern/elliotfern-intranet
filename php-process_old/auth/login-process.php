<?php
require_once(APP_ROOT . APP_DEV . '/vendor/autoload.php');
use Dotenv\Dotenv;
use Firebase\JWT\JWT;

// Cargar variables de entorno desde .env
$dotenv = Dotenv::createImmutable(APP_ROOT . APP_DEV . '/');
$dotenv->load();

$jwtSecret = $_ENV['TOKEN']; // Obtener el secreto JWT desde variables de entorno

// Verificar si se han enviado las credenciales de usuario
if (isset($_POST['userName']) && isset($_POST['password'])) {
    $username = $_POST['userName'];
    $password = $_POST['password'];

    global $conn;
    $stmt = $conn->prepare(
        "SELECT u.id, u.username, u.password
        FROM db_users AS u
        WHERE u.username = :username"
    );
    $stmt->execute(['username' => $username]);

    if ($stmt->rowCount() === 0) {
        // Usuario no encontrado
        $response = array('status' => 'error', 'message' => 'User not found');
        http_response_code(404); // Código de respuesta 404: No encontrado
        echo json_encode($response);
        exit;
    } else {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $hash = $row['password'];
            $id = $row['id'];

            if (password_verify($password, $hash) && $id == 1) {
                // Generar token JWT
                $payload = array(
                    "user_id" => $row['id'],
                    "username" => $row['username'],
                    "kid" => "key_api"
                );

                $jwt = JWT::encode($payload, $jwtSecret, "HS256");

                // Almacenar en localStorage del cliente
                // Devolver el token al cliente en la respuesta JSON
                $response = array(
                    "token" => $jwt,
                    "status" => "success"
                );

                // Establecer el encabezado como JSON
                header('Content-Type: application/json');
                // Devolver la respuesta JSON con el token
                echo json_encode($response);
                exit;
            } else {
                // Contraseña incorrecta u otro error
                $response = array('status' => 'error', 'message' => 'Invalid credentials');
                http_response_code(401); // Código de respuesta 401: No autorizado
                echo json_encode($response);
                exit;
            }
        }
    }
} else {
    // Datos de usuario no proporcionados en la solicitud
    $response = array('status' => 'error', 'message' => 'Username and password required');
    http_response_code(400); // Código de respuesta 400: Solicitud incorrecta
    echo json_encode($response);
    exit;
}
?>
