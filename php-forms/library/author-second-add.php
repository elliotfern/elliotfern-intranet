<?php
# conectare la base de datos
include_once('../../inc/connection.php');
$idBook = $_POST['idBook'];

// some action goes here under php
    echo '<div class="container-fluid">';
          
    echo '<div class="alert alert-success" id="addSecondAuthorMessageOk" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
    echo '<div class="alert alert-danger" id="addSecondAuthorMessageErr" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>';

    echo '<form method="POST" action="" id="addSecondAuthorForm" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';
    echo '<input type="hidden" id="idBook" name="idBook" value="'.$idBook.'">';

    echo '<div class="col-md-12">';
              echo '<select class="form-select" name="idAuthor" id="idAuthor">';
              echo '<option disabled>Select an option:</option>';
              $stmt = $conn->prepare("SELECT id, AutNom, AutCognom1 
                FROM db_library_authors
                ORDER BY AutCognom1 ASC;");
                $stmt->execute(); 
                $data = $stmt->fetchAll();
                foreach($data as $row){
                  $idAutor = $row['id'];
                  $AutNom = $row['AutNom']; 
                  $AutCognom1 = $row['AutCognom1'];
                echo "<option value=".$idAutor.">".$AutCognom1.", ".$AutNom."</option>"; 
                }
              echo '</select>';
              echo '<label style="color:#dc3545;display:none" id="nomAutorErr">* Author name is missing</label>';
              echo "</div>";
 
    echo '<div class="col-12">';
    echo '<button type="button" class="btn btn-warning" id="btnAddSecondAuthor" onclick="submitAddAnotherAuthor()">Add author</button>';
    echo '</div>';

    echo "</form>";

    ?>
    <script>
    // AJAX PROCESS > PHP - MODAL FORM - UPLOAD IMAGE
function submitAddAnotherAuthor() {
    // check values
    $("#addSecondAuthorMessageErr").hide();
  
    // Stop form from submitting normally
    event.preventDefault();
  
    $.ajax({
      type: "POST",
      url: "./php-process/author-second-insert-process-form.php",
      data: new FormData(document.querySelector("#addSecondAuthorForm")),
      processData: false,
    contentType: false,
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#addSecondAuthorMessageOk").show();
          $('#addSecondAuthorMessageOk').delay(2000).fadeOut('slow');
          $("#addSecondAuthorMessageErr").hide();
          $("#addSecondAuthorForm").hide();
        } else {
          $("#addSecondAuthorMessageErr").show();
          $("#addSecondAuthorMessageOk").hide();
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