<?php
# conectare la base de datos
include_once('../../inc/connection.php');

if (isset($_POST['idBook'])) {
    $id = $_POST['idBook'];
} else {
    $id = $_POST['idBook'];
}

$stmt = $conn->prepare("SELECT book.titol, book.titolEng, book.any, book.img, book.idEd, book.idGen, book.lang, book.nomAutor, book.tipus, book.id
FROM db_library_books AS book
WHERE book.id = :id");
$stmt->execute(['id' => $id]); 
$data = $stmt->fetchAll();
// and somewhere later:
foreach ($data as $row) {
    $titolPost = $row['titol']; 
    $titolEngPost = $row['titolEng'];
    $anyPost = $row['any'];
    $imgPost = $row['img'];
    $idEdPost = $row['idEd'];
    $idGenPost = $row['idGen'];
    $idIdiomaPost = $row['lang'];
    $nomAutorPost = $row['nomAutor'];
    $tipusPost = $row['tipus'];
}
    // some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success show_conversation" style="display:none; role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';

              echo '<div class="alert alert-danger show_conversation2" style="display:none; role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>';
              
              echo '<form method="POST" action="" id="modalFormBook" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

              echo '<input type="hidden" id="idBook" name="idBook" value="'.$id.'">';

        echo '<h4>Book title</h4>';
          echo ' <div class="row">
            <div class="col-md-6">';
              echo '<label>Book (Original title): </label>';
              echo '<input class="form-control" type="text" name="titol" id="titol" value="'.$titolPost.'">';
              echo '<label style="color:#dc3545;display:none" id="titolErr">* Invalid data</label>';
              echo '</div>';

              echo '<div class="col-md-6 separador">';
              echo '<label>Book (English title): </label>';
              echo '<input class="form-control" type="text" name="titolEng" id="titolEng" value="'.$titolEngPost.'">';
              echo '<label style="color:#dc3545;display:none" id="titolEngErr">* Invalid data</label>';
              echo "</div>";
        echo "</div>";

        echo '<hr>';
        echo "<h4>Author</h4>";
        echo ' <div class="row">';
        echo '<div class="col-md-12">';
              echo '<select name="nomAutor" id="nomAutor">';
              echo '<option disabled>Select an option:</option>';
              $stmt = $conn->prepare("SELECT id, AutNom, AutCognom1 
                FROM db_library_authors
                ORDER BY AutCognom1 ASC;");
                $stmt->execute(); 
                $data = $stmt->fetchAll();
                foreach($data as $row){
                  $idAutor = $row['id'];
                  $AutNom = $row['AutNom']; 
                  $AutCognom1 = $row['AutCognom1'];
                  if ($nomAutorPost == $idAutor) {
                    echo "<option value=".$nomAutorPost." selected>".$AutCognom1.", ".$AutNom."</option>"; 
                  } else {
                    echo "<option value=".$idAutor.">".$AutCognom1.", ".$AutNom."</option>"; 
                  }
                }
              echo '</select>';
              echo '<label style="color:#dc3545;display:none" id="nomAutorErr">* Author name is missing</label>';
              echo "</div>";
              echo "<span style='margin-top:15px'> <a href='#' title='Add another author' onclick='divAnotherAuthor(".$id.");return false;'>Need to add another author to this book?</a></span>";
              echo '<div id="addAnotherAuthor"></div>';
              echo "</div>";


              echo '<hr>';
              echo '<h4>Image cover</h4>';
              echo ' <div class="row">';
              echo '<div class="col-md-12">';
              echo '<select name="img" id="img">';
              echo '<option value="">Select an option:</option>';
              $stmt = $conn->prepare("SELECT i.id, i.alt
              FROM db_img AS i
              WHERE i.typeImg = 2
              ORDER BY i.alt");
              $stmt->execute(); 
              $data = $stmt->fetchAll();
                foreach ($data as $row) {
                  $idImg = $row['id'];
                  $name = $row['alt'];
                  if ($imgPost == $idImg) {
                    echo "<option value=".$imgPost." selected>".$name."</option>"; 
                  } else {
                    echo "<option value=".$idImg.">".$name."</option>"; 
                  }
                }    
              echo '</select>';
              echo "</div>";
              echo "<span style='margin-top:15px'> <a href='#' title='upload image' onclick='divUploadImg(2);return false;'>Need to upload a new image?</a></span>";
              echo '<div id="uploadImg"></div>';

              echo "</div>";

              echo '<hr>';
              echo '<h4>Other information</h4>';

              echo ' <div class="row">';
                echo '<div class="col-md-6 separador">';
              echo '<label>Year:</label>';
              echo '<input class="form-control" type="text" name="any" id="any" value="'.$anyPost.'">';
              echo '<label style="color:#dc3545;display:none" id="anyErr">* Year is missing</label>';
              echo "</div>";

              echo '<div class="col-md-6 separador">';
              echo '<label>Publisher:</label>';
              echo '<select name="idEd" id="idEd">';
              echo '<option selected disabled>Select an option</option>';
              $stmt = $conn->prepare("SELECT nomEditorial, idEditorial 
              FROM db_library_publishers
              ORDER BY nomEditorial ASC;");
              $stmt->execute(); 
              $data = $stmt->fetchAll();
                foreach ($data as $row) {
                  $nomEditorial = $row['nomEditorial'];
                  $idEditorial = $row['idEditorial'];
                  if ($idEdPost == $idEditorial) {
                    echo "<option value=".$idEdPost." selected>".$nomEditorial."</option>"; 
                  } else {
                    echo "<option value=".$idEditorial.">".$nomEditorial."</option>"; 
                  }
                }
              echo '</select>';
              echo '<label style="color:#dc3545;display:none" id="idEdErr">* Publisher is missing</label>';
              echo "<span style='margin-top:25px'> <a href='#' title='create new publisher' onclick='divCreatePublisher();return false;'>Need to create new Publisher?</a></span>";
          
              echo "</div>";
              echo '<div id="createPublisher"></div>';
              echo "</div>";

              echo '<div class="row">';
              echo '<div class="col-md-6 separador">';
              echo '<label>Genre:</label>';
              echo '<select class="form-select" name="idGen" id="idGen">';
              echo '<option selected disabled>Select an option:</option>';
              $stmt = $conn->prepare("SELECT id, genre
              FROM db_library_genres
              ORDER BY genre ASC;");
              $stmt->execute(); 
              $data = $stmt->fetchAll();
                foreach($data as $row){
                  $nomGen = $row['genre'];
                  $idGenere = $row['id'];
                  if ($idGenPost == $idGenere){
                    echo "<option value=".$idGenPost." selected>".$nomGen."</option>"; 
                  } else {
                    echo "<option value=".$idGenere.">".$nomGen."</option>"; 
                  }
                }
              echo '</select>';
              echo '<label style="color:#dc3545;display:none" id="idGenErr">* Genre is missing</label>';;
              echo "</div>";

              echo '<div class="col-md-6 separador">';
              echo '<label>Language:</label>';
              echo '<select class="form-select" name="lang" id="lang">';
              echo '<option selected disabled>Select an option:</option>';
              $stmt = $conn->prepare("SELECT l.idIdioma, l.nomIdiomaEng 
              FROM db_library_languages AS l
              ORDER BY l.nomIdiomaEng ASC;");
              $stmt->execute(); 
              $data = $stmt->fetchAll();
                foreach($data as $row){
                  $nomIdioma = $row['nomIdiomaEng'];
                  $idIdioma = $row['idIdioma'];
                  if ($idIdiomaPost == $idIdioma){
                    echo "<option value=".$idIdiomaPost." selected>".$nomIdioma."</option>"; 
                  } else {
                    echo "<option value=".$idIdioma.">".$nomIdioma."</option>"; 
                  }
                }   
              echo '</select>';
              echo '<label style="color:#dc3545;display:none" id="IdIdiomaErr">* Language is missing</label>';
              echo "</div>";
              echo "</div>";

              echo ' <div class="row">';
              echo '<div class="col-md-6 separador">';
              echo '<label>Type:</label>';
              echo '<select class="form-select" name="tipus" id="tipus">';
              echo '<option selected disabled>Select an option:</option>';
              $stmt = $conn->prepare("SELECT t.nomTipusEng, t.id
              FROM 	db_library_booktype AS t
              ORDER BY t.nomTipusEng ASC;");
              $stmt->execute(); 
              $data = $stmt->fetchAll();
                foreach($data as $row){
                  $id_antic = $row['id'];
                  $tipusNom = $row['nomTipusEng'];
                  if ($tipusPost == $id_antic) {
                    echo "<option value=".$tipusPost." selected>".$tipusNom."</option>"; 
                  } else {
                    echo "<option value=".$id_antic.">".$tipusNom."</option>"; 
                  }
                }
              echo '</select>';
              echo '<label style="color:#dc3545;display:none" id="tipusErr">* Type of book is missing</label>';
              echo '</div></div>
                </form>
              </div>';
?>
              <script>
                $(function() {
                    $('#nomAutor').selectize({
                      create: true,
                      preload: true,
                      valueField: 'id',
                      labelField: 'text',
                      searchField: 'text',                  
                    });

                    $('#img').selectize({
                      create: true,
                      preload: true,
                      valueField: 'id',
                      labelField: 'text',
                      searchField: 'text',                  
                    });

                    $('#idEd').selectize({
                      create: true,
                      preload: true,
                      valueField: 'id',
                      labelField: 'text',
                      searchField: 'text',                  
                    });
                });
              </script>
          <?php

?>