<?php
$idSerie = $params['id'];
?>

<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/series">Sèries tv </a></h6>
</div>

<div class="container-fluid form">
<h2>Afegir actor a sèrie tv</h2>

<div class="alert alert-success" id="creaOk" style="display:none" role="alert">
<h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT;?></strong></h4>
<h6><?php echo ADD_OK_MESSAGE;?></h6>
</div>

<div class="alert alert-danger" id="creaErr" style="display:none;" role="alert">
<h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT?></strong></h4>
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
              <button type="submit" class="btn btn-primary">Inserir</button>
              </div>
            </div>
          </div>
    </form>

</div>

<script>
evitarTancarFinestra();

// llançar ajax per guardar dades
document.getElementById("inserirActorSerie").addEventListener("submit", function(event) {
  formulariInserir(event, "inserirActorSerie", "/api/cinema/post/?actorSerie");
});

// (api, elementId, valorText) {
auxiliarSelect("/api/cinema/get/?", <?php echo $idSerie;?>, "series", "idSerie", "name");
auxiliarSelect("/api/cinema/get/?", "", "actors", "idActor", "nomComplet");
</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');