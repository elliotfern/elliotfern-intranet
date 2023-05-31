<?php
# conectare la base de datos
include_once('../../inc/connection.php');

// some action goes here under php
    echo '<div class="container-fluid">';
          
    echo '<div class="alert alert-success" id="createCustomerMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
    echo '<div class="alert alert-danger" id="createCustomerMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

   echo '<form method="POST" action="" id="modalFormAddCustomer" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

   $timestamp = date('Y-m-d');
   echo '<input type="hidden" id="clientRegistre" name="clientRegistre" value="'.$timestamp.'">';

    echo '<div class="col-md-4">';
    echo '<label>Customer First Name:</label>';
    echo '<input class="form-control" type="text" name="clientNom" id="clientNom">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Last name:</label>';
    echo '<input class="form-control" type="text" name="clientCognoms" id="clientCognoms">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Email:</label>';
    echo '<input class="form-control" type="email" name="clientEmail" id="clientEmail">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';
    
    echo '<div class="col-md-4">';
    echo '<label>Website:</label>';
    echo '<input class="form-control" type="url" name="clientWeb" id="clientWeb">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Company name:</label>';
    echo '<input class="form-control" type="text" name="clientEmpresa" id="clientEmpresa">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>TFN:</label>';
    echo '<input class="form-control" type="text" name="clientNIF" id="clientNIF">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Address:</label>';
    echo '<input class="form-control" type="text" name="clientAdreca" id="clientAdreca">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Postal code:</label>';
    echo '<input class="form-control" type="text" name="clientCP" id="clientCP">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Telephone:</label>';
    echo '<input class="form-control" type="text" name="clientTelefon" id="clientTelefon">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>City:</label>';
    echo '<select class="form-select" name="clientCiutat" id="clientCiutat">';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT c.id, c.city 
    FROM db_cities AS c
    ORDER BY c.city ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idC = $row['id'];
        $city = $row['city'];
        echo "<option value='".$idC."'>".$city."</option>"; 
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutOcupacioCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>County:</label>';
    echo '<select class="form-select" name="clientProvincia" id="clientProvincia">';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT co.id, co.county
    FROM db_countries_counties AS co
    ORDER BY co.county ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idCo = $row['id'];
        $county = $row['county'];
        echo "<option value='".$idCo."'>".$county."</option>"; 
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutOcupacioCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Country:</label>';
    echo '<select class="form-select" name="clientPais" id="clientPais">';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT con.id, con.country 
    FROM db_countries AS con
    ORDER BY con.country ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idCont = $row['id'];
        $country = $row['country'];
        echo "<option value='".$idCont."'>".$country."</option>"; 
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutOcupacioCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Customer status:</label>';
    echo '<select class="form-select" name="clientStatus" id="clientStatus">';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT cs.id, cs.estatNom
    FROM db_accounting_hispantic_costumers_status AS cs
    ORDER BY cs.id ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idstatus = $row['id'];
        $estatNom = $row['estatNom'];
        echo "<option value='".$idstatus."'>".$idstatus." - ".$estatNom."</option>"; 
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutOcupacioCheck">* Missing data</label>';
    echo '</div>';
   
    ?>
              <script>
                $(function() {
                    

                    $('#img').selectize({
                      create: true,
                      preload: true,
                      valueField: 'id',
                      labelField: 'text',
                      searchField: 'text',                  
                    });
                });
              </script>
          <?php

echo "</form>";