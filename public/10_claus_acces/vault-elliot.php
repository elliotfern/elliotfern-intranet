<?php

global $conn;
$id = $params['id'];

if ($id !== "31") {
    echo 'ID no válido';
} else {
    if (isset($params['id']) && $params['id'] == $id) {

        echo '<h2><a href="' . APP_SERVER . '/vault">Vault database</a> > <a href="' . APP_SERVER . '/vault/elliot/31">Elliot</a></h2>';
        echo "<p><a href='/vault/new'><button type='button' class='btn btn-light btn-sm' id='btnAddVault'>Insert new vault</button></a></p>";

        $stmt = $conn->prepare("SELECT v.id, v.serveiNom, v.serveiUsuari, v.serveiPas, v.serveiType, t.typeName, v.serveiWeb, v.dateModified
            FROM db_vault AS v
            INNER JOIN db_vault_type AS t ON v.serveiType = t.vaultTypeId
            WHERE v.client = 31
            ORDER BY v.serveiNom ASC");
        $stmt->execute();
        $data = $stmt->fetchAll();

        echo '<div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">';
        echo "<tr>";
        echo "<th>Service</th>";
        echo "<th>User</th>";
        echo "<th>Pass</th>";
        echo "<th>Type</th>";
        echo "<th>Modified</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        foreach ($data as $row) {
            $dateMo = $row['dateModified'];
            $dateModified = date("d/m/Y", strtotime($dateMo));

            // La contraseña no se descifra; solo se verifica cuando sea necesario.
            $password_placeholder = '**********'; // Mostrar algo genérico en lugar de la contraseña

            echo "<tr>";
            echo "<td><a href='" . $row['serveiWeb'] . "' target='_blank'>" . $row['serveiNom'] . "</a></td>";
            echo "<td>" . $row['serveiUsuari'] . "</td>";
            echo '<td>
            <input type="password" id="passw-' . $row['id'] . '" value="' . htmlspecialchars($password_placeholder) . '" readonly style="border: none; background: none;">
            <button type="button" class="btn btn-sm btn-secondary" onclick="showPass(' . $row['id'] . ')">Show</button>
          </td>';
            echo "<td>" . $row['typeName'] . "</td>";
            echo "<td>" . $dateModified . "</td>";
            echo '<td><button type="button" onclick="updateVault(' . $row["id"] . ')" id="btnUpdateVaultRow" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateVault">Update</button></td>';
            echo '<td><button type="button" onclick="updateAuthor()" id="btnUpdateAuthor" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateAuthor">Delete</button></td>';
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
        echo "</div>";
    }
}

?>
<script>
function showPass(id) {
    // Obtener contraseña del servidor vía AJAX y compararla
    let inputField = document.getElementById('passw-' + id);
    let urlAjax = `/api/vault/get/?type=password&id=${id}`;

    if (inputField.type === "password") {

        $.ajax({
            url: urlAjax,
            method: "GET",
            dataType: "JSON",
            beforeSend: function(xhr) {
                // Obtener el token del localStorage
                let token = localStorage.getItem('token');

                // Incluir el token en el encabezado de autorización
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            },
            success: function(data) {
                // Verifica si la respuesta es correcta
                if (data.success && data.serveiPass) {
                    inputField.value = data.serveiPass; // Mostrar la contraseña
                    inputField.type = "text";

                    // Ocultar la contraseña después de 5 segundos
                    setTimeout(() => {
                        inputField.value = '**********'; // Volver al placeholder después de 5 segundos
                        inputField.type = "password";
                    }, 5000);
                } else {
                    alert('No se pudo obtener la contraseña');
                }
            },
            error: function(xhr, status, error) {
                // Manejo de errores en la solicitud
                console.error('Error en la solicitud AJAX:', error);
                alert('Hubo un problema al intentar obtener la contraseña.');
            }
        });
    }
}
</script>

<?php
# Footer
require_once(APP_ROOT . '/public/01_inici/footer.php');
?>
