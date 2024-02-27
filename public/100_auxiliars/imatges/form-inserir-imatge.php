<h2>Eines auxiliars > Imatges</h2>
<h4>Pujar nova imatge al servidor</h4>

<hr>

<div class="alert alert-success" id="createImgMessageOk" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>
      
<div class="alert alert-danger" id="createImgMessageErr" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>

 <form method="POST" action="" id="uploadImgForm" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">
 
 <select class="form-select" id="typeImg" name="typeImg">
  <option selected>Selecciona el tipus d'imatge</option>
  <option value="1">Biblioteca llibres: autors</option>
  <option value="2">Biblioteca llibres: llibres</option>
</select>

<?php $timestamp = date('Y-m-d');?>
<input type="hidden" name="dateCreated" id="dateCreated" value="'<?php echo $timestamp;?>'">
    
<div class="col-md-6">
<input class="form-control" type="text" name="alt" id="alt" placeholder="Image title">
<label style="color:#dc3545">* </label>
</div>

<div class="col-md-6">
    <input class="form-control" type="file" id="fileToUpload" name="fileToUpload">
    </div>
 
<div class="col-12">
    <button type="button" class="btn btn-warning" id="btnUploadImage" onclick="submitUploadImg()">Upload image</button>
</div>

</form>


<script>
    // AJAX PROCESS > PHP - MODAL FORM - UPLOAD IMAGE
function submitUploadImg() {
    // check values
    $("#updateAuthorMessageErr").hide();
  
    // Stop form from submitting normally
    event.preventDefault();
    let urlAjax = "/api/auxiliars/post/imatges";
    $.ajax({
      type: "POST",
      url: urlAjax,
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
          $("#createImgMessageErr").hide();

          // $('#img').append($('<option>').val(idImage).text(nameImage));
        } else {
          $("#createImgMessageErr").show();
          $("#createImgMessageOk").hide();
        }
      },
    });
  }
  
</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');