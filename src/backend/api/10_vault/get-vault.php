<?php

use App\Controllers\VaultController;

// Asegúrate de que este archivo tenga acceso a la clase PasswordController
// Verificar que se haya enviado un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($conn !== null) {
        // Instanciar el controlador
        $passwordController = new VaultController($conn);

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