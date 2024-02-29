<?php
$idSerie = $params['id'];
?>

<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/series">Sèries tv </a></h6>
</div>

<div class="container-fluid form">
<h2 id="titolSerie"></h2>

<div class="alert alert-success" id="createSerieMessageOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></h4></strong>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>

<div class="alert alert-danger" id="createSerieMessageErr" style="display:none;" role="alert">
<h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT?></h4></strong>
<h6><?php echo ERROR_TYPE_MESSAGE?></h6>
</div>

<form method="POST" action="" id="modificarSerie" class="row g-3">
    <input type="hidden" name="id" id="id" value="<?php echo $idSerie;?>">

            <div class="col-md-4">
              <label>Nom de la sèrie:</label>
              <input class="form-control" type="text" name="name" id="name" value="">
            </div>
          
          <div class="col-md-4">
            <label>Any d'inici:</label>
            <input class="form-control soloNumeros" type="text" name="startYear" id="startYear" value="">
          </div>

          <div class="col-md-4">
            <label>Any final:</label>
            <input class="form-control soloNumeros" type="text" name="endYear" id="endYear" value="">
          </div>

            <div class="col-md-4">
              <label>Número de temporades:</label>
              <input class="form-control soloNumeros" type="text" name="season" id="season" value="">
            </div>

            <div class="col-md-4">
              <label>Número de capítols:</label>
              <input class="form-control soloNumeros" type="text" name="chapter" id="chapter" value="">
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
              <button type="submit" onclick="modificarSerie(event)" class="btn btn-primary">Modificar dades</button>
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

  function serieInfo(id) {
  let urlAjax = "/api/cinema/get/?serie=" + id;
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
        document.getElementById('titolSerie').innerHTML = "Sèrie tv: " + data[0].name;

        document.getElementById('name').value = data[0].name;
        document.getElementById('startYear').value = data[0].startYear;
        document.getElementById('endYear').value = data[0].endYear;
        document.getElementById('season').value = data[0].season;
        document.getElementById('chapter').value = data[0].chapter;

        var texto_desde_bd = data[0].descripcio;
        var editor = document.querySelector("trix-editor");
        editor.editor.loadHTML(texto_desde_bd);
      
        // (api, elementId, valorText) {
        auxiliarSelect(data[0].idDirector, "directors", "director", "nomComplet");
        auxiliarSelect(data[0].idImg, "imgSeries", "img", "alt");
        auxiliarSelect(data[0].idGen, "generesPelis", "genre", "genere_ca");
        auxiliarSelect(data[0].idLang, "llengues", "lang", "idioma_ca");
        auxiliarSelect(data[0].idPais, "paisos", "country", "pais_cat");
        auxiliarSelect(data[0].idProductora, "productores", "producer", "productora");

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

serieInfo('<?php echo $idSerie; ?>')

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

  // AJAX PROCESS > PHP - MODAL FORM - CREATE FILM
  function modificarSerie(event) {
    // check values
    $("#createSerieMessageErr").hide();

    // Stop form from submitting normally
    event.preventDefault();
    let urlAjax = "/api/cinema/put/?serie";

    // Obtener los datos del formulario como un objeto JSON
    var formData = Object.fromEntries(new FormData(document.getElementById('modificarSerie')));

    // Convertir el objeto en una cadena JSON
    var jsonData = JSON.stringify(formData);

    $.ajax({
      type: "PUT",
      url: urlAjax,
      dataType: "json",
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
          $("#createSerieMessageOk").show();
          $("#createSerieMessageErr").hide();
        } else {
          $("#createSerieMessageErr").show();
          $("#createSerieMessageOk").hide();
        }
      },
    });
  }


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