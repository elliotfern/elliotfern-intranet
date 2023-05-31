<?php
# conectare la base de datos
include_once('../../inc/connection.php');

// some action goes here under php
    echo '<div class="container-fluid">';
          
    echo '<div class="alert alert-success" id="createImgMessageOk" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
    echo '<div class="alert alert-danger" id="createImgMessageErr" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>';

    echo '<form method="POST" action="" id="uploadImgForm" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';
    $type = $_POST['idType'];

    echo '<input type="hidden" name="type" id="type" value="'.$type.'">';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" name="dateCreated" id="dateCreated" value="'.$timestamp.'">';
    
    echo '<div class="col-md-6">';
    echo '<input class="form-control" type="text" name="alt" id="alt" placeholder="Image title">';
    echo '<label style="color:#dc3545">* </label>';
    echo "</div>";

    echo '<div class="col-md-6">
    <input class="form-control" type="file" id="fileToUpload" name="fileToUpload">
    </div>';
 
    echo '<div class="col-12">';
    echo '<button type="button" class="btn btn-warning" id="btnUploadImage" onclick="submitUploadImg()">Upload image</button>';
    echo '</div>';

    echo "</form>";

    ?>
    <script>
    // AJAX PROCESS > PHP - MODAL FORM - UPLOAD IMAGE
function submitUploadImg() {
    // check values
    $("#updateAuthorMessageErr").hide();
  
    // Stop form from submitting normally
    event.preventDefault();
  
    $.ajax({
      type: "POST",
      url: "./php-process/image-upload-process-form.php",
      data: new FormData(document.querySelector("#uploadImgForm")),
      cache: false,
                  contentType: false,
                  dataType: 'JSON',
                  enctype: 'multipart/form-data',
                  processData: false,
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#createImgMessageOk").show();
          $('#createImgMessageOk').delay(2000).fadeOut('slow');
          $("#createImgMessageErr").hide();
          $("#uploadImgForm").hide();
          var idImage = response.id;
          var nameImage = response.name;
          var $select = $('#img').selectize();
          var selectize = $select[0].selectize;
          selectize.addOption({id: idImage, value: idImage, text: nameImage});
          selectize.addItem(idImage);
          selectize.refreshOptions();

          // $('#img').append($('<option>').val(idImage).text(nameImage));
        } else {
          $("#createImgMessageErr").show();
          $("#createImgMessageOk").hide();
        }
      },
    });
  }
  
  </script>