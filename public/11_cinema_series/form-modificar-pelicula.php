<?php
$id = $params['id'];
?>

<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/pelicules">Pel·lícules </a></h6>
</div>

<div class="container-fluid form">
<h2>Modificar pel·lícula</h2>
<h4 id="titolPeli"></h4>

<div class="alert alert-success" id="updatePeliMessageOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></h4></strong>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>

<div class="alert alert-danger" id="updatePeliMessageErr" style="display:none;" role="alert">
<h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT?></h4></strong>
<h6><?php echo ERROR_TYPE_MESSAGE?></h6>
</div>

<form method="POST" action="" id="modificarPeli" class="row g-3">
<input type="hidden" id="id" name="id" value="<?php echo $id;?>">

            <div class="col-md-4">
              <label>Títol original:</label>
              <input class="form-control" type="text" name="pelicula" id="pelicula" value="">
            </div>
          
          <div class="col-md-4">
            <label>Títol en espanyol:</label>
            <input class="form-control" type="text" name="pelicula_es" id="pelicula_es" value="">
          </div>

          <div class="col-md-4">
            <label>Any d'estrena:</label>
            <input class="form-control" type="text" name="any" id="any" value="">
          </div>

            <div class="col-md-4">
              <label>Data de visió:</label>
              <input class="form-control" type="date" name="dataVista" id="dataVista" value="">
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
            <input type="hidden" id="descripcio" name="descripcio" value="">
            <trix-editor input="descripcio"></trix-editor>
         </div>

          <div class="container" style="margin-top:25px">
            <div class="row">
              <div class="col-6 text-left">
              <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
              </div>
              <div class="col-6 text-right derecha">
              <button type="submit" onclick="updatePelicula(event)" class="btn btn-primary">Actualizar dades</button>
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

  function peliculaInfo(id) {
  let urlAjax = "/api/cinema/get/?pelicula=" + id;
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
        const newContent = "Pel·lícula: " + data[0].pelicula;
        const h2Element = document.getElementById('titolPeli');
        h2Element.innerHTML = newContent;

        document.getElementById('pelicula').value = data[0].pelicula;
        document.getElementById('pelicula_es').value = data[0].pelicula_es;
        document.getElementById('any').value = data[0].any;
        document.getElementById('dataVista').value = data[0].dataVista;

        var texto_desde_bd = data[0].descripcio;
        var editor = document.querySelector("trix-editor");
        editor.editor.loadHTML(texto_desde_bd);
      
        // (api, elementId, valorText) {
        auxiliarSelect(data[0].director, "directors", "director", "nomComplet");
        auxiliarSelect(data[0].img, "imgPelis", "img", "alt");
        auxiliarSelect(data[0].genere, "generesPelis", "genere", "genere_ca");
        auxiliarSelect(data[0].lang, "llengues", "lang", "idioma_ca");
        auxiliarSelect(data[0].pais, "paisos", "pais", "pais_cat");

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

peliculaInfo('<?php echo $id; ?>')

// Carregar el select
function auxiliarSelect(idAux, api, elementId, valorText) {
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

        // Seleccionar automáticamente el valor
        if (idAux) {
          selectElement.value = idAux;
        }

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}


// AJAX PROCESS > PHP - MODAL FORM - UPDATE PELICULA
function updatePelicula(event) {

// Stop form from submitting normally
event.preventDefault();

// Obtener los datos del formulario como un objeto JSON
var formData = Object.fromEntries(new FormData(document.getElementById('modificarPeli')));

// Convertir el objeto en una cadena JSON
var jsonData = JSON.stringify(formData);
    
let urlAjax = "/api/cinema/put/?pelicula";
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
  data: jsonData,
  success: function (response) {
    if (response.status == "success") {
      // Add response in Modal body
      $("#updatePeliMessageOk").show();
      $("#updatePeliMessageErr").hide();
    } else {
      $("#updatePeliMessageErr").show();
      $("#updatePeliMessageOk").hide();
    }
  },
});
}

</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');