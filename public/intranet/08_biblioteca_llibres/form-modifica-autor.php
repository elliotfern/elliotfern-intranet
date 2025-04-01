<?php
// Obtener la URL completa
$url2 = $_SERVER['REQUEST_URI'];
$parsedUrl = parse_url($url2);
$path = $parsedUrl['path'];
$segments = explode("/", trim($path, "/"));

if ($segments[2] === "modifica-autor") {
  $modificaBtn = 1;
  $autorSlug = $routeParams[0];
} else {
  $modificaBtn = 2;
}

if ($modificaBtn === 1) {
?>
  <script type="module">
    formUpdateAuthor("<?php echo $autorSlug; ?>");
  </script>
<?php
} else {
?>
  <script type="module">
    // Llenar selects con opciones
    selectOmplirDades("/api/biblioteca/get/?type=auxiliarImatgesAutor", "", "img", "alt");
    selectOmplirDades("/api/biblioteca/get/?type=professio", "", "ocupacio", "professio_ca");
    selectOmplirDades("/api/biblioteca/get/?type=pais", "", "paisAutor", "pais_cat");
  </script>
<?php
}
?>

<h6><a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>">Biblioteca</a> > <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>/llistat-autors">Autors </a></h6>

<div class="container-fluid form">
  <?php
  if ($modificaBtn === 1) {
  ?>
    <h2>Modificar les dades de l'autor</h2>
    <h4 id="authorUpdateTitle"></h4>
  <?php
  } else {
  ?>
    <h2>Creació d'un nou autor/a</h2>
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

  <form method="POST" action="" class="row g-3" id="modificaAutor">
    <input type="hidden" name="id" id="id" value="">

    <div class="col-md-4">
      <label>Nom:</label>
      <input class="form-control" type="text" name="nom" id="nom" value="">
    </div>

    <div class="col-md-4">
      <label>Cognoms:</label>
      <input class="form-control" type="text" name="cognoms" id="cognoms" value="">
    </div>

    <div class="col-md-4">
      <label>Slug:</label>
      <input class="form-control" type="text" name="slug" id="slug" value="">
    </div>

    <div class="col-md-4">
      <label>Pàgina web:</label>
      <input class="form-control" type="url" name="web" id="web" value="">
    </div>

    <div class="col-md-4">
      <label>Any de naixement:</label>
      <input class="form-control" type="text" name="anyNaixement" id="anyNaixement" value="">
    </div>

    <div class="col-md-4">
      <label>Any de defunció:</label>
      <input class="form-control" type="text" name="anyDefuncio" id="anyDefuncio" value="">
    </div>

    <div class="col-md-4">
      <label>Professió</label>
      <select class="form-select" name="ocupacio" id="ocupacio">
      </select>
    </div>

    <div class="col-md-4">
      <label>País:</label>
      <select class="form-select" name="paisAutor" id="paisAutor">
      </select>
    </div>

    <div class="col-md-4">
      <label>Imatge:</label>
      <select class="form-select" name="img" id="img">
      </select>
    </div>

    <div class="col-complet">
      <label for="AutDescrip" class="form-label">Descripció:</label>
      <textarea class="form-control" id="descripcio" name="descripcio" rows="6"></textarea>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-6 text-left">
          <a href="#" onclick="window.history.back()" class="btn btn-secondary">Tornar enrere</a>
        </div>
        <div class="col-6 text-right derecha">
          <?php
          if ($modificaBtn === 1) {
          ?>
            <button type="submit" class="btn btn-primary">Actualitza autor</button>
          <?php
          } else {
          ?>
            <button type="submit" class="btn btn-primary">Crea nou autor/a</button>
          <?php
          }
          ?>

        </div>
      </div>
    </div>


  </form>

  <script>
    function formUpdateAuthor(id) {
      let urlAjax = "/api/biblioteca/get/?autorSlug=" + id;

      fetch(urlAjax, {
          method: "GET",
        })
        .then(response => response.json())
        .then(data => {
          // Establecer valores en los campos del formulario
          document.getElementById("nom").value = data.nom;
          document.getElementById("cognoms").value = data.cognoms;
          document.getElementById("slug").value = data.slug;
          document.getElementById("web").value = data.web;
          document.getElementById("anyNaixement").value = data.anyNaixement;
          document.getElementById("anyDefuncio").value = data.anyDefuncio;
          document.getElementById("descripcio").innerHTML = decodeURIComponent(data.descripcio);
          document.getElementById("id").value = data.id;

          const h2Element = document.getElementById("authorUpdateTitle");
          h2Element.innerHTML = `Autor: ${data.nom} ${data.cognoms}`;

          // Llenar selects con opciones
          selectOmplirDades("/api/biblioteca/get/?type=auxiliarImatgesAutor", data.idImg, "img", "alt");
          selectOmplirDades("/api/biblioteca/get/?type=professio", data.idOcupacio, "ocupacio", "professio_ca");
          selectOmplirDades("/api/biblioteca/get/?type=pais", data.idPais, "paisAutor", "pais_cat");
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