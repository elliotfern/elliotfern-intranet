<?php

// Configuración
$encryption_key = APP_ENCRYPTOKEN;
$encryption_method = "AES-256-CBC";

// Función para encriptar
function encryptData($data, $key, $method) {
    $iv_length = openssl_cipher_iv_length($method);
    $iv = openssl_random_pseudo_bytes($iv_length); // Generar IV
    $encrypted_data = openssl_encrypt($data, $method, $key, 0, $iv);
    return base64_encode($encrypted_data . "::" . $iv);
}

// Inicializar variables
$encrypted = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la contraseña desde el formulario
    $password = $_POST['password'] ?? '';

    if (!empty($password)) {
        // Encriptar la contraseña
        $encrypted = encryptData($password, $encryption_key, $encryption_method);
    } else {
        $encrypted = "Por favor, introduce una contraseña válida.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encriptar Contraseña en PHP</title>
</head>
<body>
    <h1>Encriptar Contraseña</h1>
    <form method="POST">
        <label for="password">Introduce una contraseña:</label><br>
        <input type="text" id="password" name="password" placeholder="Contraseña"><br><br>
        <button type="submit">Encriptar</button>
    </form>

    <?php if ($encrypted): ?>
        <h2>Contraseña Encriptada:</h2>
        <p><?php echo htmlspecialchars($encrypted); ?></p>
    <?php endif; ?>