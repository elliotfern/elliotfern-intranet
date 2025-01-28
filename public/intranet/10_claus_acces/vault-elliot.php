<?php

// Incluir el controlador y la clase de base de datos
use App\Controllers\VaultController;
use App\Config\Database;


if ($conn !== null) {
    $passwordController = new VaultController($conn);
    // Obtener datos
    $data2 = $passwordController->showPasswords(31);
} else {
    echo "No se pudo conectar a la base de datos.";
}

?>

<div class="container">

    <h2><a href="/vault">Vault database</a> > <a href="/vault">Elliot</a></h2>
    <p><a href='/vault/nova'><button type='button' class='btn btn-light btn-sm' id='btnAddVault'>Nova contrasenya</button></a></p>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Servei</th>
                    <th>Usuari</th>
                    <th>Contrasenya</th>
                    <th>Tipus</th>
                    <th>Modificada</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data2 as $row) : ?>
                    <tr>
                        <td><a href="<?php echo $row['web']; ?>" target="_blank"><?php echo $row['servei']; ?></a></td>
                        <td><?php echo $row['usuari']; ?></td>
                        <td>
                            <input type="password" id="passw-<?php echo $row['id']; ?>" value="**********" readonly style="border: none; background: none;">
                            <button type="button" class="btn btn-sm btn-secondary" onclick="showPass(<?php echo $row['id']; ?>)">Show</button>
                        </td>
                        <td><?php echo $row['tipus_type']; ?></td>
                        <td><?php echo $row['date_modified'] == '0000-00-00' ? 'Not modified' : date("d/m/Y", strtotime($row['date_modified'])); ?></td>
                        <td><button type="button" onclick="updateVault(<?php echo $row['id']; ?>)" class="btn btn-sm btn-warning">Update</button></td>
                        <td><button type="button" onclick="deleteVault(<?php echo $row['id']; ?>)" class="btn btn-sm btn-danger">Delete</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function showPass(id) {
        let inputField = document.getElementById('passw-' + id);
        let urlAjax = '/api/vault/get/?id=' + id;

        if (inputField.type === "password") {
            fetch(urlAjax, {
                    method: "GET",
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la sol·licitud AJAX');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.password) {
                        inputField.value = data.password; // Mostrar la contraseña
                        inputField.type = "text";

                        // Copiar la contraseña al portapapeles
                        navigator.clipboard.writeText(data.password).then(() => {
                            console.log("Contraseña copiada al portapapeles");
                        }).catch(err => {
                            console.error("Error al copiar al portapapeles: ", err);
                        });

                        // Ocultar la contraseña después de 5 segundos
                        setTimeout(() => {
                            inputField.value = '**********'; // Volver al placeholder después de 5 segundos
                            inputField.type = "password";
                        }, 5000);
                    } else {
                        inputField.value = data.error; // Mostrar el error
                        inputField.type = "text";
                    }
                })
                .catch(error => {
                    console.error('Error en la sol·licitud AJAX:', error);
                    alert('Hubo un problema al intentar obtener la contraseña.');
                });
        }
    }
</script>