<?php
$id = $params['id'];
?>

<script type="module">
    peliculaPage('<?php echo $id; ?>')
</script>

<h1>Cinema i sèries TV</h1>
<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/pelicules">Pel·lícules </a></h6>

<h2 id="peliculaTitol"></h2>

<div class='row'>
      <div class='col-sm-8'>
         <img id="peliPhoto" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Cartell' title='Cartell'>
        </div>
        
        <div class="col-sm-4">
           <button type="button" id="updateFilm" onClick="updateFilm(<?php echo $id; ?>)" class="btn btn-sm btn-warning">Modifica les dades</button>
        
                <div class="alert alert-primary" role="alert" style="margin-top:10px">
                    <p id="titol"></p>
                    <p id="titolEsp"></p>
                    <p id="director"></p>
                    <p id="pais"></p>
                    <p id="any"></p>
                    <p id="genere"></p>
                    <p id="dataVista"></p>
                    <p id="authorUpdated"></p>
                    <p id="dateCreated"></p>
                    <p id="dateModified"></p>
                </div>
        </div>

    </div>
    <hr>
    <div class="container" style="width:60%;margin-top:25px;margin-bottom:25px">
        <h4>Crítica de la pel·lícula</h4>
        <p id="descripcio"></p>
        </div>

    <hr>

    <h4>Actors:</h4>

<div class="table-responsive">
            <table class="table table-striped" id="booksAuthor">
                <thead class="table-primary">
                <tr>
                    <th>Actor:</th>
                    <th>Personatge <?php echo TABLE_COLUMN_ROW;?></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

<script>

// author page info
function peliculaPage(id) {
  let urlAjax = "/api/cinema/get/?pelicula=" + id;
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function (xhr) {
      // Obtener el token del localStorage
      let token = localStorage.getItem('token');

      // Incluir el token en el encabezado de autorización
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },

    success: function (data) {
      try {
        const idPeli = data[0].id;
        
        let dateCreated2 = formatoFecha(data[0].dateCreated);
        let dateModified2 = formatoFecha(data[0].dateModified);
        let dataVista2 = formatoFecha(data[0].dataVista);

        // DOM modifications
        document.getElementById('peliculaTitol').innerHTML = "Pel·lícula: " + data[0].pelicula;
        document.getElementById("peliPhoto").src = `${window.location.origin}/public/00_inc/img/11_cinema_series/pelicules/${data[0].nameImg}.jpg`;
        document.getElementById('titol').innerHTML = "<strong>Títol original:</strong> " + data[0].pelicula;
        document.getElementById('titolEsp').innerHTML = "<strong>Títol a Espanya:</strong> " + data[0].pelicula_es;
        document.getElementById('pais').innerHTML = `<strong>País:</strong> <a href="${window.location.origin}/cinema/country/">${data[0].pais_cat}</a>`;
        document.getElementById('any').innerHTML = "<strong>Any d'estrena:</strong> " + data[0].any;
        document.getElementById('director').innerHTML = "<strong>Director/a:</strong> " + data[0].nom + " " + data[0].cognoms;
        document.getElementById('dataVista').innerHTML = "<strong>Pel·lícula vista el: </strong> " + dataVista2;
        document.getElementById('genere').innerHTML = "<strong>Gènere: </strong> " + data[0].genere_ca;
        document.getElementById('dateCreated').innerHTML = "<strong>Fitxa creada: </strong> " + dateCreated2;
        document.getElementById('dateModified').innerHTML = "<strong>Fitxa actualizada: </strong> " + dateModified2;
        document.getElementById('descripcio').innerHTML = data[0].descripcio;

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

// author book
function authorBookListLibrary(id) {
  let urlAjax = devDirectory + "/api/library/author/books/" + id;
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function (xhr) {
      // Obtener el token del localStorage
      let token = localStorage.getItem('token');

      // Incluir el token en el encabezado de autorización
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },

    success: function (data) {
      try {
        let html = '';
        for (let i = 0; i < data.length; i++) {
          html += '<tr>';
          html += '<td><a id="' + data[i].id + '" title="Book page" href="'+window.location.origin+'/biblioteca/llibre/' + data[i].slug + '">' + data[i].titol + '</a></td>';

          html += '<td>' + data[i].any + '</td>';

          html += '<td><a href="'+window.location.origin+'/biblioteca/modifica/llibre/' + data[i].id + '" class="btn btn-secondary btn-sm modificar-link">Modificar</a></td>';
          
          html += '<td><button type="button" onclick="btnDeleteBook(' + data[i].id + ')" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBook" data-id="' + data[i].id + '">Elimina</button></td>';
          html += '</tr>';
        }
        $('#booksAuthor tbody').html(html);
      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

// INPUT OPEN MODAL FORM - UPDATE AUTOR
function updateFilm(id) {
 // Cambia la URL a la que quieres redireccionar aquí
 window.location.href = "/cinema/modifica/pelicula/" + id;
}

</script>
<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');