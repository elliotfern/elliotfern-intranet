<?php

// Cargar el archivo .env

$token = $_ENV['ENCRYPTATION_TOKEN'] ?? null;

// Función para generar una contraseña encriptada y su IV
function generateEncryptedPassword($password, $token) {
    if (!$token) {
        return ['error' => 'Token de encriptación no definido en .env'];
    }

    $ivLength = openssl_cipher_iv_length('AES-256-CBC');
    $iv = openssl_random_pseudo_bytes($ivLength);

    $encryptedPassword = openssl_encrypt($password, 'AES-256-CBC', $token, 0, $iv);

    return [
        'encryptedPassword' => $encryptedPassword,
        'iv' => base64_encode($iv),
    ];
}

// Procesar la generación de la contraseña
$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'];
    $result = generateEncryptedPassword($password, $token);
}
?>

    <div class="container">
        <h1>Generador de Contraseñas Encriptadas</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="password" class="form-label">Introduce una contraseña:</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Generar</button>
        </form>

        <?php if ($result): ?>
            <div class="mt-4">
                <?php if (isset($result['error'])): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($result['error']); ?></div>
                <?php else: ?>
                    <h3>Resultado:</h3>
                    <p><strong>Contraseña Encriptada:</strong> <?php echo htmlspecialchars($result['encryptedPassword']); ?></p>
                    <p><strong>IV (Base64):</strong> <?php echo htmlspecialchars($result['iv']); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
