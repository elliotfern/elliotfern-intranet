<?php
// Obtener la URL completa
$url2 = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url2);
$path = $parsedUrl['path'];
$segments = explode("/", trim($path, "/"));

if ($segments[2] === "modifica-pelicula") {
  $modificaBtn = 1;
  $slug = $routeParams[0];
} else {
  $modificaBtn = 2;
}

if ($modificaBtn === 1) {
?>
  <script type="module">
    formUpdate("<?php echo $slug; ?>");
  </script>
<?php
} else {
?>
  <script type="module">
    auxiliarSelect("/api/cinema/get/?directors", "", "director", "nomComplet");
    auxiliarSelect("/api/auxiliars/get/?type=imgPelis", "", "img", "alt");
    auxiliarSelect("/api/auxiliars/get/?type=generesPelis", "", "genere", "genere_ca");
    auxiliarSelect("/api/auxiliars/get/?type=llengues", "", "lang", "idioma_ca");
    auxiliarSelect("/api/auxiliars/get/?type=paisos", "", "pais", "pais_cat");
  </script>
<?php
}
?>

<div class="barraNavegacio">
  <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['cinema']; ?>">Arts escèniques, cinema i televisió</a> > <a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-pelicules">Llistat pel·lícules</a> </h6>
</div>

<div class="container-fluid form">
  <?php
  if ($modificaBtn === 1) {
  ?>
    <h2>Modificar pel·lícula</h2>
    <h4 id="titolPelicula"></h4>>
  <?php
  } else {
  ?>
    <h2>Creació d'una nova pel·lícula</h2>
  <?php
  }
  ?>

  <div class="alert alert-success" id="missatgeOk" style="display:none">
  </div>

  <div class="alert alert-danger" id="missatgeErr" style="display:none;">
  </div>

  <form method="POST" action="" id="modificarPeli" class="row g-3">
    <?php
    if ($modificaBtn === 1) {
    ?>
      <input type="hidden" name="id" id="id" value="">
    <?php
    }
    ?>

    <div class="col-md-4">
      <label>Títol original:</label>
      <input class="form-control" type="text" name="pelicula" id="pelicula" value="">
    </div>

    <div class="col-md-4">
      <label>Títol en espanyol:</label>
      <input class="form-control" type="text" name="pelicula_es" id="pelicula_es" value="">
    </div>

    <div class="col-md-4">
      <label>Slug url:</label>
      <input class="form-control" type="text" name="slug" id="slug" value="">
    </div>

    <div class="col-md-4">
      <label>Any d'estrena:</label>
      <input class="form-control" type="text" name="any" id="any" value="">
    </div>

    <div class="col-md-4">
      <label>Data de visió:</label>
      <input class="form-control" type="date" name="dataVista" id="dataVista" value="">
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

    <div class="col-md-4">
    </div>

    <div class="col-md-4">
    </div>

    <div class="col-md-12">
      <label>Crítica de la pel·lícula:</label>
      <textarea id="descripcio" name="descripcio" rows="4" cols="50" value=""> </textarea>

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
            <button type="submit" class="btn btn-primary">Modifica les dades</button>
          <?php
          } else {
          ?>
            <button type="submit" class="btn btn-primary">Crea nova pel·lícula</button>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </form>

</div>

<script>
  function formUpdate(id) {
    let urlAjax = "/api/cinema/get/?pelicula=" + id;

    fetch(urlAjax, {
        method: "GET",
      })
      .then(response => response.json())
      .then(data => {
        // Establecer valores en los campos del formulario
        const newContent = "Pel·lícula: " + data[0].pelicula;
        const h2Element = document.getElementById('titolPelicula');
        h2Element.innerHTML = newContent;

        document.getElementById('pelicula').value = data[0].pelicula;
        document.getElementById('pelicula_es').value = data[0].pelicula_es;
        document.getElementById('slug').value = data[0].slug;
        document.getElementById('any').value = data[0].any;
        document.getElementById('slug').value = data[0].slug;
        document.getElementById("id").value = data[0].id;
        document.getElementById("descripcio").value = data[0].descripcio;
        document.getElementById("dataVista").value = data[0].dataVista;

        // Llenar selects con opciones
        auxiliarSelect("/api/cinema/get/?directors", data[0].idDirector, "director", "nomComplet");
        auxiliarSelect("/api/auxiliars/get/?type=imgPelis", data[0].idImg, "img", "alt");
        auxiliarSelect("/api/auxiliars/get/?type=generesPelis", data[0].idGen, "genere", "genere_ca");
        auxiliarSelect("/api/auxiliars/get/?type=llengues", data[0].lang, "lang", "idioma_ca");
        auxiliarSelect("/api/auxiliars/get/?type=paisos", data[0].idPais, "pais", "pais_cat");

      })
      .catch(error => console.error("Error al obtener los datos:", error));
  }

  async function auxiliarSelect(url, selectedValue, selectId, textField) {
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

<style>
  /* Establecer un contenedor flex para la fila */
  .form .row {
    display: flex;
    flex-wrap: wrap;
    /* Permite que los elementos se muevan a la siguiente fila cuando no haya espacio */
    gap: 15px;
    /* Añade un espacio entre las columnas */
  }

  /* Hacer que cada columna ocupe el 50% del ancho */
  .form .col-md-4 {
    flex: 0 0 30%;
    /* 48% de ancho para que haya espacio entre las columnas */
    box-sizing: border-box;
    /* Asegura que el padding no afecte el tamaño total */
  }

  .form .col-complet {
    flex: 0 0 100%;
    /* 48% de ancho para que haya espacio entre las columnas */
    box-sizing: border-box;
    /* Asegura que el padding no afecte el tamaño total */
  }

  /* Asegurarse de que las columnas se ajusten bien en pantallas pequeñas */
  @media (max-width: 768px) {
    .form .col-md-4 {
      flex: 0 0 100%;
      /* En pantallas más pequeñas, cada columna ocupa el 100% del ancho */
    }
  }

  /* Asegúrate de que el contenedor tenga un display flex para la fila */
  .container .row {
    display: flex;
    justify-content: space-between;
    /* Distribuye los botones con espacio entre ellos */
    padding: 10px 0;
  }

  .form {
    margin-bottom: 100px;
  }

  .container {
    padding-bottom: 10px !important;
  }

  /* Estilos opcionales para los botones */
  .btn {
    padding: 10px 20px;
    /* Espaciado interno para los botones */
    font-size: 16px;
    /* Tamaño de la fuente */
    text-align: center;
    /* Asegura que el texto esté centrado */
    cursor: pointer;
    /* Cambia el cursor cuando pasa sobre el botón */
  }

  .btn-secondary {
    background-color: #6c757d;
    /* Color de fondo para el botón secundario */
    border: none;
    /* Eliminar borde */
    color: white;
    /* Color del texto */
  }

  .btn-primary {
    background-color: #007bff;
    /* Color de fondo para el botón primario */
    border: none;
    /* Eliminar borde */
    color: white;
    /* Color del texto */
  }

  /* Ajuste para móviles (si lo deseas) */
  @media (max-width: 768px) {
    .container .row {
      flex-direction: column;
      /* Hace que los botones se apilen verticalmente en pantallas pequeñas */
      align-items: center;
      /* Centra los botones */
    }

    .container .row .col-6 {
      width: 100%;
      /* Hace que las columnas ocupen el 100% del ancho en pantallas pequeñas */
      text-align: center;
      /* Centra el texto en pantallas pequeñas */
    }
  }
</style>