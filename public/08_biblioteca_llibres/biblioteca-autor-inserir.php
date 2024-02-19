
<h6><a href="<?php echo APP_DEV;?>/biblioteca/">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/autors">Autors/es </a></h6>
</div>

  <div class="container-fluid form">
    <h2>Afegir nou autor</h2>

  <div class="alert alert-success" id="createAuthorMessageOk" style="display:none" role="alert">
  <h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT; ?></h4></strong>
  <h6><?php echo ADD_OK_MESSAGE;?></h6>
  </div>
      
  <div class="alert alert-danger" id="createAuthorMessageErr" style="display:none" role="alert">
  <h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT; ?></h4></strong>
  <h6><?php echo ERROR_TYPE_MESSAGE; ?></h6>
  </div>

    <form method="POST" action="" class="row g-3">

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
    <input class="form-control" type="url" name="yearBorn" id="yearBorn" value="">
    </div>

    <div class="col-md-4">
    <label>Any de defunció</label>
    <input class="form-control" type="url" name="yearDie" id="yearDie" value="">
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

    <hr/>

    <div class="container">
    <div class="row">
      <div class="col-6 text-left">
      <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
      </div>
      <div class="col-6 text-right derecha">
      <button type="submit" onclick="createNewAuthor(event)" class="btn btn-primary">Crear autor</button>
      </div>
    </div>
  </div>

 
</form>
</div>

<script>
    formProfessionAuthor();
    formMovimentAuthor();
    formCountry();
    formImageAuthor();
</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');