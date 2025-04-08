<div class="container">
  <main>
    <div class="container">

      <h1>Taules auxiliars</h1>
      <h2>Imatges</h2>
      <h6><a href="<?php echo APP_INTRANET . $url['auxiliars']; ?>">Auxiliars</a> > Inici </h6>

      <div class="alert-success" id="createImgMessageOk" style="display:none;margin-top:20px" role="alert">
        <h4 class="alert-heading"><strong>ok</h4></strong>
        <h6></h6>
      </div>

      <div class="alert alert-danger" id="createImgMessageErr" style="display:none;margin-top:20px" role="alert">
        <h4 class="alert-heading"><strong>error</h4></strong>
        <h6></h6>
      </div>

      <form method="POST" action="" id="uploadImgForm" class="row g-3">

        <select class="form-select" id="typeImg" name="typeImg">
          <option selected>Selecciona el tipus d'imatge</option>
          <option value="1">Biblioteca llibres: autor</option>
          <option value="2">Biblioteca llibres: llibre</option>
          <option value="3">Història: imatge</option>
          <option value="4">Història: esdeveniment</option>
          <option value="5">Història: persona</option>
          <option value="6">Història: organització</option>
          <option value="12">Història: mapa</option>
          <option value="15">Història: infografia</option>
          <option value="16">Història: cronologia</option>
          <option value="7">Cinema: sèrie tv</option>
          <option value="8">Cinema: pel·lícula</option>
          <option value="9">Cinema: actor</option>
          <option value="14">Cinema: director</option>
          <option value="10">Història: thumbnail</option>
          <option value="11">Viatges: viatge</option>
          <option value="13">Blog</option>
        </select>

        <?php $timestamp = date('Y-m-d'); ?>
        <input type="hidden" name="dateCreated" id="dateCreated" value="'<?php echo $timestamp; ?>'">

        <div class="col-md-6">
          <input class="form-control" type="text" name="alt" id="alt" placeholder="Image title">
          <label style="color:#dc3545">* </label>
        </div>

        <div class="col-md-6">
          <input class="form-control" type="file" id="fileToUpload" name="fileToUpload">
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-warning" id="btnUploadImage">Upload image</button>
        </div>

      </form>

    </div>
  </main>
</div>

<script>
  document.querySelector("#uploadImgForm").addEventListener("submit", submitUploadImg);

  // AJAX PROCESS > PHP - MODAL FORM - UPLOAD IMAGE
  async function submitUploadImg(event) {
    // check values
    document.getElementById("createImgMessageErr").style.display = 'none';

    // Stop form from submitting normally
    event.preventDefault();

    let urlAjax = "/api/auxiliars/post/imatges";
    let formData = new FormData(document.querySelector("#uploadImgForm"));

    try {
      const response = await fetch(urlAjax, {
        method: "POST",
        body: formData,
      });

      const result = await response.json(); // parse the response as JSON

      if (result.status === "success") {
        // Add response in Modal body
        document.getElementById("createImgMessageOk").style.display = 'block';
        document.getElementById("createImgMessageErr").style.display = 'none';

        // Here you can append the new image to a list or perform other actions if needed
      } else {
        document.getElementById("createImgMessageErr").style.display = 'block';
        document.getElementById("createImgMessageOk").style.display = 'none';
      }
    } catch (error) {
      console.error("Error uploading image:", error);
    }
  }
</script>