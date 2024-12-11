<script type="module">
    authorsTableLibrary();
</script>

<h1>Library database</h1>
<h2>Authors</h2>

<p><button type='button' class='btn btn-outline-secondary' id='btnCreateLink' onclick='inserirLlibre()'>Afegir nou llibre &rarr;</button>

<button type='button' class='btn btn-outline-success' id='btnCreateLink' onclick='inserirAutor()'>Afegir nou autor &rarr;</button>
</p>
        
<hr>

    <div class="table-responsive">
            <table class="table table-striped" id="authorsTable">
                <thead class="table-primary">
                <tr>
                    <th></th>
                    <th>Author <?php echo TABLE_COLUMN_ROW;?></th>
                    <th>Country</th>
                    <th>Profession</th>
                    <th>Years</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

 <script>
 // AUTHOR object
// authors table
function authorsTableLibrary() {
  let urlAjax = devDirectory + "/api/library/authors/allAuthors";
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
          html += '<td class="text-center"><a id="' + data[i].id + '" title="Author page" href="./autor/' + data[i].slug + '"><img src="../../public/00_inc/img/08_biblioteca_llibres/autors/' + data[i].nameImg + '.jpg" style="height:70px"></a></td>';

          html += '<td><a id="' + data[i].id + '" title="Author page" href="./autor/' + data[i].slug + '">' + data[i].AutNom + " " + data[i].AutCognom1 + '</a></td>';

          html += '<td><a id="' + data[i].idCountry + '" title="Authors by country" href="./by-country/' + data[i].idCountry + '">' + data[i].country + '</a></td>';

          html += '<td><a id="' + data[i].idProfession + '" title="Authors by profession" href="./by-profession/' + data[i].idProfession + '">' + data[i].profession + '</a></td>';

          if (data[i].yearDie === 0) {
            html += '<td>' + data[i].yearBorn + '</td>';
          } else {
            html += '<td>' + data[i].yearBorn + " - " + data[i].yearDie + '</td>';
          }

          html += '<td><a href="./modifica/autor/' + data[i].id + '"><button type="button" class="btn btn-sm btn-warning">Update</button></a></td>';

          html += '<td><button type="button" class="btn btn-sm btn-danger">Delete</button></td>';
          html += '</tr>';
        }
        $('#authorsTable tbody').html(html);
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