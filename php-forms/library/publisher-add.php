<?php
# conectare la base de datos
include_once('../../inc/connection.php');

// some action goes here under php
    echo '<div class="container-fluid">';
          
    echo '<div class="alert alert-success" id="addPublisherMessageOk" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
    echo '<div class="alert alert-danger" id="addPublisherMessageErr" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>';

    echo '<form method="POST" action="" id="createPublisherForm" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    echo '<div class="col-md-6">';
    echo '<input class="form-control" type="text" name="nomEditorial" id="nomEditorial" placeholder="Publisher name">';
    echo '<label style="color:#dc3545">* </label>';
    echo "</div>";

    echo '<div class="col-md-6">';
    echo '<input class="form-control" type="text" name="linkEditorial" id="linkEditorial" placeholder="Publisher website">';
    echo '<label style="color:#dc3545">* </label>';
    echo "</div>";

    echo '<div class="col-md-4">
    <label>Country:</label>
    <select class="form-control" name="paisEditorial" id="paisEditorial">
    <option selected disabled selected>Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.id, p.country
    FROM db_countries AS p
    ORDER BY p.country ASC;");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idPais = $row['id'];
        $country = $row['country'];
        echo "<option value=".$idPais.">".$country."</option>"; 
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="countryCheck">* Missing data</label>';
    echo '</div>';
 
    echo '<div class="col-12">';
    echo '<button type="button" class="btn btn-warning" id="btnCreatePublisher" onclick="submitCreatePublisher()">Add publisher</button>';
    echo '</div>';

    echo "</form>";

    ?>
    <script>
    // AJAX PROCESS > PHP - MODAL FORM - UPLOAD IMAGE
function submitCreatePublisher() {
    // check values
    $("#addPublisherMessageErr").hide();
  
    // Stop form from submitting normally
    event.preventDefault();
  
    $.ajax({
      type: "POST",
      url: "./php-process/publisher-insert-process-form.php",
      data: new FormData(document.querySelector("#createPublisherForm")),
      processData: false,
    contentType: false,
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#addPublisherMessageOk").show();
          $('#addPublisherMessageOk').delay(2000).fadeOut('slow');
          $("#addPublisherMessageErr").hide();
          $("#createPublisherForm").hide();
          var idEditorial = response.id;
          var nameEd = response.name;
          var $select = $('#idEd').selectize();
          var selectize = $select[0].selectize;
          selectize.addOption({id: idEditorial, value: idEditorial, text: nameEd});
          selectize.addItem(idEditorial);
          selectize.refreshOptions();

          // $('#img').append($('<option>').val(idImage).text(nameImage));
        } else {
          $("#addPublisherMessageErr").show();
          $("#addPublisherMessageOk").hide();
        }
      },
    });
  }
  
  </script>