<?php

namespace App\Auth\Core\Services;

use App\Auth\Core\Ports\In\AuthServiceInterface;
use App\Auth\Core\Ports\Out\AuthRepositoryInterface;

class AuthService implements AuthServiceInterface
{
    private $authRepository;

    // Aquí inyectamos el repositorio que usaremos para interactuar con la base de datos
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    // Método que obtiene las contraseñas desde el repositorio
    public function loginAuth(string $username, string $password): array
    {
        return $this->authRepository->loginAuth($username, $password);
    }
}
