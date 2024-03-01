<?php
$id = $params['id'];
?>

<h1>Cinema i sèries TV</h1>
<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/pelicules">Pel·lícules </a></h6>

<div class='row'>
      <div class='col-sm-8'>
         <img id="nameImg" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Cartell' title='Cartell'>
        </div>
        
        <div class="col-sm-4">
        <p><a href="<?php echo APP_WEB;?>/cinema/modifica/pelicula/<?php echo $id;?>" class="btn btn-warning btn-sm modificar-link">Modifica les dades</a><p>
    
                <div class="alert alert-primary" role="alert" style="margin-top:10px">
                    <p><strong>Títol original: </strong><span id="pelicula"></span></p>
                    <p><strong>Títol a Espanya:</strong> <span id="pelicula_es"></span></p>
                    <p><strong>Director/a: </strong><a id="directorUrl" href=""><span id="nom"></span> <span id="cognoms"></span></a></p>
                    <p><strong>País:</strong> <a id="paisUrl" href=""><span id="pais_cat"></span></a></p>
                    <p><strong>Idioma original: </strong><span id="idioma_cat"></span></p>
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
        <p id="descripcio"></p>
        </div>

    <hr>

    <h4>Actors:</h4>
    <p><a href="<?php echo APP_WEB;?>/biblioteca/afegir/actor/pelicula/<?php echo $id;?>" class="btn btn-warning btn-sm modificar-link">Afegir actor a la pel·lícula</a><p>

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
connexioApiGetDades("/api/cinema/get/?pelicula=", <?php echo $id;?>, "11_cinema_series", "pelicules", function(data) {
  
  // Actualiza el atributo href del enlace con el idDirector
  document.getElementById('directorUrl').href = `${window.location.origin}/cinema/director/${data[0].director}`;
  document.getElementById('paisUrl').href = `${window.location.origin}/cinema/pelicules/pais/${data[0].pais}`;
});

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

</script>
<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');