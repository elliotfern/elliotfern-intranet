<?php
$slug = $routeParams['autorSlug'];
?>

<h1>Biblioteca de llibres</h1>
<h6><a href="/biblioteca/">Biblioteca</a> > <a href="/biblioteca/autors">Autors/es </a></h6>

<div class='row'>
  <div class='col-sm-8'>
    <img id="nameImg" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Author Photo' title='Author photo'>
  </div>

  <div class="col-sm-4">
    <p><a id="modificaAutorUrl" href="" class="btn btn-warning btn-sm">Modifica les dades</a>
    <p>

    <div class="alert alert-primary" role="alert" style="margin-top:10px">
      <p>
      <h4><strong>Autor/a: </strong> <span id="AutNom"></span> <span id="AutCognom1"></span></h4>
      </p>
      <strong>
        <p>Anys:
      </strong><span id="yearBorn"> </span> - <span id="yearDie"></span></p>

      <p id="AutDescrip"> </p>

      <p><strong>Pais: </strong> <a id="linkAutor" href='' title='Country'><span id="country"></span></a></p>

      <p><strong>Professió: </strong><a id="ocupacioLink" href='' title='Movement'><span id="name"></span></a></p>

      <p><strong>Moviment: </strong><a id="movimentLink" href='' title='Movement'><span id="movement"></span></a></p>

      <p><strong>Viquipedia: </strong><a id="wikipediaLink" href='' target='_blank' title='Wikipedia'>Web</a></p>

      <p><strong>Data de creació: </strong><span id="dateCreated"></span></p>

      <p><strong>Data de modificació: </strong><span id="dateModified"></span></p>
    </div>
  </div>
</div>

<hr>
<h4>Treballs publicats:</h4>

<div class="table-responsive">
  <table id="tabla" class="table table-striped"></table>
  </table>
</div>

</div>

<script>
  connexioApiGetDades("/api/biblioteca/get/autors/?type=autor&slugAuthor=", "<?php echo $slug; ?>", "08_biblioteca_llibres", "autors", function(data) {

    // Actualiza el atributo href del enlace con el idDirector
    document.getElementById('wikipediaLink').href = `${data.AutWikipedia}`;
    document.getElementById('movimentLink').href = `${window.location.origin}/biblioteca/autors/moviment/${data.idMovement}`;
    document.getElementById('ocupacioLink').href = `${window.location.origin}/biblioteca/autors/professio/${data.AutOcupacio}`;
    document.getElementById('linkAutor').href = `${window.location.origin}/biblioteca/autors/pais/${data.idPais}`;
    document.getElementById('modificaAutorUrl').href = `${window.location.origin}/biblioteca/autor/modifica/${data.id}`;
    document.getElementById('nameImg').src = `https://media.elliotfern.com/img/library-author/${data.nameImg}.jpg`;

    construirTablaFromAPI("/api/biblioteca/get/autors/?type=autorLlibres&id=", data.id, ['Titol', 'Any', 'Accions'], function(fila, columna) {
      if (columna.toLowerCase() === 'titol') {
        // Manejar el caso del título
        return '<a href="' + window.location.origin + '/biblioteca/llibre/fitxa/' + fila['slug'] + '">' + fila['titol'] + '</a>';
      } else if (columna.toLowerCase() === 'accions') {
        return '<a href="' + window.location.origin + '/biblioteca/modifica/llibre/' + fila['id'] + '" class="btn btn-secondary btn-sm modificar-link">Modificar</a>';
      } else {
        // Manejar otros casos
        return fila[columna.toLowerCase()];
      }
    });
  });
</script>