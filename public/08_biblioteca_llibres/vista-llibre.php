<?php
$slug = $params['slug'];
?>

<h1>Biblioteca de llibres</h1>
<h3 id="titolBook"></h3>
<h6><a href="<?php echo APP_DEV;?>/biblioteca/">Biblioteca</a> > <a href="<?php echo APP_DEV;?>/biblioteca/llibres/">Llibres </a></h6>

<div class='row'>
             <div class='col-sm-8'>
             <img id="nameImg" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Llibre Photo' title='Llibre photo'>
            
       </div>
       <div class="col-sm-4">
       <p><a id="modificaLlibreUrl" href="" class="btn btn-warning btn-sm">Modifica les dades</a><p>

               <div class="alert alert-primary" role="alert" style="margin-top:10px">
                  <p><h3> <span id="titol"></span></h3></p>
                  <p><strong>Títol anglès: </strong> <span id="titolEng"></span></p>
                  <p><strong>Autor: </strong> <a id="linkAutor" href=""> <span id="nom"></span>  <span id="cognoms"></span></a></p>
                  <p><strong>Any de publicació: </strong> <span id="any"></span></p>
                  <p><strong>Editorial: </strong> <span id="editorial"></span></p>
                  <p><strong>Gènere: </strong> <span id="genere_cat"></span></p>
                  <p><strong>Sub-gènere: </strong> <span id="sub_genere_cat"></span></p>
                  <p><strong>Idioma original: </strong> <span id="idioma_ca"></span></p>
                  <p><strong>Tipus d'obra: </strong> <span id="nomTipus"></span></p>
                  <p><strong>Fitxa creada: </strong> <span id="dateCreated"></span></p>
                  <p><strong>Fitxa actualizada: </strong> <span id="dateModified"></span></p>
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
connexioApiGetDades("/api/biblioteca/get/?llibre-slug=", "<?php echo $slug;?>", "08_biblioteca_llibres", "llibres", function(data) {
  
  // Actualiza el atributo href del enlace con el idDirector
 //document.getElementById('wikipediaLink').href = `${data.AutWikipedia}`;
 //document.getElementById('movimentLink').href = `${window.location.origin}/biblioteca/autors/moviment/${data.idMovement}`;
 //document.getElementById('ocupacioLink').href = `${window.location.origin}/biblioteca/autors/professio/${data.AutOcupacio}`;
 document.getElementById('linkAutor').href = `${window.location.origin}/biblioteca/autor/${data.slugAutor}`;
 //authorBookListLibrary(data.id)
 document.getElementById('modificaLlibreUrl').href = `${window.location.origin}/biblioteca/modifica/llibre/${data.id}`;
});

</script>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');