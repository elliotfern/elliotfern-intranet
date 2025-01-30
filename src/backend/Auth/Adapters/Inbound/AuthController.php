<?php

namespace App\Auth\Adapters\Inbound;

use App\Auth\Core\Services\AuthService;

class AuthController
{
    private $authService;

    // Constructor donde inyectamos el servicio VaultService
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService; // Almacenamos el servicio en una propiedad
    }

    // Método para obtener las contraseñas de un "vault" (bóveda)
    public function loginAuth(string $username, string $password)
    {
        // Llamamos al servicio VaultService para obtener las contraseñas
        $login = $this->authService->loginAuth($username, $password);

        // Verificar que estamos recibiendo un array
        if (!is_array($login)) {
            // Si no es un array, devolver un array vacío
            return [];
        }

        return $login;
    }
}
