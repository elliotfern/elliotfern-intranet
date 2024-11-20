<?php
// api/login.php

use Controllers\AuthController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $authController = new AuthController();
        $authController->login();

    
    // Recibir los datos JSON
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['password'])) {
        $username = $data['username'];
        $password = $data['password'];
    } else {
        echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos.']);
        exit();
    }

    // Verificar si el usuario existe
    $query = "SELECT id, username, password FROM db_users WHERE username = :username";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // Comprobar si el usuario existe
    if ($stmt->rowCount() === 0) {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
        exit;
    }

    // Obtener los resultados
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $id_bd = $user['id'];
    $password_bd = $user['password'];
    $username_bd = $user['username'];
    $tipoUsuario = "1";

    // Verificar la contraseña con password_verify
    if (password_verify($password, $password_bd)) {
        // Generar token JWT
        $payload = array(
            "user_id" => $id_bd,
            "username" => $username_bd,
            "kid" => "key_api"
        );

        $jwt = JWT::encode($payload, $jwtSecret, "HS256");
        $expiration = time() + (10 * 24 * 60 * 60); // 10 días

        $arr_cookie_options = array (
            'expires' => $expiration, 
            'path' => '/', 
            'domain' => '.elliotfern.com',
            'secure' => true,     // or false
            'httponly' => true,    // or false
            'samesite' => 'Strict' // None || Lax  || Strict
            );

        setcookie('user_id', $id_bd, $arr_cookie_options);   
        setcookie('token', $jwt, $arr_cookie_options);   
        setcookie('user_type', $tipoUsuario, $arr_cookie_options); 

        // Establecer el encabezado como JSON
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Inicio de sesión exitoso.']);
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta.']);
    }
}
