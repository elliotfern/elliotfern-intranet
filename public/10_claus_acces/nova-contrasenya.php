<?php
$hashedPassword = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener la contraseña desde el formulario
    $password = $_POST['password'] ?? '';

    if (!empty($password)) {
        // Generar un hash seguro con password_hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo $hashedPassword; // Enviar el hash como respuesta
    } else {
        echo "Por favor, introduce una contraseña válida.";
    }

    exit; // Detener la ejecución para devolver solo el resultado
}
?>


    <h1>Hashear Contraseña</h1>
    <form id="passwordForm">
        <label for="password">Introduce una contraseña:</label><br>
        <input type="text" id="password" name="password" placeholder="Contraseña"><br><br>
        <button type="button" id="generateHash">Generar Hash</button>
    </form>

    <div id="hashResult"></div>

    <script>
        $(document).ready(function () {
            $('#generateHash').click(function () {
                const password = $('#password').val();

                if (!password) {
                    $('#hashResult').html('<p>Por favor, introduce una contraseña válida.</p>');
                    return;
                }

                // Enviar la contraseña al servidor mediante AJAX
                $.ajax({
                    url: '', // La misma página procesa la solicitud
                    type: 'POST',
                    data: { password: password },
                    success: function (response) {
                        $('#hashResult').html('<h2>Hash de la Contraseña:</h2><p>' + response + '</p>');
                    },
                    error: function () {
                        $('#hashResult').html('<p>Hubo un error al generar el hash.</p>');
                    }
                });
            });
        });
    </script>
