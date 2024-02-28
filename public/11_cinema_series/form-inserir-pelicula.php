<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/pelicules">Pel·lícules </a></h6>
</div>

<div class="container-fluid form">
<h2>Afegir nova pel·lícula</h2>

<div class="alert alert-success" id="createPeliMessageOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></h4></strong>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>

<div class="alert alert-danger" id="createPeliMessageErr" style="display:none;" role="alert">
<h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT?></h4></strong>
<h6><?php echo ERROR_TYPE_MESSAGE?></h6>
</div>

<form method="POST" action="" id="inserirPeli" class="row g-3">
<?php $timestamp = date('Y-m-d');?>
<input type="hidden" id="dateCreated" name="dateCreated" value="<?php echo $timestamp;?>">

            <div class="col-md-4">
              <label>Títol original:</label>
              <input class="form-control" type="text" name="pelicula" id="pelicula">
            </div>
          
          <div class="col-md-4">
            <label>Títol en espanyol:</label>
            <input class="form-control" type="text" name="pelicula_es" id="pelicula_es">
          </div>

          <div class="col-md-4">
            <label>Any d'estrena:</label>
            <input class="form-control" type="text" name="any" id="any">
          </div>

            <div class="col-md-4">
              <label>Data de visió:</label>
              <input class="form-control" type="date" name="dataVista" id="dataVista">
            </div>

            <div class="col-md-4">
            <label>Director:</label>
            <select class="form-select" name="director" id="director">
            </select>
          </div>

          <div class="col-md-4">
            <label>Imatge:</label>
            <select class="form-select" name="img" id="img">
            </select>
          </div>

          <div class="col-md-4">
            <label>Gènere:</label>
            <select class="form-select" name="genere" id="genere">
            </select>
          </div>
      
          <div class="col-md-4">
            <label> País:</label>
            <select class="form-select" name="pais" id="pais">
            </select>
          </div>
      
          <div class="col-md-4">
          <label>Idioma original:</label>
          <select class="form-select" name="lang" id="lang">
          </select>
         </div>

         <div class="col-md-12">
         <label><strong>Crítica de la pel·lícula:</strong></label>
            <!-- Crea un área de texto para Trix -->
            <input type="hidden" id="descripcio" name="descripcio">
            <trix-editor input="descripcio"></trix-editor>
         </div>

          <div class="container" style="margin-top:25px">
            <div class="row">
              <div class="col-6 text-left">
              <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
              </div>
              <div class="col-6 text-right derecha">
              <button type="submit" onclick="createNewFilm(event)" class="btn btn-primary">Inserir</button>
              </div>
            </div>
          </div>
    </form>

</div>
<style>
  trix-editor {
  background-color: white; /* Cambiar el color de fondo a blanco */
  height: 500px; /* Altura del editor Trix, ajustable según tus preferencias */
}
</style>

<script>

document.addEventListener('DOMContentLoaded', function() {
    // Obtener el editor Trix
    var editor = document.querySelector('#descripcio');

    // Verificar si el editor Trix se encontró correctamente
    if (editor) {
      // Escuchar el evento 'trix-change' para detectar cambios en el editor Trix
      editor.addEventListener('trix-change', function(event) {
        // Obtener el contenido actual del editor Trix
        var descripcio = editor.value;
        
        // Actualizar el valor del campo oculto con el contenido del editor Trix
        document.getElementById('descripcio').value = descripcio;
      });
    } else {
      console.error('No se encontró el editor Trix en el documento.');
    }
  });

  // AJAX PROCESS > PHP - MODAL FORM - CREATE FILM
  function createNewFilm(event) {
    // check values
    $("#createBookMessageErr").hide();
    $("#btnCreateBook").show();

    // Stop form from submitting normally
    event.preventDefault();
    let urlAjax = "/api/cinema/post/?pelicula";
    let formData = $('#inserirPeli').serialize();

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
      data: formData,
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#createPeliMessageOk").show();
          $("#createPeliMessageErr").hide();
        } else {
          $("#createPeliMessageErr").show();
          $("#createPeliMessageOk").hide();
        }
      },
    });
  }

// Carregar el select
function auxiliarSelect(api, elementId, valorText) {
  let urlAjax = devDirectory + "/api/cinema/get/auxiliars/?type=" + api;
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
auxiliarSelect("directors", "director", "nomComplet");
auxiliarSelect("imgPelis", "img", "alt");
auxiliarSelect("generesPelis", "genere", "genere_ca");
auxiliarSelect("llengues", "lang", "idioma_ca");
auxiliarSelect("paisos", "pais", "pais_cat");
</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');