<?php

use App\Vault\Adapters\Inbound\VaultController;
use App\Vault\Core\Services\VaultService;
use App\Vault\Adapters\Outbound\DatabasePasswordRepository;
use App\Config\Database;

// Configuración de cabeceras para aceptar JSON y responder JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://elliot.cat");
header("Access-Control-Allow-Methods: GET");

// Verificar si se ha recibido un parámetro válido
if (isset($_GET['llistat_serveis'])) {

    // Conectar a la base de datos
    $conn = Database::getConnection();

    // Crear el repositorio
    $passwordRepository = new DatabasePasswordRepository($conn);

    // Pasar el repositorio a VaultService
    $vaultService = new VaultService($passwordRepository);

    // Pasar el servicio correctamente a VaultController
    $passwordController = new VaultController($vaultService);

    // Obtener el user_id
    $userId = isset($_GET['user_id']) ? (int)$_GET['user_id'] : 31;

    // Llamar al método getPasswords con el ID dinámico
    $passwords = $passwordController->getPasswords($userId);

    // Verificar que hemos obtenido un array de datos
    header('Content-Type: application/json');
    if (is_array($passwords)) {
        // Devolver los datos como un array JSON
        echo json_encode($passwords, JSON_PRETTY_PRINT);
    } else {
        // Si no se ha obtenido un array, devolver un error en formato JSON
        echo json_encode(["error" => "No se encontraron contraseñas"]);
    }
} elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Conectar a la base de datos
    $conn = Database::getConnection();

    // Crear el repositorio
    $passwordRepository = new DatabasePasswordRepository($conn);

    // Pasar el repositorio a VaultService
    $vaultService = new VaultService($passwordRepository);

    // Pasar el servicio correctamente a VaultController
    $passwordController = new VaultController($vaultService);

    // Obtener el user_id
    $userId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

    // Llamar al método getPasswords con el ID dinámico
    $passwords = $passwordController->getPasswordDesencrypt($userId);

    // Verificar que hemos obtenido un array de datos
    header('Content-Type: application/json');
    if (is_array($passwords)) {
        // Devolver los datos como un array JSON
        echo json_encode($passwords, JSON_PRETTY_PRINT);
    } else {
        // Si no se ha obtenido un array, devolver un error en formato JSON
        echo json_encode(["error" => "No se encontraron contraseñas"]);
    }
} else {
    echo json_encode(['error' => 'Invalid ID']);
}
