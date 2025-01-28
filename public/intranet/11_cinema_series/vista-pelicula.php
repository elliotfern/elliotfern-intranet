<div class="container">
  <h1>Cinema i sèries TV</h1>
  <h6><a href="/cinema/">Cinema i sèries TV</a> > <a href="/cinema/pelicules">Pel·lícules </a></h6>

  <div class='row'>
    <div class='col-sm-8'>
      <img id="nameImg" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Cartell' title='Cartell'>
    </div>

    <div class="col-sm-4">
      <p><a href="/cinema/modifica-pelicula/<?php echo $id; ?>" class="btn btn-warning btn-sm modificar-link">Modifica les dades</a>
      <p>

      <div class="alert alert-primary" role="alert" style="margin-top:10px">
        <p><strong>Títol original: </strong><span id="pelicula"></span></p>
        <p><strong>Títol a Espanya:</strong> <span id="pelicula_es"></span></p>
        <p><strong>Director/a: </strong><a id="directorUrl" href=""><span id="nom"></span> <span id="cognoms"></span></a></p>
        <p><strong>País:</strong> <a id="paisUrl" href=""><span id="pais_cat"></span></a></p>
        <p><strong>Idioma original: </strong><span id="idioma_ca"></span></p>
        <p><strong>Any d'estrena: </strong><span id="any"></span></p>
        <p><strong>Gènere: </strong><span id="genere_ca"></span></p>
        <p><strong>Pel·lícula vista el: </strong><span id="dataVista"></span></p>
        <p><strong>Fitxa creada: </strong><span id="dateCreated"></span></p>
        <p><strong>Fitxa actualizada: </strong> <span id="dateModified"></span></p>
      </div>
    </div>

  </div>
  <hr>
  <div class="container" style="padding:20px;background-color:#ececec;margin-top:25px;margin-bottom:25px">
    <h4>Crítica de la pel·lícula</h4>
    <span id="descripcio"></span>
  </div>

  <hr>

  <h4>Actors:</h4>
  <p><a href="/biblioteca/afegir/actor/pelicula/<?php echo $id; ?>" class="btn btn-warning btn-sm modificar-link">Afegir actor a la pel·lícula</a>
  <p>

  <div class="table-responsive">
    <table class="table table-striped" id="booksAuthor">
      <thead class="table-primary">
        <tr>
          <th></th>
          <th>Actor:</th>
          <th>Personatge</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</div>