<?php

use App\Vault\Adapters\Inbound\VaultController;
use App\Vault\Core\Services\VaultService;  // <--- Asegúrate de esta línea
use App\Vault\Adapters\Outbound\DatabasePasswordRepository;
use App\Config\Database;

use App\Controllers\VaultController2;

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
    $id = (int)$_GET['id'];

    if ($conn !== null) {
        // Instanciar el controlador
        $passwordController = new VaultController2($conn);

        // Obtener la contraseña desencriptada desde el controlador
        try {
            $password = $passwordController->getPassword($id);

            // Verificar si la respuesta contiene un error
            if (isset($password['error'])) {
                // Si contiene un error, se devuelve el mensaje de error
                //echo json_encode(['error' => $password['error']]);
            } else {
                // Si no contiene error, se devuelve la contraseña desencriptada
                //echo json_encode(['password' => $password]);
            }
        } catch (Exception $e) {
            // En caso de un error en el servidor, se captura la excepción
            echo json_encode(['error' => 'Server error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'Database connection failed']);
    }
} else {
    echo json_encode(['error' => 'Invalid ID']);
}
