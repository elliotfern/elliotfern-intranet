<?php
$id = $params['id'];
?>

<h1>Cinema i sèries TV</h1>
<h6><a href="<?php echo APP_WEB;?>/cinema/">Cinema i sèries TV</a> > <a href="<?php echo APP_WEB;?>/cinema/series">Sèries </a></h6>

<div class='row'>
      <div class='col-sm-8'>
         <img id="nameImg" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Cartell' title='Cartell'>
      </div>
        
        <div class="col-sm-4">
        <p><a href="<?php echo APP_WEB;?>/cinema/modifica/serie/<?php echo $id; ?>" class="btn btn-sm btn-warning">Modificar les dades</a></p>
          <div class="alert alert-primary" role="alert" style="margin-top:10px">
            <h4 class="alert-heading"></h4>
            <p><strong>Nom original de la sèrie: </strong><span id="name"></span></p>
            <p><strong>Director: </strong><a id="directorUrl" href=""><span id="nom"></span> <span id="cognoms"></span></a></p>
            <p><strong>Idioma original: </strong><span id="idioma_ca"></span></p>
            <p><strong>Gènere: </strong><span id="genere_ca"></span></p>
            <p><strong>País: </strong><a id="paisUrl" href=""><span id="pais_cat"></span></a></p>
            <p><strong>Productora tv/plataforma: </strong><a id="plataformaUrl" href=""><span id="productora"></span></a></p>
            <p><strong>Número de temporades: </strong><span id="season"></span></p>
            <p><strong>Número d'episodis: </strong><span id="chapter"></span></p>
            <p><strong>Anys d'emissió: </strong><span id="startYear"></span> / <span id="endYear"></span></p>
            <p><strong>Fitxa creada: </strong><span id="dateCreated"></span></p>
            <p><strong>Fitxa actualizada: </strong><span id="dateModified"></span></p>
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
connexioApiGetDades("/api/cinema/get/?serie=", <?php echo $id;?>, "11_cinema_series", "series", function(data) {
  
    // Actualiza el atributo href del enlace con el idDirector
    document.getElementById('directorUrl').href = `${window.location.origin}/cinema/director/${data.idDirector}`;
    document.getElementById('paisUrl').href = `${window.location.origin}/cinema/series/pais/${data.idPais}`;
    document.getElementById('plataformaUrl').href = `${window.location.origin}/series/productora/${data.idProductora}`;
});

// author book
function actorsDeLaSerie(id) {
  let urlAjax = "/api/cinema/get/?actors-serie=" + id;
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
actorsDeLaSerie(<?php echo $id;?>);
</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');