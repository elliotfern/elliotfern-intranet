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
           <button type="button" id="updateFilm" onClick="updateFilm(<?php echo $id; ?>)" class="btn btn-sm btn-warning">Modifica les dades</button>
        
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
                </div>
        </div>

    </div>
    <hr>
    <div class="container" style="width:60%;margin-top:25px;margin-bottom:25px">
        <h4>Crítica de la sèrie</h4>
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
        
        //let dateCreated2 = formatoFecha(data[0].dateCreated);
        //let dateModified2 = formatoFecha(data[0].dateModified);
        //let dataVista2 = formatoFecha(data[0].dataVista);

        // DOM modifications
        document.getElementById('peliculaTitol').innerHTML = "Sèrie tv: " + data[0].name;
        document.getElementById("peliPhoto").src = `${window.location.origin}/public/00_inc/img/11_cinema_series/series/${data[0].nameImg}.jpg`;
        document.getElementById('authorName').innerHTML = "<strong>Títol original:</strong> " + data[0].name;
        document.getElementById('pais').innerHTML = `<strong>País:</strong> <a href="${window.location.origin}/cinema/country/">${data[0].pais_cat}</a>`;
        document.getElementById('anys').innerHTML = "<strong>Anys en antena (temporades):</strong> " + data[0].season;
        document.getElementById('productor').innerHTML = "<strong>Productor/a:</strong> " + data[0].nom + " " + data[0].cognoms;
        document.getElementById('numEpisodis').innerHTML = "<strong>Número d'episodis: </strong> " + data[0].chapter;
        document.getElementById('genere').innerHTML = "<strong>Gènere: </strong> " + data[0].genere_ca;
       // document.getElementById('dateCreated').innerHTML = "<strong>Fitxa creada: </strong> " + dateCreated2;
        //document.getElementById('dateModified').innerHTML = "<strong>Fitxa actualizada: </strong> " + dateModified2;
        document.getElementById('descripcio').innerHTML = data[0].descripcio;
        document.getElementById('lang').innerHTML = "<strong>Idioma original: </strong> " + data[0].idioma_ca;
        document.getElementById('anyInici').innerHTML = "<strong>Any d'inici: </strong> " + data[0].startYear;
        document.getElementById('anyFinal').innerHTML = "<strong>Any final: </strong> " + data[0].endYear;

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



       // CAST
       echo "<hr style='margin-top:15px'>";
       echo "<h3>Cast</h3>";
       echo "<p><a href='&idtvShow=".$id."' class='btn btn-info' role='button' aria-pressed='true'>Add actor to TV Show &rarr;</a></p>";
       
       global $conn;
        $stmt = $conn->prepare("SELECT a.actorLastName, a.actorFirstName, a.id AS idActor, sa.role, img.nameImg, sa.id AS idCast
        FROM db_tvmovies_tvshows AS s
        INNER JOIN db_tvmovies_tvshows_cast AS sa on s.id = sa.idtvShow
        INNER JOIN db_tvmovies_actors AS a ON a.id = sa.idActor
        LEFT JOIN db_img AS img ON a.img = img.id
        WHERE s.id = :id
        ORDER BY a.actorLastName ASC");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetchAll();
        if (!empty($data)) {
           echo "<div class='".TABLE_DIV_CLASS."'>";
           echo "<table class='".TABLE_CLASS."'>";
           echo "<thead class='".TABLE_THREAD."'>";
                   echo "<tr>";
                   echo "<th></th>";
                   echo "<th>Actor</th>";
                   echo "<th>Role</th>";
                   echo "<th>Actions</th>";
                   echo "</tr>";
                   echo "</thead>";
                   echo "<tbody>";
        foreach ($data as $row) {
          $typeName = "cinema-actor";
          $actorFirstName = $row['actorFirstName'];
          $actorLastName = $row['actorLastName'];
          $idActor = $row['idActor'];

          $actorFirstName2 = htmlspecialchars($actorFirstName, ENT_QUOTES);
          $actorFirstName22 = "\"".$actorFirstName2."\"";
          $actorLastName2 = htmlspecialchars($actorLastName, ENT_QUOTES);
          $actorLastName22 = "\"".$actorLastName2."\"";
                   echo "<tr>";
                   echo "<td>";
                   if ($row['nameImg'] == '0') { 
                     echo "<img src='".IMG_DEFAULT."' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Author' title='Author'>";
                   } else {
                     echo "<a href='#' data-bs-toggle='modal' data-bs-target='#modalViewActor' onclick='viewDetailActor(".$idActor.", ".$actorLastName22.", ".$actorFirstName22.");return false;'><img src='".IMG_URL.$typeName."/".$row['nameImg'].".jpg' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:100%;max-width:100px' alt='Actor' title='Actor'></a>";
                   }  
                   echo "</td>";
                   echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalViewActor' onclick='viewDetailActor(".$idActor.", ".$actorLastName22.", ".$actorFirstName22.");return false;'>".$actorFirstName." ".$actorLastName."</a></td>";
                   echo "<td>".$row['role']."</td>";
                   echo "<td>
                    <a href='&idCast=".$row['idCast']."' class='btn btn-warning btn-sm' role='button' aria-pressed='true'>Update</a>
                   <a href='&idCast=".$row['idCast']."' class='btn btn-danger btn-sm' role='button' aria-pressed='true'>Remove</a>
                   </td>";
                   echo "</tr>";
                   }
                   echo "</tbody>                           
                   </table>
                   </div>";

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');