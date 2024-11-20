<?php

global $conn;

$encryption_key = APP_ENCRYPTOKEN;


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

            // Recuperar datos cifrados (por ejemplo, desde la base de datos)
            $encrypted_data_with_iv = $row['serveiPas'];

            // Verificar si el texto cifrado tiene el formato correcto
            if (strpos(base64_decode($encrypted_data_with_iv), "::") !== false) {
                list($encrypted_data, $iv) = explode("::", base64_decode($encrypted_data_with_iv));

                $encryption_method = "AES-256-CBC"; // Método de cifrado

                // Desencriptar los datos
                $decrypted_data = openssl_decrypt($encrypted_data, $encryption_method, $encryption_key, 0, $iv);

                if ($decrypted_data === false) {
                    $decrypted_data = "Error al desencriptar";
                }
            } else {
                $decrypted_data = "Error: Datos no válidos";
            }

            echo "<tr>";
            echo "<td><a href='" . $row['serveiWeb'] . "' target='_blank'>" . $row['serveiNom'] . "</a></td>";
            echo "<td>" . $row['serveiUsuari'] . "</td>";
            echo '<td>
            <input type="password" id="passw-' . $row['id'] . '" value="' . htmlspecialchars($decrypted_data) . '" readonly style="border: none; background: none;">
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

?>
<script>
function showPass(id) {
    var x = document.getElementById('passw-' + id + '');
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    setTimeout(() => {
        x.type = "password";
    }, 5000);
}
</script>

<?php
# Footer
require_once(APP_ROOT . '/public/01_inici/footer.php');
