<?php
if (isset($_POST['idAuthor'])) {
  $idAuthor_old = $_POST['idAuthor'];
} else {
  $idAuthor_old = NULL;
}

?>
<h6><a href="<?php echo APP_DEV;?>/biblioteca/">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/llibres">Llibres </a></h6>
</div>

<div class="container-fluid form">
<h2>Afegir nou llibre</h2>

<div class="alert alert-success" id="createBookMessageOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></h4></strong>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>
      
<div class="alert alert-danger" id="createBookMessageErr" style="display:none;" role="alert">
<h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT?></h4></strong>
<h6><?php echo ERROR_TYPE_MESSAGE?></h6>
</div>

<form method="POST" action="" id="modalFormBook" class="row g-3">
<?php $timestamp = date('Y-m-d');?>
<input type="hidden" id="dateCreated" name="dateCreated" value="<?php echo $timestamp;?>">

            <div class="col-md-4">
              <label>Títol original:</label>
              <input class="form-control" type="text" name="titol" id="titol">
            </div>
          
          <div class="col-md-4">
            <label>Títol en anglés:</label>
            <input class="form-control" type="text" name="titolEng" id="titolEng">
          </div>

          <div class="col-md-4">
            <label>Slug:</label>
            <input class="form-control" type="text" name="slug" id="slug">
          </div>

            <div class="col-md-4">
              <label>Autor:</label>
              <select class="form-select" name="autor" id="autor">
              </select>
            </div>

          <div class="col-md-4">
            <label>Imatge coberta:</label>
            <select class="form-select" name="img" id="img">
            </select>
          </div>

            <div class="col-md-4">
              <label>Any de publicació:</label>
              <input class="form-control" type="text" name="any" id="any">
            </div>
      
          <div class="col-md-4">
            <label> Editorial:</label>
            <select class="form-select" name="idEd" id="idEd">
            </select>
          </div>
      
          <div class="col-md-4">
          <label>Gènere:</label>
          <select class="form-select" name="idGen" id="idGen">
          </select>
         </div>

         <div class="col-md-4">
          <label>Sub-gènere:</label>
          <select class="form-select" name="subGen" id="subGen">
          </select>
         </div>
      
          <div class="col-md-4">
          <label>Idioma:</label>
          <select class="form-select" name="lang" id="lang">
          </select>
          </div>
      
          <div class="col-md-4">
          <label>Tipus:</label>
          <select class="form-select" name="tipus" id="tipus">
          </select>
          </div>
              
          <div class="container" style="margin-top:25px">
            <div class="row">
              <div class="col-6 text-left">
              <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
              </div>
              <div class="col-6 text-right derecha">
              <button type="submit" onclick="createNewBook(event)" class="btn btn-primary">Nou llibre</button>
              </div>
            </div>
          </div>
    </form>

</div>

<script>
  // AJAX PROCESS > PHP - MODAL FORM - CREATE BOOK
  function createNewBook(event) {
    // check values
    $("#createBookMessageErr").hide();
    $("#btnCreateBook").show();

    // Stop form from submitting normally
    event.preventDefault();
    let urlAjax = devDirectory + "/api/biblioteca/post/?type=llibre";

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
        autor: $("#autor").val(),
        titol: $("#titol").val(),
        titolEng: $("#titolEng").val(),
        slug: $("#slug").val(),
        any: $("#any").val(),
        idEd: $("#idEd").val(),
        idGen: $("#idGen").val(),
        subGen: $("#subGen").val(),
        lang: $("#lang").val(),
        img: $("#img").val(),
        tipus: $("#tipus").val(),
        dateCreated: $("#dateCreated").val(),
      },
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#createBookMessageOk").show();
          $("#createBookMessageErr").hide();
        } else {
          $("#createBookMessageErr").show();
          $("#createBookMessageOk").hide();
        }
      },
    });
  }

// Carregar el select
function auxiliarSelect(api, elementId, valorText) {
  let urlAjax = devDirectory + "/api/biblioteca/auxiliars/?type=" + api;
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
auxiliarSelect("autors", "autor", "nomComplet");
auxiliarSelect("imatgesLlibres", "img", "alt");
auxiliarSelect("editorials", "idEd", "editorial");
auxiliarSelect("generes", "idGen", "genere_cat");
auxiliarSelect("subgeneres", "subGen", "sub_genere_cat");
auxiliarSelect("llengues", "lang", "idioma_ca");
auxiliarSelect("tipus", "tipus", "nomTipus");
</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');