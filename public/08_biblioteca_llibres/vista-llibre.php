<?php
$slug = $params['slug'];
?>

<h1>Biblioteca de llibres</h1>
<h3 id="titolBook"></h3>
<h6><a href="<?php echo APP_DEV;?>/biblioteca/">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/llibres/">Llibres </a></h6>

<div class='row'>
             <div class='col-sm-8'>
             <img id="llibrePhoto" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Llibre Photo' title='Llibre photo'>
            
       </div>
       <div class="col-sm-4">
       <button type="button" id="updateLlibre" onClick="btnUpdateLlibre(this.id)" class="btn btn-sm btn-warning">Actualitza llibre</button>

               <div class="alert alert-primary" role="alert" style="margin-top:10px">
                  <p id="titol"></p>
                  <p id="titolEng"></p>
                  <p id="nom"></p>
                  <p id="any"></p>
                  <p id="editorial"></p>
                  <p id="genere"></p>
                  <p id="sub_genere"></p>
                  <p id="idioma"></p>
                  <p id="tipus"></p>
                  <p id="dateCreated"></p>
                  <p id="dateModified"></p>
              </div>
           </div>
      </div>
      </div>

<hr>

     <h3>Book collection</h3>
     <p><button type='button' class='btn btn-dark btn-sm' id='btnAddCollection' onclick='addCollectionBook(".$id.")' data-bs-toggle='modal' data-bs-target='#modalCreateBookCollection'>Add new collection</button></p>";
<?php

/*
      $stmt = $conn->prepare("SELECT bc.nomCollection, bookc.ordre
      FROM db_library_books AS book
      INNER JOIN db_library_books_collection AS bookc ON book.id = bookc.idBook
      INNER JOIN db_library_collection AS bc ON bookc.idCollection = bc.id
      WHERE book.id = :id");
      $stmt->execute(['id' => $id]); 
      $data = $stmt->fetchAll();
      if (!empty($data)) {
        // and somewhere later:
        echo '<div class="'.TABLE_DIV_CLASS.'">
        <table class="'.TABLE_CLASS.'" id="booksAuthor">
        <thead class="'.TABLE_THREAD.'">';     
        echo "<tr>";
        echo "<th>Collection &darr;</th>";
        echo "<th>Book order</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($data as $row) {
          $nomCollection = $row['nomCollection'];
          $ordre = $row['ordre'];
          echo "<tr>";
          echo "<td>".$row['nomCollection']."</td>";
          echo "<td>".$row['ordre']."</td>";
          echo '<td>
          <button type="button" onclick="btnUpdateBook('.$id.')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'.$id.'">Update</button>
          <button type="button" onclick="btnUpdateBook('.$id.')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'.$id.'">Delete</button>
          </td>';
          echo "</tr>";
        }
      echo "</tbody>";                            
      echo "</table>";
      echo "</div>";
    } else {

    } */
?>
</div>

<script>

function bookInfo(slug) {
  let urlAjax = devDirectory + "/api/biblioteca/get/?llibre-slug=" + slug;
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

        let dateModified2 = formatoFecha(data.dateModified);
        let dateCreated2 = formatoFecha(data.dateCreated);

        const newContent = "Llibre: " + data.titol;
        const h2Element = document.getElementById('titolBook');
        h2Element.innerHTML = newContent;
        const idLlibre = data.id;

        document.getElementById("llibrePhoto").src = `${window.location.origin}/public/00_inc/img/08_biblioteca_llibres/llibres/${data.img}.jpg`;
        document.getElementById('titol').innerHTML = "<strong>Títol original: </strong>" + data.titol;
        document.getElementById('titolEng').innerHTML = "<strong>Títol anglès: </strong>" + data.titolEng;
        document.getElementById('nom').innerHTML = "<strong>Autor: </strong><a href='"+window.location.origin+"/biblioteca/autor/"+data.slugAutor+"'>" + data.nom + " " + data.cognoms + "</>";
        document.getElementById('any').innerHTML = "<strong>Any de publicació: </strong>" + data.any;
        document.getElementById('editorial').innerHTML = "<strong>Editorial: </strong>" + data.editorial;
        document.getElementById('genere').innerHTML = "<strong>Gènere: </strong>" + data.genere_cat;
        document.getElementById('sub_genere').innerHTML = "<strong>Sub-gènere: </strong>" + data.sub_genere_cat;
        document.getElementById('idioma').innerHTML = "<strong>Idioma original: </strong>" + data.idioma_ca;
        document.getElementById('tipus').innerHTML = "<strong>Tipus d'obra: </strong>" + data.nomTipus;
        document.getElementById('dateCreated').innerHTML = "<strong>Fitxa creada: </strong>" + dateCreated2
        document.getElementById('dateModified').innerHTML = "<strong>Fitxa actualizada: </strong>" + dateModified2;

        // Obtener el botón por su ID
        let botoActualizarLlibre = document.getElementById('updateLlibre');

        // Asignar el ID generado al botón
        botoActualizarLlibre.id = idLlibre;

      } catch (error) {
        console.error('Error al parsear JSON:', error);  // Muestra el error de parsing
      }
    }
  })
}

// INPUT OPEN MODAL FORM - UPDATE llibre
function btnUpdateLlibre(id) {
 // Cambia la URL a la que quieres redireccionar aquí
 window.location.href = "/biblioteca/modifica/llibre/" + id;
}

</script>
<script> bookInfo('<?php echo $slug; ?>') </script>
<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');