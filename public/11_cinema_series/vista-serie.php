<?php
$id = $params['id'];
?>

<script type="module">
    peliculaPage('<?php echo $id; ?>')
</script>

<h1>Cinema i sèries TV</h1>
<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/series">Sèries </a></h6>

<h2 id="peliculaTitol"></h2>

<div class='row'>
      <div class='col-sm-8'>
         <img id="peliPhoto" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Cartell' title='Cartell'>
        </div>
        
        <div class="col-sm-4">
        <p><a href="<?php echo APP_WEB;?>/cinema/modifica/serie/<?php echo $id; ?>" class="btn btn-sm btn-warning">Modificar les dades</a></p>
        
                <div class="alert alert-primary" role="alert" style="margin-top:10px">
                <h4 class="alert-heading" id="authorName"></h4>
                    <p id="director"></p>
                    <p id="productor"></p>
                    <p id="lang"></p>
                    <p id="genere"></p>
                    <p id="anys"></p>
                    <p id="numTemporades"></p>
                    <p id="numEpisodis"></p>
                    <p id="pais"></p>
                    <p id="anyInici"></p>
                    <p id="anyFinal"></p>
                    <p id="dateCreated"></p>
                    <p id="dateModified"></p>
                </div>
        </div>

    </div>
    <hr>
    <div class="container" style="padding:20px;background-color:#ececec;margin-top:25px;margin-bottom:25px">
        <h4>Crítica de la sèrie</h4>
        <p id="descripcio"></p>
        </div>

    <hr>

    <h4>Actors:</h4>

    <p><a href="<?php echo APP_WEB;?>/cinema/afegir/actor/serie/<?php echo $id; ?>" class="btn btn-sm btn-warning">Afegir actor a la pel·lícula</a></p>

<div class="table-responsive">
            <table class="table table-striped" id="actors">
                <thead class="table-primary">
                <tr>
                    <th></th>
                    <th>Actor: <?php echo TABLE_COLUMN_ROW;?></th>
                    <th>Personatge</th>
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
  let urlAjax = "/api/cinema/get/?serie=" + id;
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

        // DOM modifications
        document.getElementById('peliculaTitol').innerHTML = "Sèrie tv: " + data[0].name;
        document.getElementById("peliPhoto").src = `${window.location.origin}/public/00_inc/img/11_cinema_series/series/${data[0].nameImg}.jpg`;
        document.getElementById('authorName').innerHTML = "<strong>Títol original:</strong> " + data[0].name;
        document.getElementById('pais').innerHTML = `<strong>País:</strong> <a href="${window.location.origin}/cinema/country/">${data[0].pais_cat}</a>`;
        document.getElementById('anys').innerHTML = "<strong>Anys en antena (temporades):</strong> " + data[0].season;
        document.getElementById('productor').innerHTML = "<strong>Productor/a:</strong> " + data[0].nom + " " + data[0].cognoms;
        document.getElementById('numEpisodis').innerHTML = "<strong>Número d'episodis: </strong> " + data[0].chapter;
        document.getElementById('genere').innerHTML = "<strong>Gènere: </strong> " + data[0].genere_ca;
       document.getElementById('dateCreated').innerHTML = "<strong>Fitxa creada: </strong> " + dateCreated2;
        document.getElementById('dateModified').innerHTML = "<strong>Fitxa actualizada: </strong> " + dateModified2;
        document.getElementById('descripcio').innerHTML = data[0].descripcio;
        document.getElementById('lang').innerHTML = "<strong>Idioma original: </strong> " + data[0].idioma_ca;
        document.getElementById('anyInici').innerHTML = "<strong>Any d'inici: </strong> " + data[0].startYear;
        document.getElementById('anyFinal').innerHTML = "<strong>Any final: </strong> " + data[0].endYear;

        actorsDeLaSerie(data[0].id);
        

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

// author book
function actorsDeLaSerie(id) {
  let urlAjax = devDirectory + "/api/cinema/get/?actors-serie=" + id;
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
          //a.nom, a.cognoms, a.id AS idActor, sa.role, img.nameImg, sa.id AS idCast
          html += '<td><a id="actor-' + data[i].idActor + '" title="Actor" href="'+window.location.origin+'/cinema/actor/' + data[i].idActor + '"><img src="' + window.location.origin + '/public/00_inc/img/11_cinema_series/actors/' + data[i].nameImg + '.jpg" width="100" height="auto"></a></td>';

          html += '<td><a id="actor-' + data[i].idActor + '" title="Actor" href="'+window.location.origin+'/cinema/actor/' + data[i].idActor + '">' + data[i].nom + " " + data[i].cognoms +'</a></td>';

          html += '<td>' + data[i].role + '</td>';

          html += '<td><a href="'+window.location.origin+'/biblioteca/modifica/llibre/' + data[i].id + '" class="btn btn-secondary btn-sm modificar-link">Modificar</a></td>';
          
          html += '<td><button type="button" onclick="btnDeleteBook(' + data[i].id + ')" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBook" data-id="' + data[i].id + '">Elimina</button></td>';
          html += '</tr>';
        }
        $('#actors tbody').html(html);
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