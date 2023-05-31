<?php
# conectare la base de datos
include_once('../../inc/connection.php');

if (isset($_POST['idAuthor'])) {
  $idAuthor_old = $_POST['idAuthor'];
} else {
  $idAuthor_old = NULL;
}

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createBookMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createBookMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

          echo '<form method="POST" action="" id="modalFormBook" class="row g-3 modalFormBook" style="'.FORM_BACKGROUND_COLOR.'">';
          
          $timestamp = date('Y-m-d');
          echo '<input type="hidden" id="dateCreated" name="dateCreated" value="'.$timestamp.'">';

          echo '<h4>Book title</h4>';
          echo ' <div class="row">
            <div class="col-md-6">';
            echo '<input class="form-control" type="text" name="titol" id="titol" placeholder="Original title" >';
            echo '<label style="color:#dc3545;display:none" id="titolErr">* Title is missing</label>
            </div>';
          
          echo '<div class="col-md-6">';
          echo '<input class="form-control" type="text" name="titolEng" id="titolEng" placeholder="English title" >';
          echo '<label style="color:#dc3545;display:none" id="titolEngErr">* Invalid data</label>
            </div>
          </div>';

          echo '<hr>';
          
          echo '<div class="row">';
          
          echo '<div class="col-md-6">';
          echo "<h4>Author</h4>";
          echo '<select name="nomAutor" id="nomAutor">';
          echo '<option selected>Select an author:</option>';
          $stmt = $conn->prepare("SELECT id, AutNom, AutCognom1 
          FROM db_library_authors
          ORDER BY AutCognom1 ASC;");
          $stmt->execute(); 
          $data = $stmt->fetchAll();
          foreach($data as $row) {
            $idAutor = $row['id'];
            $AutNom = $row['AutNom']; 
            $AutCognom1 = $row['AutCognom1'];
            if ($idAuthor_old == $idAutor) {
              echo "<option value='".$idAuthor_old."' selected>".$AutCognom1.", ".$AutNom."</option>"; 
            } else {
              echo "<option value='".$idAutor."'>".$AutCognom1.", ".$AutNom."</option>"; 
            }
          }
          echo '</select>';
          echo '<label style="color:#dc3545;display:none" id="nomAutorErr">* Author name is missing</label>';
          echo "</div>";


          ?>
              <script>
                    $('#nomAutor').selectize({
                      create: true,
                      preload: true,
                      valueField: 'id',
                      labelField: 'text',
                      searchField: 'text',                  
                    });
              </script>
          <?php


          echo '<div class="col-md-6">';
          echo '<h4>Image cover</h4>';

          echo '<select name="img" id="img">';
          echo '<option selected value="">Select an image:</option>';
          echo "<option value='296'>Default image</option>"; 
          $stmt = $conn->prepare("SELECT i.id, i.alt
          FROM db_img AS i
          WHERE i.typeImg = 2
          ORDER BY i.alt ASC");
          $stmt->execute(); 
          $data = $stmt->fetchAll();
            foreach($data as $row){
              $id_antic = $row['id'];
              $post_name = $row['alt'];
              echo "<option value='".$id_antic."'>".$post_name."</option>"; 
            }    
          echo '</select>';
          
          echo "<span style='margin-top:15px'> <a href='#' title='upload image' onclick='divUploadImg(2);return false;'>Need to upload a new image?</a></span><div id='uploadImg'> </div>";
          echo "</div>";
          
          echo "</div>";

          echo '<hr>';
          echo '<h4>Other information</h4>';
          echo ' <div class="row">';
            echo '<div class="col-md-6 separador">';
            echo '<label>Publication year:</label>';
            echo '<input class="form-control" type="text" name="any" id="any">';
            echo '<label style="color:#dc3545;display:none" id="anyErr">* Year is missing</label>';
            echo "</div>";
      
          echo '<div class="col-md-6 separador">';
          echo '<label>Publisher:</label>';
          echo '<select name="idEd" id="idEd">';
          echo '<option selected value="">Select a publisher</option>';
          $stmt = $conn->prepare("SELECT nomEditorial, idEditorial 
              FROM db_library_publishers
              ORDER BY nomEditorial ASC;");
              $stmt->execute(); 
              $data = $stmt->fetchAll();
                foreach ($data as $row) {
                  $nomEditorial = $row['nomEditorial'];
                  $idEditorial = $row['idEditorial'];
                echo "<option value='".$idEditorial."'>".$nomEditorial."</option>"; 
            }
          echo '</select>';
          echo '<label style="color:#dc3545;display:none" id="idEdErr">* Publisher is missing</label>';
          echo "<span style='margin-top:15px'> <a href='#' title='create new publisher' onclick='divCreatePublisher();return false;'>Need to create new Publisher?</a></span>";
          
          echo "</div>";
          echo '<div id="createPublisher"></div>';
          echo "</div>";
      
          echo ' <div class="row">';
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
                  echo "<option value='".$idGenere."'>".$nomGen."</option>"; 
            }
          echo '</select>';
          echo '<label style="color:#dc3545;display:none" id="idGenErr">* Genre is missing</label>';
          echo "</div>";
      
          echo '<div class="col-md-6 separador">';
          echo '<label>Language:</label>';
          echo '<select class="form-select" name="lang" id="lang">';
          echo '<option selected disabled>Select an option:</option>';
          $stmt = $conn->prepare("SELECT l.id, l.language 
          FROM db_library_languages AS l
          ORDER BY l.language ASC;");
          $stmt->execute(); 
          $data = $stmt->fetchAll();
            foreach($data as $row){
              $language = $row['language'];
              $idIdioma = $row['id'];
              echo "<option value='".$idIdioma."'>".$language."</option>"; 
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
              echo "<option value='".$id_antic."'>".$tipusNom."</option>"; 
            }
          echo '</select>';
          echo '<label style="color:#dc3545;display:none" id="tipusErr">* Type of book is missing</label>';
          echo '</div>';
          echo '</div>';
              
          echo "</form>

          </div>";
        
          ?>
              <script>
                $(function() {

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