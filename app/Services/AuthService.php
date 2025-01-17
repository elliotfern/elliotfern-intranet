<?php
// src/Services/AuthService.php

namespace App\Services;

use App\Models\UserModel;
use App\Helpers\JwtHelper;

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
            $expiration = time() + (10 * 24 * 60 * 60); // 10 días
            
            $arr_cookie_options = array (
                    'expires' => $expiration, 
                    'path' => '/', 
                    'domain' => '.elliotfern.com',
                    'secure' => true,     // or false
                    'httponly' => true,    // or false
                    'samesite' => 'Strict' // None || Lax  || Strict
                    );

            setcookie('user_id', $user['id'], $arr_cookie_options);   
            setcookie('token', $jwt, $arr_cookie_options);   
            setcookie('user_type', "1", $arr_cookie_options); 

            return [
                'success' => true,
                'message' => 'Login exitoso',
                'token' => $jwt
            ];
        }

        return ['success' => false, 'message' => 'Contraseña incorrecta'];
    }
}
