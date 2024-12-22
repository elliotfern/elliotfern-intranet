<h6><a href="/biblioteca/">Biblioteca</a> > <a href="/biblioteca/autors">Autors/es </a></h6>
</div>

<div class="container-fluid form">
  <h2>Afegir nou autor</h2>

  <div class="alert alert-success" id="creaOk" style="display:none" role="alert">
    <h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT; ?></strong></h4>
    <h6><?php echo ADD_OK_MESSAGE; ?></h6>
  </div>

  <div class="alert alert-danger" id="creaErr" style="display:none" role="alert">
    <h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT; ?></strong></h4>
    <h6><?php echo ERROR_TYPE_MESSAGE; ?></h6>
  </div>

  <form method="POST" action="" class="row g-3" id="inserirAutor">

    <div class="col-md-4">
      <label>Nom</label>
      <input class="form-control" type="text" name="AutNom" id="AutNom" value="">
    </div>

    <div class="col-md-4">
      <label>Cognoms</label>
      <input class="form-control" type="text" name="AutCognom1" id="AutCognom1" value="">
    </div>

    <div class="col-md-4">
      <label>Slug</label>
      <input class="form-control" type="text" name="slug" id="slug" value="">
    </div>

    <div class="col-md-4">
      <label>Pàgina web</label>
      <input class="form-control" type="url" name="AutWikipedia" id="AutWikipedia" value="">
    </div>

    <div class="col-md-4">
      <label>Any de naixement</label>
      <input class="form-control" type="text" name="yearBorn" id="yearBorn" value="">
    </div>

    <div class="col-md-4">
      <label>Any de defunció</label>
      <input class="form-control" type="text" name="yearDie" id="yearDie" value="">
    </div>

    <div class="col-mb-3">
      <label for="AutDescrip" class="form-label">Descripció</label>
      <textarea class="form-control" id="AutDescrip" name="AutDescrip" rows="3"></textarea>
    </div>

    <div class="col-md-4">
      <label>Professió</label>
      <select class="form-select" name="AutOcupacio" id="AutOcupacio">
      </select>
    </div>

    <div class="col-md-4">
      <label>Moviment</label>
      <select class="form-select" name="AutMoviment" id="AutMoviment">
      </select>
    </div>

    <div class="col-md-4">
      <label>País de residència</label>
      <select class="form-select" name="paisAutor" id="paisAutor">
      </select>
    </div>

    <div class="col-md-4">
      <label>Imatge</label>
      <select class="form-select" name="img" id="img">
      </select>
    </div>

    <hr />

    <div class="container">
      <div class="row">
        <div class="col-6 text-left">
          <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
        </div>
        <div class="col-6 text-right derecha">
          <button type="submit" class="btn btn-primary">Crear autor</button>
        </div>
      </div>
    </div>


  </form>
</div>

<script>
  evitarTancarFinestra();

  // llançar ajax per guardar dades
  document.getElementById("inserirAutor").addEventListener("submit", function(event) {
    formulariInserir(event, "inserirAutor", "/api/biblioteca/post/?autor");
  });

  // (api, elementId, valorText) {
  // Ahora llenar el select con las opciones y seleccionar la opción adecuada
  //function auxiliarSelect(idAux, api, elementId, valorText) {
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "auxiliarImatgesAutor", "img", "alt");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "professio", "AutOcupacio", "professio_ca");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "moviment", "AutMoviment", "moviment_ca");
  auxiliarSelect("/api/biblioteca/get/autors/?type=", "", "pais", "paisAutor", "pais_cat");
</script>