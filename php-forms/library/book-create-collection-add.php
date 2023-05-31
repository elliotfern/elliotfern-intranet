<?php
# conectare la base de datos
include_once('../../inc/connection.php');

// some action goes here under php
    echo '<div class="container-fluid">';
          
    echo '<div class="alert alert-success" id="addNewCollectionMessageOk" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
    echo '<div class="alert alert-danger" id="addNewCollectionMessageErr" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>';

    echo '<form method="POST" action="" id="createNewCollectionBookForm" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';
    
    echo ' <div class="row">';

    echo '<div class="col-md-6 separador">';
    echo '<label>Collection name:</label>';
    echo '<input class="form-control" type="text" name="nomCollection" id="nomCollection">';
    echo '<label style="color:#dc3545;display:none" id="anyErr">* Year is missing</label>';
    echo "</div>";
    
    echo '<div class="col-md-6">';
    echo '<label>Publisher:</label>';
    echo '<select class="form-select" name="idPublisher" id="idPublisher">';
    echo '<option selected value="">Select a publisher</option>';
    $stmt = $conn->prepare("SELECT nomEditorial, idEditorial 
    FROM db_library_publishers
    ORDER BY nomEditorial ASC;");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach ($data as $row) {
      $nomEditorial = $row['nomEditorial'];
      $idEditorial = $row['idEditorial'];
      echo "<option value='".$idEditorial."'>".$nomEditorial."</option>"; 
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="nomAutorErr">* Author name is missing</label>';
    echo "</div>";

    echo "</div>";

    echo '<div class="col-12">';
    echo '<button type="button" class="btn btn-warning" id="btnCreateNewCollection" onclick="createNewBookCollection()">Create new collection</button>';
    echo '</div>';
    echo "</form>";

    ?>
    <script>
    // AJAX PROCESS > PHP - MODAL FORM - UPLOAD IMAGE
function createNewBookCollection() {
    // check values
    $("#addSecondAuthorMessageErr").hide();
  
    // Stop form from submitting normally
    event.preventDefault();
  
    $.ajax({
      type: "POST",
      url: "./php-process/book-new-collection-insert-process-form.php",
      data: new FormData(document.querySelector("#createNewCollectionBookForm")),
      processData: false,
    contentType: false,
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#addNewCollectionMessageOk").show();
          $('#addNewCollectionMessageOk').delay(2000).fadeOut('slow');
          $("#addNewCollectionMessageErr").hide();
          $("#createNewCollectionBookForm").hide();
          var idCollection = response.idCollection;
          var nomCollection = response.nomCollection;
          var $select = $('#idCollection').selectize();
          var selectize = $select[0].selectize;
          selectize.addOption({id: idCollection, value: idCollection, text: nomCollection});
          selectize.addItem(idCollection);
          selectize.refreshOptions();
        } else {
          $("#addNewCollectionMessageErr").show();
          $("#addNewCollectionMessageOk").hide();
        }
      },
    });
  }
  
  $(function() {
                    $('#nomAutor').selectize({
                      create: true,
                      preload: true,
                      valueField: 'id',
                      labelField: 'text',
                      searchField: 'text',                  
                    });
                });
  </script>