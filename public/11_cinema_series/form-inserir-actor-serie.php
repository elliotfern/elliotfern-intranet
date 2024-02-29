<?php
$idSerie = $params['id'];
?>

<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/series">Sèries tv </a></h6>
</div>

<div class="container-fluid form">
<h2>Afegir actor a sèrie tv</h2>

<div class="alert alert-success" id="createPeliMessageOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></h4></strong>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>

<div class="alert alert-danger" id="createPeliMessageErr" style="display:none;" role="alert">
<h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT?></h4></strong>
<h6><?php echo ERROR_TYPE_MESSAGE?></h6>
</div>

<form method="POST" action="" id="inserirActorSerie" class="row g-3">

            <div class="col-md-4">
            <label>Actor/a:</label>
            <select class="form-select" name="idActor" id="idActor">
            </select>
          </div>

          <div class="col-md-4">
            <label>Sèrie tv:</label>
            <select class="form-select" name="idSerie" id="idSerie">
            </select>
          </div>

          <div class="col-md-4">
              <label>Rol:</label>
              <input class="form-control" type="text" name="role" id="role">
            </div>


          <div class="container" style="margin-top:25px">
            <div class="row">
              <div class="col-6 text-left">
              <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
              </div>
              <div class="col-6 text-right derecha">
              <button type="submit" onclick="actorSerie(event)" class="btn btn-primary">Inserir</button>
              </div>
            </div>
          </div>
    </form>

</div>

<script>

  // AJAX PROCESS > PHP - MODAL FORM - CREATE FILM
  function actorSerie(event) {
    // check values
    $("#createBookMessageErr").hide();
    $("#btnCreateBook").show();

    // Stop form from submitting normally
    event.preventDefault();
    let urlAjax = "/api/cinema/post/?actorSerie";
    let formData = $('#inserirActorSerie').serialize();

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
function auxiliarSelect(idAux, api, elementId, valorText) {
  let urlAjax = devDirectory + "/api/cinema/get/?" + api;
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

// (api, elementId, valorText) {
auxiliarSelect(<?php echo $idSerie;?>, "series", "idSerie", "name");
auxiliarSelect("", "actors", "idActor", "nomComplet");
</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');