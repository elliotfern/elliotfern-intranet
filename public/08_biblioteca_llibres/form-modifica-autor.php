<?php
$id = $params['id'];
?>

<h6><a href="<?php echo APP_DEV;?>/biblioteca">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/autors">Autors </a></h6>
</div>

  <div class="container-fluid form">
    <h2>Modificar les dades de l'autor</h2>
    <h4 id="authorUpdateTitle"></h4>

  <div class="alert alert-success" id="updateAuthorMessageOk" style="display:none" role="alert">
  <h4 class="alert-heading"><strong><?php echo UPDATE_OK_MESSAGE_SHORT; ?></h4></strong>
  <h6><?php echo UPDATE_OK_MESSAGE;?></h6>
  </div>
      
  <div class="alert alert-danger" id="updateAuthorMessageErr" style="display:none" role="alert">
  <h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT; ?></h4></strong>
  <h6><?php echo ERROR_TYPE_MESSAGE; ?></h6>
  </div>

    <form method="POST" action="" class="row g-3">

    <input type="hidden" name="id" id="id" value="">

    <div class="col-md-4">
    <label>Nom:</label>
    <input class="form-control" type="text" name="nom" id="nom" value="">
    </div>

    <div class="col-md-4">
    <label>Cognoms:</label>
    <input class="form-control" type="text" name="cognoms" id="cognoms" value="">
    </div>

    <div class="col-md-4">
    <label>Slug:</label>
    <input class="form-control" type="text" name="slug" id="slug" value="">
    </div>

    <div class="col-md-4">
    <label>Pàgina web:</label>
    <input class="form-control" type="url" name="AutWikipedia" id="AutWikipedia" value="">
    </div>

    <div class="col-md-4">
    <label>Any de naixement:</label>
    <input class="form-control" type="url" name="yearBorn" id="yearBorn" value="">
    </div>

    <div class="col-md-4">
    <label>Any de defunció:</label>
    <input class="form-control" type="url" name="yearDie" id="yearDie" value="">
    </div>

    <div class="col-mb-3">
  <label for="AutDescrip" class="form-label">Descripció:</label>
  <textarea class="form-control" id="AutDescrip" name="AutDescrip" rows="3"></textarea>
</div>

    <div class="col-md-4">
    <label>Professió</label>
    <select class="form-select" name="ocupacio" id="ocupacio">
  </select>
    </div>

    <div class="col-md-4">
    <label>Moviment:</label>
    <select class="form-select" name="moviment" id="moviment">
  </select>
    </div>

    <div class="col-md-4">
    <label>País:</label>
    <select class="form-select" name="paisAutor" id="paisAutor">
  </select>
    </div>

    <div class="col-md-4">
    <label>Imatge:</label>
    <select class="form-select" name="img" id="img">
  </select>
    </div>

    <hr/>

    <div class="container">
    <div class="row">
      <div class="col-6 text-left">
      <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
      </div>
      <div class="col-6 text-right derecha">
      <button type="submit" onclick="updateAuthor(event)" class="btn btn-primary">Actualitza autor</button>
      </div>
    </div>
  </div>


</form>

<script>
 function formUpdateAuthor(id) {
  let urlAjax = devDirectory + "/api/biblioteca/get/autor/?autor-id=" + id;
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function (xhr) {
      // Obtener el token del localStorage
      let token = localStorage.getItem('token');

      // Incluir el token en el encabezado de autorización
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },

    success: function (data) {
      // Establecer valores en los campos del formulario
      document.getElementById('nom').value = data.AutNom;
      document.getElementById("cognoms").value = data.AutCognom1;
      document.getElementById('slug').value = data.slug;
      document.getElementById('AutWikipedia').value = data.AutWikipedia;
      document.getElementById('yearBorn').value = data.yearBorn;
      document.getElementById('yearDie').value = data.yearDie;
      document.getElementById('AutDescrip').innerHTML = decodeURIComponent(data.AutDescrip);
      document.getElementById('id').value = data.id;

      const newContent = "Autor: " + data.AutNom + " " + data.AutCognom1;
      const h2Element = document.getElementById('authorUpdateTitle');
      h2Element.innerHTML = newContent;

      // Ahora llenar el select con las opciones y seleccionar la opción adecuada
      formProfessionAuthor(data.AutOcupacio, true);
      formMovimentAuthor(data.idMovement, true);
      formCountry(data.idPais, true);
      formImageAuthor(data.idImg, true);
    }
  })
}

// AJAX PROCESS > PHP - MODAL FORM - UPDATE AUTHOR
function updateAuthor(event) {

// Stop form from submitting normally
event.preventDefault();
// Obtener los datos del formulario
let formData = {
        nom: $("#nom").val(),
        cognoms: $("#cognoms").val(),
        yearBorn: $("#yearBorn").val(),
        yearDie: $("#yearDie").val(),
        paisAutor: $("#paisAutor").val(),
        img: $("#img").val(),
        AutWikipedia: $("#AutWikipedia").val(),
        AutDescrip: $("#AutDescrip").val(),
        moviment: $("#moviment").val(),
        ocupacio: $("#ocupacio").val(),
        id: $("#id").val(),
        slug: $("#slug").val()
    };


let urlAjax = "/api/biblioteca/put/?autor";
$.ajax({
  contentType: "application/json", // Establecer el tipo de contenido como JSON
  type: "PUT",
  url: urlAjax,
  dataType: "JSON",
  beforeSend: function (xhr) {
    // Obtener el token del localStorage
    let token = localStorage.getItem('token');

    // Incluir el token en el encabezado de autorización
    xhr.setRequestHeader('Authorization', 'Bearer ' + token);
  },
  data: JSON.stringify(formData),
  success: function (response) {
    console.log('Response received:', response);
    if (response.status == "success") {
      // Add response in Modal body
      $("#updateAuthorMessageOk").show();
      $("#updateAuthorMessageErr").hide();
    } else {
      $("#updateAuthorMessageErr").show();
      $("#updateAuthorMessageOk").hide();
    }
  },
});
}

</script>

<script> formUpdateAuthor(<?php echo $id;?>)</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');