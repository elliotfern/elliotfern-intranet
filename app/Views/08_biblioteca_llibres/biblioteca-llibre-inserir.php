<?php
if (isset($_POST['idAuthor'])) {
  $idAuthor_old = $_POST['idAuthor'];
} else {
  $idAuthor_old = NULL;
}

?>
<h6><a href="/biblioteca/">Biblioteca</a> > <a href="/biblioteca/llibres">Llibres </a></h6>
</div>

<div class="container-fluid form">
  <h2>Afegir nou llibre</h2>

  <div class="alert alert-success" id="creaOk" style="display:none" role="alert">
    <h4 class="alert-heading"><strong>ok</strong></h4>
    <h6>ok</h6>
  </div>

  <div class="alert alert-danger" id="creaErr" style="display:none;" role="alert">
    <h4 class="alert-heading"><strong>errrr</strong></h4>
    <h6>err</h6>
  </div>

  <form method="POST" action="" id="inserirLlibre" class="row g-3">
    <?php $timestamp = date('Y-m-d'); ?>
    <input type="hidden" id="dateCreated" name="dateCreated" value="<?php echo $timestamp; ?>">

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
      <input class="form-control soloNumeros" type="text" name="any" id="any">
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

    <div class="col-md-4">
      <label>Estat del llibre:</label>
      <select class="form-select" name="estat" id="estat">
      </select>
    </div>

    <div class="container" style="margin-top:25px">
      <div class="row">
        <div class="col-6 text-left">
          <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
        </div>
        <div class="col-6 text-right derecha">
          <button type="submit" class="btn btn-primary">Nou llibre</button>
        </div>
      </div>
    </div>
  </form>

</div>

<script>
  evitarTancarFinestra();

  // llançar ajax per guardar dades
  document.getElementById("inserirLlibre").addEventListener("submit", function(event) {
    formulariInserir(event, "inserirLlibre", "/api/biblioteca/post/?type=llibre");
  });

  // (api, elementId, valorText) {
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "autors", "autor", "nomComplet");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "imatgesLlibres", "img", "alt");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "editorials", "idEd", "editorial");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "generes", "idGen", "genere_cat");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "subgeneres", "subGen", "sub_genere_cat");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "llengues", "lang", "idioma_ca");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "tipus", "tipus", "nomTipus");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "estatLlibre", "estat", "estat");
</script>