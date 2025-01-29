<?php

// src/Controllers/AuthController.php

namespace App\Controllers;

use App\Services\AuthService;
use App\Models\UserModel;

class AuthController
{
    public function login()
    {
        // Recibir los datos POST de JSON
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data['username']) && isset($data['password'])) {
            $username = $data['username'];
            $password = $data['password'];

            // Llamar al servicio para autenticar al usuario
            $authService = new AuthService();
            $response = $authService->login($username, $password);

            // Devolver respuesta JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            echo json_encode(['success' => false, 'message' => 'Campos faltantes']);
        }
    }

    // Nueva función para el registro
    public function register()
    {
        // Recibir los datos JSON
        $data = json_decode(file_get_contents('php://input'), true);

        // Validar los campos requeridos
        if (isset($data['username'], $data['password'], $data['firstName'], $data['lastName'], $data['email'])) {
            $username = $data['username'];
            $password = $data['password'];
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $email = $data['email'];
        } else {
            echo json_encode(['success' => false, 'message' => 'Faltan campos requeridos.']);
            exit();
        }

        // Validar que los campos no estén vacíos
        if (empty($username) || empty($password) || empty($firstName) || empty($lastName) || empty($email)) {
            http_response_code(400);
            echo json_encode(['error' => 'Todos los campos son requeridos']);
            exit();
        }

        // Crear una instancia del modelo
        $userModel = new UserModel();
        $result = $userModel->register($username, $password, $firstName, $lastName, $email);

        // Devolver la respuesta en formato JSON
        echo json_encode($result);
    }
}
