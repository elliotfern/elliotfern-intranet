<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/series">Sèries tv </a></h6>
</div>

<div class="container-fluid form">
<h2>Afegir nova sèrie tv</h2>

<div class="alert alert-success" id="creaOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></h4></strong>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>

<div class="alert alert-danger" id="creaErr" style="display:none;" role="alert">
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
              <button type="submit" class="btn btn-primary">Inserir</button>
              </div>
            </div>
          </div>
    </form>

</div>

<script>
// cridem funcions externes:
initializeTrixEditor("descripcio");
evitarTancarFinestra();

// llançar ajax per guardar dades
document.getElementById("inserirSerie").addEventListener("submit", function(event) {
  formulariInserir(event, "inserirSerie", "/api/cinema/post/?serie");
});

// (api, elementId, valorText) {
auxiliarSelect("/api/cinema/get/auxiliars/?type=", "", "directors", "director", "nomComplet");
auxiliarSelect("/api/cinema/get/auxiliars/?type=", "", "imgSeries", "img", "alt");
auxiliarSelect("/api/cinema/get/auxiliars/?type=", "", "generesPelis", "genre", "genere_ca");
auxiliarSelect("/api/cinema/get/auxiliars/?type=", "", "llengues", "lang", "idioma_ca");
auxiliarSelect("/api/cinema/get/auxiliars/?type=", "", "paisos", "country", "pais_cat");
auxiliarSelect("/api/cinema/get/auxiliars/?type=", "", "productores", "producer", "productora");
</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');