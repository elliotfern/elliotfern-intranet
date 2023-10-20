<?php
# conectare la base de datos


if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    $id = $_POST['id'];
}

//call api
//read json file from url in php
$url = APP_SERVER . "/controller/vault.php?type=vault&id=" .$id;
$input = file_get_contents($url);
$arr = json_decode($input, true);
$vault = $arr[0];

    $serveiNomPost = $vault['serveiNom']; 
    $serveiUsuariPost = $vault['serveiUsuari'];
    $serveiPasPost = openssl_decrypt($vault['serveiPas'], "AES-128-ECB", "8X1::HpHVW");
    $serveiTypePost = $vault['serveiType'];
    $serveiWebPost = $vault['serveiWeb'];
    $clientPost = $vault['client'];
    $projectPost = $vault['project'];
    
// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="updateVaultMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="updateVaultMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormUpdateVault" class="row g-3">';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';
    echo '<input type="hidden" id="id" name="id" value="'.$id.'">';

    echo '<div class="col-md-4">';
    echo '<label for="serveiNom">Service:</label>';
    echo '<input type="text" class="form-control" name="serveiNom" id="serveiNom" value="'.$serveiNomPost.'" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiUsuari">User:</label>';
    echo '<input type="text" class="form-control" name="serveiUsuari" id="serveiUsuari" value="'.$serveiUsuariPost.'" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiPas">Password:</label>';
    echo '<input type="text" class="form-control" name="serveiPas" id="serveiPas" value="'.$serveiPasPost.'" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiWeb">Web:</label>';
    echo '<input type="text" class="form-control" name="serveiWeb" id="serveiWeb" value="'.$serveiWebPost.'" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Type:</label>';
    echo '<select class="form-select" name="serveiType" id="serveiType" required>';
    echo '<option selected disabled>Select an option:</option>';
    global $conn;
    $stmt = $conn->prepare("SELECT t.vaultTypeId, t.typeName 
    FROM db_vault_type AS t
    ORDER BY t.typeName ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $vaultTypeId = $row['vaultTypeId'];
        $typeName = $row['typeName'];
        if ($serveiTypePost == $vaultTypeId){
          echo "<option value=".$serveiTypePost." selected>".$typeName."</option>"; 
        } else {
          echo "<option value=".$vaultTypeId.">".$typeName."</option>"; 
        }
      }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo "<hr>
    <h4>HispanTIC customers</h4>";

    echo '<div class="col-md-4">';
    echo '<label>Costumer:</label>';
    echo '<select class="form-select" name="client" id="client">';
    echo '<option selected disabled>Select an option:</option>';
      $stmt = $conn->prepare("SELECT c.clientNom, c.clientCognoms, c.clientEmpresa, c.id
      FROM db_accounting_hispantic_costumers AS c
      ORDER BY c.id ASC");
      $stmt->execute(); 
      $data = $stmt->fetchAll();
      foreach($data as $row){
          $clientNom = $row['clientNom'];
          $clientCognoms = $row['clientCognoms'];
          $idCustomer = $row['id'];
          $clientEmpresa = $row['clientEmpresa'];
          if ($clientPost == $idCustomer){
            echo "<option value='".$clientPost."' selected>".$clientPost." - ".$clientCognoms.", ".$clientNom." (".$clientEmpresa.")</option>"; 
          } else {
            echo "<option value='".$idCustomer."'>".$idCustomer." - ".$clientCognoms.", ".$clientNom." (".$clientEmpresa.")</option>"; 
          }
        }

    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Project:</label>';
    echo '<select class="form-select" name="project" id="project">';
    echo '<option selected disabled>Select an option:</option>'; 
    $stmt = $conn->prepare("SELECT p.id, p.nomProjecte
    FROM db_projects AS p
    ORDER BY p.id ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idProj = $row['id'];
        $nomProjecte = $row['nomProjecte'];
        if ($projectPost == $idProj){
          echo "<option value=".$projectPost." selected>".$nomProjecte."</option>"; 
        } else {
          echo "<option value=".$idProj.">".$nomProjecte."</option>"; 
        }
      }
    echo '</select>';
    echo '</div>';
    echo "</form>";