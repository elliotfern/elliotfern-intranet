<?php

namespace App\Vault\App;

use PDO;
use App\Vault\Core\Services\VaultService;
use App\Vault\Adapters\Out\DatabasePasswordRepository;

class Bootstrap
{
    public static function init()
    {
        // Configuración de la base de datos
        $conn = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');

        // Inyección de dependencias
        $passwordRepository = new DatabasePasswordRepository($conn);
        $vaultService = new VaultService($passwordRepository);

        // Aquí podrías devolver el servicio para usarlo en un controlador o un caso de uso
        return $vaultService;
    }
}
