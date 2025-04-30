<?php
// Obtener la URL completa
$url2 = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url2);
$path = $parsedUrl['path'];
$segments = explode("/", trim($path, "/"));

if ($segments[2] === "modifica-llibre") {
  $modificaBtn = 1;
  $slug = $routeParams[0];
} else {
  $modificaBtn = 2;
}

if ($modificaBtn === 1) {
?>
  <script type="module">
    formUpdateLlibre("<?php echo $slug; ?>");
  </script>
<?php
} else {
?>
  <script type="module">
    // Llenar selects con opciones
    selectOmplirDades("/api/biblioteca/get/?type=autors", "", "autor", "nomComplet");
    selectOmplirDades("/api/biblioteca/get/?type=imatgesLlibres", "", "img", "alt");
    selectOmplirDades("/api/biblioteca/get/?type=editorials", "", "idEd", "editorial");
    selectOmplirDades("/api/biblioteca/get/?type=generes", "", "idGen", "genere_cat");
    selectOmplirDades("/api/biblioteca/get/?type=subgeneres", "", "subGen", "sub_genere_cat");
    selectOmplirDades("/api/biblioteca/get/?type=llengues", "", "lang", "idioma_ca");
    selectOmplirDades("/api/biblioteca/get/?type=tipus", "", "tipus", "nomTipus");
    selectOmplirDades("/api/biblioteca/get/?type=estatLlibre", "", "estat", "estat");
  </script>
<?php
}
?>

<div class="barraNavegacio">
  <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>">Biblioteca</a> > <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>/llistat-llibres">Llibres </a></h6>
</div>

<div class="container-fluid form">
  <?php
  if ($modificaBtn === 1) {
  ?>
    <h2>Modificar les dades del llibre</h2>
    <h4 id="bookUpdateTitle"></h4>
  <?php
  } else {
  ?>
    <h2>Creació d'un nou llibre</h2>
  <?php
  }
  ?>

  <div class="alert alert-success" id="missatgeOk" style="display:none" role="alert">
    <h4 class="alert-heading"><strong></strong></h4>
    <h6></h6>
  </div>

  <div class="alert alert-danger" id="missatgeErr" style="display:none" role="alert">
    <h4 class="alert-heading"><strong></strong></h4>
    <h6></h6>
  </div>

  <form method="POST" action="" id="modificaLlibre" class="row g-3">
    <?php $timestamp = date('Y-m-d'); ?>
    <?php
    if ($modificaBtn === 1) {
    ?>
      <input type="hidden" id="id" name="id" value="<?php echo $llibreId; ?>">
    <?php
    }
    ?>

    <div class="col-md-4">
      <label>Títol original:</label>
      <input class="form-control" type="text" name="titol" id="titol" value="">
    </div>

    <div class="col-md-4">
      <label>Títol en anglés:</label>
      <input class="form-control" type="text" name="titolEng" id="titolEng" value="">
    </div>

    <div class="col-md-4">
      <label>Slug:</label>
      <input class="form-control" type="text" name="slug" id="slug" value="">
    </div>

    <div class="col-md-4">
      <label>Autor:</label>
      <select class="form-select" name="autor" id="autor" value="">
      </select>
    </div>

    <div class="col-md-4">
      <label>Imatge coberta:</label>
      <select class="form-select" name="img" id="img" value="">
      </select>
    </div>

    <div class="col-md-4">
      <label>Any de publicació:</label>
      <input class="form-control" type="text" name="any" id="any" value="">
    </div>

    <div class="col-md-4">
      <label> Editorial:</label>
      <select class="form-select" name="idEd" id="idEd" value="">
      </select>
    </div>

    <div class="col-md-4">
      <label>Gènere:</label>
      <select class="form-select" name="idGen" id="idGen" value="">
      </select>
    </div>

    <div class="col-md-4">
      <label>Sub-gènere:</label>
      <select class="form-select" name="subGen" id="subGen" value="">
      </select>
    </div>

    <div class="col-md-4">
      <label>Idioma:</label>
      <select class="form-select" name="lang" id="lang" value="">
      </select>
    </div>

    <div class="col-md-4">
      <label>Tipus:</label>
      <select class="form-select" name="tipus" id="tipus" value="">
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
          <?php
          if ($modificaBtn === 1) {
          ?>
            <button type="submit" class="btn btn-primary">Modifica llibre</button>
          <?php
          } else {
          ?>
            <button type="submit" class="btn btn-primary">Crea nou llibre</button>
          <?php
          }
          ?>

        </div>
      </div>
    </div>
  </form>

</div>

<script>
  function formUpdateLlibre(id) {
    let urlAjax = "/api/biblioteca/get/?llibreSlug=" + id;

    fetch(urlAjax, {
        method: "GET",
      })
      .then(response => response.json())
      .then(data => {
        // Establecer valores en los campos del formulario
        const newContent = "Llibre: " + data.titol;
        const h2Element = document.getElementById('bookUpdateTitle');
        h2Element.innerHTML = newContent;

        document.getElementById('titol').value = data.titol;
        document.getElementById('titolEng').value = data.titolEng;
        document.getElementById('slug').value = data.slug;
        document.getElementById('any').value = data.any;
        document.getElementById("id").value = data.id;

        // Llenar selects con opciones
        selectOmplirDades("/api/biblioteca/get/?type=autors", data.idAutor, "autor", "nomComplet");
        selectOmplirDades("/api/biblioteca/get/?type=imatgesLlibres", data.img, "img", "alt");
        selectOmplirDades("/api/biblioteca/get/?type=editorials", data.idEd, "idEd", "editorial");
        selectOmplirDades("/api/biblioteca/get/?type=generes", data.idGen, "idGen", "genere_cat");
        selectOmplirDades("/api/biblioteca/get/?type=subgeneres", data.subGen, "subGen", "sub_genere_cat");
        selectOmplirDades("/api/biblioteca/get/?type=llengues", data.lang, "lang", "idioma_ca");
        selectOmplirDades("/api/biblioteca/get/?type=tipus", data.tipus, "tipus", "nomTipus");
        selectOmplirDades("/api/biblioteca/get/?type=estatLlibre", data.estat, "estat", "estat");

      })
      .catch(error => console.error("Error al obtener los datos:", error));
  }

  async function selectOmplirDades(url, selectedValue, selectId, textField) {
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error('Error en la sol·licitud AJAX');
      }

      const data = await response.json();
      const selectElement = document.getElementById(selectId);
      if (!selectElement) {
        console.error(`Select element with id ${selectId} not found`);
        return;
      }

      // Netejar les opcions actuals
      selectElement.innerHTML = '';

      // Afegir les noves opcions
      data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.text = item[textField];
        if (item.id === selectedValue) {
          option.selected = true;
        }
        selectElement.appendChild(option);
      });
    } catch (error) {
      console.error('Error:', error);
    }
  }
</script>