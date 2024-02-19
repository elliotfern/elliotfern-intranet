<?php
# conectare la base de datos
$activePage = "vault";

$id = $params['id'];
$id_net = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

if ( filter_var($id_net, FILTER_VALIDATE_INT) === false ) {
    echo " id not valid";
} else {
    if (isset($params['id']) == $id) {
        global $conn;
        $stmt = $conn->prepare("SELECT c.clientNom, c.clientCognoms, c.clientEmpresa
        FROM db_accounting_hispantic_costumers AS c
        WHERE c.id=$id_net");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach ($data as $row) {
            $clientNom = $row['clientNom'];
            $clientCognoms = $row['clientCognoms'];
            $clientEmpresa = $row['clientEmpresa'];
        }
    
        echo '<div class="container">';
        
        if (isset($clientEmpresa)) {
            echo '<h2><a href="'.APP_SERVER.'/vault">Vault database</a> > <a href="'.APP_SERVER.'/vault/customer/'.$id_net.'">Vault '.$clientEmpresa.'</a></h2>';
        } else {
            echo '<h2><a href="'.APP_SERVER.'/vault">Vault database</a> > <a href="'.APP_SERVER.'/vault/customer/'.$id_net.'">Vault '.$clientNom.' '.$clientCognoms.'</a></h2>';
        }
       
        echo "<p><button type='button' class='btn btn-light btn-sm' id='btnAddVault' onclick='btnCreateVault()' data-bs-toggle='modal' data-bs-target='#modalCreateVault'>Insert new vault</button></p>";
        
        $stmt = $conn->prepare("SELECT  v.id, v.serveiNom, v.serveiUsuari, v.serveiPas, v.serveiType, t.typeName, v.serveiWeb, p.nomProjecte, v.dateModified
        FROM db_vault AS v
        INNER JOIN db_vault_type AS t ON v.serveiType = t.vaultTypeId
        LEFT JOIN db_projects AS p ON v.project = p.id
        WHERE v.client = $id_net AND NOT client = 31
        ORDER BY v.serveiNom ASC");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
            echo '<div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-primary">';
            echo "<tr>";
            echo "<th>Service</th>";
            echo "<th>Project</th>";
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
              echo "<tr>";
              echo "<td><a href='".$row['serveiWeb']."' target='_blank'>".$row['serveiNom']."</a></td>";
               echo "<td>".$row['nomProjecte']."</td>";
              echo "<td>".$row['serveiUsuari']."</a></td>";
              echo '<td><input class="form-control pass" type="password" readonly value="'.openssl_decrypt($row['serveiPas'], "AES-128-ECB", "8X1::HpHVW").'" id="passw-'.$row['id'].'">
              <p><small><a href="#" onclick="showPass('.$row['id'].');return false;">Show Password</a></p></small></td>';
              echo "<td>".$row['typeName']."</td>";
              echo "<td>".$dateModified ."</a></td>";
              echo '<td><button type="button" onclick="updateVault('.$row["id"].')" id="btnUpdateVaultRow" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateVault">Update</button></td>';
              echo '<td><button type="button" onclick="updateAuthor()" id="btnUpdateAuthor" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateAuthor">Delete</button></td>';
              echo "</tr>";
              }
              echo "</tbody>";                            
              echo "</table>";
              echo "</div>";
        echo "</div>";
        
       } 
}

echo '</div>';

?>
<script>
function showPass(id) {
    var id = id;
    var x = document.getElementById('passw-'+id+'');
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  setTimeout(() => {
        let get = x;
        x.type = "password";
        }, 3000);
}
</script>

<?php
# footer
require_once(APP_ROOT . '/public/php/footer.php');