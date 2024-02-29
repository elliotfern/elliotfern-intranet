<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/series">Sèries tv </a></h6>
</div>

<div class="container-fluid form">
<h2>Afegir nova sèrie tv</h2>

<div class="alert alert-success" id="createSerieMessageOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></h4></strong>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>

<div class="alert alert-danger" id="createSerieMessageErr" style="display:none;" role="alert">
<h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT?></h4></strong>
<h6><?php echo ERROR_TYPE_MESSAGE?></h6>
</div>

<form method="POST" action="" id="inserirSerie" class="row g-3">

            <div class="col-md-4">
              <label>Nom de la sèrie:</label>
              <input class="form-control" type="text" name="name" id="name">
            </div>
          
          <div class="col-md-4">
            <label>Any d'inici:</label>
            <input class="form-control soloNumeros" type="text" name="startYear" id="startYear">
          </div>

          <div class="col-md-4">
            <label>Any final:</label>
            <input class="form-control soloNumeros" type="text" name="endYear" id="endYear">
          </div>

            <div class="col-md-4">
              <label>Número de temporades:</label>
              <input class="form-control soloNumeros" type="text" name="season" id="season">
            </div>

            <div class="col-md-4">
              <label>Número de capítols:</label>
              <input class="form-control soloNumeros" type="text" name="chapter" id="chapter">
            </div>

            <div class="col-md-4">
            <label>Director:</label>
            <select class="form-select" name="director" id="director">
            </select>
          </div>

          <div class="col-md-4">
            <label>Productor:</label>
            <select class="form-select" name="producer" id="producer">
            </select>
          </div>

          <div class="col-md-4">
            <label>Imatge:</label>
            <select class="form-select" name="img" id="img">
            </select>
          </div>

          <div class="col-md-4">
            <label>Gènere:</label>
            <select class="form-select" name="genre" id="genre">
            </select>
          </div>
      
          <div class="col-md-4">
            <label> País:</label>
            <select class="form-select" name="country" id="country">
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
  const inputs = document.querySelectorAll('.soloNumeros');

inputs.forEach(input => {
  input.addEventListener('input', function() {
    if (isNaN(this.value)) {
      this.value = ''; // Limpiar el valor si no es un número
    }
  });
});

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
    $("#createSerieMessageErr").hide();

    // Stop form from submitting normally
    event.preventDefault();
    let urlAjax = "/api/cinema/post/?serie";
    let formData = $('#inserirSerie').serialize();

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
          $("#createSerieMessageOk").show();
          $("#createSerieMessageErr").hide();
        } else {
          $("#createSerieMessageErr").show();
          $("#createSerieMessageOk").hide();
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
auxiliarSelect("imgSeries", "img", "alt");
auxiliarSelect("generesPelis", "genre", "genere_ca");
auxiliarSelect("llengues", "lang", "idioma_ca");
auxiliarSelect("paisos", "country", "pais_cat");
auxiliarSelect("productores", "producer", "productora");

window.addEventListener('beforeunload', function(event) {
    // Cancela el evento de cierre predeterminado
    event.preventDefault();
    // Mensaje de advertencia
    event.returnValue = '';
    // Muestra el mensaje de advertencia
    alert('¿Estás seguro que quieres cerrar la ventana?');
});
</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');