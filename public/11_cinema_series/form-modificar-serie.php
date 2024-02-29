<?php
$idSerie = $params['id'];
?>

<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/series">Sèries tv </a></h6>
</div>

<div class="container-fluid form">
<h2 id="titolSerie"></h2>

<div class="alert alert-success" id="updateOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></h4></strong>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>

<div class="alert alert-danger" id="updateErr" style="display:none;" role="alert">
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
              <button type="submit" class="btn btn-primary">Modificar dades</button>
              </div>
            </div>
          </div>
    </form>

</div>

<script>

// cridem funcions externes:
formNomesNumeros();
initializeTrixEditor("descripcio");
serieInfo('<?php echo $idSerie; ?>')
evitarTancarFinestra();

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
        auxiliarSelect("/api/cinema/get/auxiliars/?type=", data[0].idDirector, "directors", "director", "nomComplet");
        auxiliarSelect("/api/cinema/get/auxiliars/?type=", data[0].idImg, "imgSeries", "img", "alt");
        auxiliarSelect("/api/cinema/get/auxiliars/?type=", data[0].idGen, "generesPelis", "genre", "genere_ca");
        auxiliarSelect("/api/cinema/get/auxiliars/?type=", data[0].idLang, "llengues", "lang", "idioma_ca");
        auxiliarSelect("/api/cinema/get/auxiliars/?type=", data[0].idPais, "paisos", "country", "pais_cat");
        auxiliarSelect("/api/cinema/get/auxiliars/?type=", data[0].idProductora, "productores", "producer", "productora");

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

// llançar actualizador dades
document.getElementById("modificarSerie").addEventListener("submit", function(event) {
    formulariActualizar(event, "modificarSerie", "/api/cinema/put/?serie");
});
</script>


<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');