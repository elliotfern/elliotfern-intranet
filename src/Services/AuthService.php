<?php
// src/Services/AuthService.php

namespace Services;

use Models\UserModel;
use Helpers\JwtHelper;

class AuthService
{
    public function login($username, $password)
    {
        $userModel = new UserModel();
        $user = $userModel->findUserByUsername($username);

        if (!$user) {
            return ['success' => false, 'message' => 'Usuario no encontrado'];
        }

        // Verificar contraseña
        if (password_verify($password, $user['password'])) {
            // Crear el payload para el JWT
            $payload = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'kid' => 'key_api'
            ];

            $jwt = JwtHelper::generateJwt($payload, $_ENV['TOKEN']); // Obtener la clave desde .env
            return [
                'success' => true,
                'message' => 'Login exitoso',
                'token' => $jwt
            ];
        }

        return ['success' => false, 'message' => 'Contraseña incorrecta'];
    }
}
