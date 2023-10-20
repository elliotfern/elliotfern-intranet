<?php
# conectare la base de datos
global $conn;

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createSupplyCompanyMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createSupplyCompanyMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

   echo '<form method="POST" action="" id="modalFormAddSupplyCompanny" class="row g-3">';

    echo '<div class="col-md-4">';
    echo '<label>Company name</label>';
    echo '<input class="form-control" type="text" name="empresaNom" id="empresaNom">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Company Tax Number</label>';
    echo '<input class="form-control" type="text" name="empresaNIF" id="empresaNIF">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Company address:</label>';
    echo '<input class="form-control" type="url" name="empresaDireccio" id="empresaDireccio">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">
	    <label>Country:</label>
	    <select class="form-select" name="empresaPais" id="empresaPais">';
      echo '<option selected value="">Select a country</option>';
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
	    echo '<label style="color:#dc3545;display:none" id="countryCheck">* Missing data</label>';
	    echo '</div>';
      
echo "</form>";