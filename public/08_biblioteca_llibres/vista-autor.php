<?php
$slug = $params['slug'];
?>

<script type="module">
    authorPageInfoLibrary('<?php echo $slug; ?>')
</script>

<h1>Biblioteca de llibres</h1>
<h6><a href="<?php echo APP_DEV;?>/biblioteca/">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/autors">Autors/es </a></h6>

<h2 id="authorName"></h2>

<div class='row'>
      <div class='col-sm-8'>
         <img id="authorPhoto" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Author Photo' title='Author photo'>
        </div>
        
        <div class="col-sm-4">
           <button type="button" id="updateAutor" onClick="btnUpdateAuthor(this.id)" class="btn btn-sm btn-warning">Modifica les dades</button>
        
                <div class="alert alert-primary" role="alert" style="margin-top:10px">
                    <strong><p id="authorYearBirth"><?php echo LIBRARY_YEAR_BIRTH;?>: </p></strong>

                    <p id="authorDescrip"> </p>

                    <p><strong><?php echo COUNTRY;?>: </strong> <a id="linkAuthor" href='' title='Country'><span id="authorCountry"></span></a></p>
                      
                    <p><strong><?php echo LIBRARY_PROFESSION;?>: </strong><span id="authorprofession"></span></p>

                    <p><strong><?php echo LIBRARY_MOVEMENT; ?>: </strong><a id="linkMovement" href='' title='Movement'><span id="authorMovement"></span></a></p>

                    <p><strong><?php echo LIBRARY_WIKIPEDIA;?>: </strong><a id="authorWeb" href='' target='_blank' title='Wikipedia'>Web</a></p>

                    <p><strong><?php echo CREATED_DATE;?>: </strong><span id="authorCreated"></span></p>
                      
                    <p><strong><?php echo UPDATED_DATE;?>: </strong><span id="authorUpdated"></span></p>
                </div>
        </div>
    </div>

    <hr>

    <h4>Author works</h4>

<div class="table-responsive">
            <table class="table table-striped" id="booksAuthor">
                <thead class="table-primary">
                <tr>
                    <th>Work</th>
                    <th>Publication year <?php echo TABLE_COLUMN_ROW;?></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

<script>

// author page info
function authorPageInfoLibrary(slug) {
  let urlAjax = devDirectory + "/api/library/author/" + slug;
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
        const idAuthor = data.id;
        authorBookListLibrary(idAuthor)

        let dateCreated2 = formatoFecha(data.dateCreated);
        let dateModified2 = formatoFecha(data.dateModified);

        // DOM modifications
        document.getElementById('authorName').innerHTML = "Autor: " + data.AutNom + " " + data.AutCognom1;
        document.getElementById("authorPhoto").src = `../../public/00_inc/img/08_biblioteca_llibres/autors/${data.nameImg}.jpg`;
        document.getElementById('authorCountry').innerHTML = data.country;

        if (data.yearDie === null || data.yearDie === "NULL" || data.yearDie === 0) {
          document.getElementById('authorYearBirth').innerHTML = data.yearBorn;
        } else {
          document.getElementById('authorYearBirth').innerHTML = data.yearBorn + " - " + data.yearDie;
        }

        document.getElementById('linkAuthor').href = `../country/${data.idPais}`;
        document.getElementById('authorprofession').innerHTML = data.name;
        document.getElementById('authorMovement').innerHTML = data.movement;
        document.getElementById('linkMovement').href = `../movement/${data.idMovement}`;
        document.getElementById('authorWeb').href = `${data.AutWikipedia}`;
        document.getElementById('authorCreated').innerHTML = dateCreated2;
        document.getElementById('authorUpdated').innerHTML = dateModified2;
        document.getElementById('authorDescrip').innerHTML = data.AutDescrip;

        // Obtener el botón por su ID
        var botoActualizarAutor = document.getElementById('updateAutor');

        // Asignar el ID generado al botón
        botoActualizarAutor.id = idAuthor;

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

// author book
function authorBookListLibrary(idAuthor) {
  let urlAjax = devDirectory + "/api/library/author/books/" + idAuthor;
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
          html += '<td><a id="' + data[i].id + '" title="Book page" href="../llibre/' + data[i].slug + '">' + data[i].titol + '</a></td>';

          html += '<td>' + data[i].any + '</td>';

          html += '<td><button type="button" onclick="btnUpdateBook(' + data[i].id + ')" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="' + data[i].id + '">Actualitza</button></td>';

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
function btnUpdateAuthor(id) {
 // Cambia la URL a la que quieres redireccionar aquí
 window.location.href = "/biblioteca/modifica/autor/" + id;
}

</script>
<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');