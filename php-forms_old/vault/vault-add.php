<?php
# conectare la base de datos
include_once('../../inc/connection.php');
global $conn;

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createVaultMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createVaultMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormAddVault" class="row g-3">';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" id="dateCreated" name="dateCreated" value="'.$timestamp.'">';
    echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';

    echo '<div class="col-md-4">';
    echo '<label for="serveiNom">Service:</label>';
    echo '<input type="text" class="form-control" name="serveiNom" id="serveiNom" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiUsuari">User:</label>';
    echo '<input type="text" class="form-control" name="serveiUsuari" id="serveiUsuari" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiPas">Password:</label>';
    echo '<input type="password" class="form-control" name="serveiPas" id="serveiPas" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiWeb">Web:</label>';
    echo '<input type="text" class="form-control" name="serveiWeb" id="serveiWeb" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Type:</label>';
    echo '<select class="form-control" name="serveiType" id="serveiType" required>';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT t.vaultTypeId, t.typeName 
    FROM db_vault_type AS t
    ORDER BY t.typeName ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $vaultTypeId = $row['vaultTypeId'];
        $typeName = $row['typeName'];
        echo "<option value=".$vaultTypeId.">".$typeName."</option>"; 
      }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo "<hr>
    <h4>HispanTIC customers</h4>";

    echo '<div class="col-md-4">';
    echo '<label>Costumer:</label>';
    echo '<select class="form-control" name="client" id="client">';
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
        echo "<option value=".$idCustomer.">".$idCustomer." - ".$clientCognoms.", ".$clientNom." (".$clientEmpresa.")</option>"; 
      }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Project:</label>';
    echo '<select class="form-control" name="project" id="project">';
    echo '<option selected disabled>Select an option:</option>'; 
    $stmt = $conn->prepare("SELECT p.id, p.nomProjecte
    FROM db_projects AS p
    ORDER BY p.id ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idProj = $row['id'];
        $nomProjecte = $row['nomProjecte'];
        echo "<option value=".$idProj.">".$nomProjecte."</option>"; 
      }
    echo '</select>';
    echo '</div>';