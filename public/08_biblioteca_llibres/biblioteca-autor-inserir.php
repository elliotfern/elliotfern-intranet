
<h6><a href="<?php echo APP_DEV;?>/biblioteca/">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/autors">Autors/es </a></h6>
</div>

  <div class="container-fluid form">
    <h2>Afegir nou autor</h2>

  <div class="alert alert-success" id="createAuthorMessageOk" style="display:none" role="alert">
  <h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT; ?></h4></strong>
  <h6><?php echo ADD_OK_MESSAGE;?></h6>
  </div>
      
  <div class="alert alert-danger" id="createAuthorMessageErr" style="display:none" role="alert">
  <h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT; ?></h4></strong>
  <h6><?php echo ERROR_TYPE_MESSAGE; ?></h6>
  </div>

    <form method="POST" action="" class="row g-3">

    <div class="col-md-4">
    <label>Nom</label>
    <input class="form-control" type="text" name="AutNom" id="AutNom" value="">
    </div>

    <div class="col-md-4">
    <label>Cognoms</label>
    <input class="form-control" type="text" name="AutCognom1" id="AutCognom1" value="">
    </div>

    <div class="col-md-4">
    <label>Slug</label>
    <input class="form-control" type="text" name="slug" id="slug" value="">
    </div>

    <div class="col-md-4">
    <label>Pàgina web</label>
    <input class="form-control" type="url" name="AutWikipedia" id="AutWikipedia" value="">
    </div>

    <div class="col-md-4">
    <label>Any de naixement</label>
    <input class="form-control" type="url" name="yearBorn" id="yearBorn" value="">
    </div>

    <div class="col-md-4">
    <label>Any de defunció</label>
    <input class="form-control" type="url" name="yearDie" id="yearDie" value="">
    </div>

    <div class="col-mb-3">
  <label for="AutDescrip" class="form-label">Descripció</label>
  <textarea class="form-control" id="AutDescrip" name="AutDescrip" rows="3"></textarea>
</div>

    <div class="col-md-4">
    <label>Professió</label>
    <select class="form-select" name="AutOcupacio" id="AutOcupacio">
  </select>
    </div>

    <div class="col-md-4">
    <label>Moviment</label>
    <select class="form-select" name="AutMoviment" id="AutMoviment">
  </select>
    </div>

    <div class="col-md-4">
    <label>País de residència</label>
    <select class="form-select" name="paisAutor" id="paisAutor">
  </select>
    </div>

    <div class="col-md-4">
    <label>Imatge</label>
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
      <button type="submit" onclick="createNewAuthor(event)" class="btn btn-primary">Crear autor</button>
      </div>
    </div>
  </div>

 
</form>
</div>

<script>

// AJAX PROCESS > PHP - MODAL FORM - INSERT AUTHOR
function createNewAuthor(event) {
  event.preventDefault();
  let urlAjax = devDirectory + "/api/biblioteca/post/?autor";

  $.ajax({
    type: "POST",
    url: urlAjax,
    dataType: "json",
    beforeSend: function (xhr) {
      // Obtener el token del localStorage
      let token = localStorage.getItem('token');

      // Incluir el token en el encabezado de autorización
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },
    data: {
      nom: $("#AutNom").val(),
      cognoms: $("#AutCognom1").val(),
      slug: $("#slug").val(),
      yearBorn: $("#yearBorn").val(),
      yearDie: $("#yearDie").val(),
      paisAutor: $("#paisAutor").val(),
      img: $("#img").val(),
      AutWikipedia: $("#AutWikipedia").val(),
      AutDescrip: $("#AutDescrip").val(),
      moviment: $("#AutMoviment").val(),
      dateCreated: $("#dateCreated").val(),
      ocupacio: $("#AutOcupacio").val(),
    },
    success: function (response) {
      if (response.status == "success") {
        // Add response in Modal body
        $("#createAuthorMessageOk").show();
        $("#createAuthorMessageErr").hide();
      } else {
        $("#createAuthorMessageErr").show();
        $("#createAuthorMessageOk").hide();
      }
    },
  });
}

// Carregar el select
function auxiliarSelect(api, elementId, valorText) {
  let urlAjax = devDirectory + "/api/biblioteca/auxiliars/?" + api;
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
       try {
        // Obtener la referencia al elemento select
        var selectElement = document.getElementById(elementId);

        // Limpiar el select por si ya tenía opciones anteriores
        selectElement.innerHTML = "";

        // Agregar una opción predeterminada "Selecciona una opción"
        var defaultOption = document.createElement("option");
        defaultOption.text = "Selecciona una opció:";
        defaultOption.value = ""; // Valor vacío
        selectElement.appendChild(defaultOption);

        // Iterar sobre los datos obtenidos de la API
        data.forEach(function (item) {
          // Crear una opción y agregarla al select
         // console.log(item.ciutat)
          var option = document.createElement("option");
          option.value = item.id; // Establecer el valor de la opción
          option.text = item[valorText]; // Establecer el texto visible de la opción
          selectElement.appendChild(option);
        });

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

// (api, elementId, valorText) {
auxiliarSelect("imageAuthor", "img", "alt");
auxiliarSelect("professio", "AutOcupacio", "professio_ca");
auxiliarSelect("moviment", "AutMoviment", "movement_ca");
auxiliarSelect("pais", "paisAutor", "pais_ca");
</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');