<?php

// Obtener la URL completa
$url = $_SERVER['REQUEST_URI'];

// Dividir la URL en partes usando '/' como delimitador
$urlParts = explode('/', $url);

// Obtener la parte deseada (en este caso, la cuarta parte)
$categoriaId = $urlParts[2] ?? '';

$modificaPagina = "";

if ($categoriaId === 'modifica-pelicula') {
  $modificaPagina = 1;
  $id = $routeParams['id'];
} else {
  $modificaPagina = 2;
  $id = "";
}
?>
<h6><a href="/cinema/">Cinema i sèries TV</a> > <a href="/cinema/pelicules">Pel·lícules </a></h6>
</div>

<div class="container-fluid form">
  <?php if ($modificaPagina === 2) {
    echo '<h2>Afegir nova pel·lícula</h2>';
  } else {
    echo '<h2>Modificar pel·lícula</h2>';
  }
  ?>


  <div class="alert alert-success" id="missatgeOk" style="display:none" role="alert">
    <h4 class="alert-heading"><strong><?php echo ADD_OK_MESSAGE_SHORT; ?></strong></h4>
    <h6><?php echo ADD_OK_MESSAGE; ?></h6>
  </div>

  <div class="alert alert-danger" id="missatgeErr" style="display:none;" role="alert">
    <h4 class="alert-heading"><strong><?php echo ERROR_TYPE_MESSAGE_SHORT ?></strong></h4>
    <h6><?php echo ERROR_TYPE_MESSAGE ?></h6>
  </div>

  <form method="POST" action="" id="peli" class="row g-3">
    <?php $timestamp = date('Y-m-d'); ?>
    <input type="hidden" id="dateCreated" name="dateCreated" value="<?php echo $timestamp; ?>">
    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

    <div class="col-md-4">
      <label>Títol original:</label>
      <input class="form-control" type="text" name="pelicula" id="pelicula" value="">
    </div>

    <div class="col-md-4">
      <label>Títol en espanyol:</label>
      <input class="form-control" type="text" name="pelicula_es" id="pelicula_es">
    </div>

    <div class="col-md-4">
      <label>Any d'estrena:</label>
      <input class="form-control" type="text" name="any" id="any">
    </div>

    <div class="col-md-4">
      <label>Data de visió:</label>
      <input class="form-control" type="date" name="dataVista" id="dataVista">
    </div>

    <div class="col-md-4">
      <label>Director:</label>
      <select class="form-select" name="director" id="director">
      </select>
    </div>

    <div class="col-md-4">
      <label>Imatge:</label>
      <select class="form-select" name="img" id="img">
      </select>
    </div>

    <div class="col-md-4">
      <label>Gènere:</label>
      <select class="form-select" name="genere" id="genere">
      </select>
    </div>

    <div class="col-md-4">
      <label> País:</label>
      <select class="form-select" name="pais" id="pais">
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
          <?php
          if ($modificaPagina === 1) {
            echo '<button type="submit" class="btn btn-primary">Modificar</button>';
          } else {
            echo '<button type="submit" class="btn btn-primary">Inserir</button>';
          }
          ?>
        </div>
      </div>
    </div>
  </form>

</div>


<?php
if ($modificaPagina === 1) {
?>

<?php

} else {
?>
  <script>
    // cridem funcions externes:
    document.addEventListener('DOMContentLoaded', () => {
      initializeTrixEditor("descripcio");

      // llançar ajax per guardar dades
      document.getElementById("peli").addEventListener("submit", function(event) {
        formulariInserir(event, "peli", "/api/cinema/post/?pelicula");
      });


    });
  </script>
<?php
}

?>