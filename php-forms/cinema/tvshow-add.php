<?php
# conectare la base de datos
include_once('../../inc/connection.php');

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createTVShowMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createTVShowMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormAddTVShow" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" id="dateCreated" name="dateCreated" value="'.$timestamp.'">';
    echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';

    echo '<div class="col-md-4">';
    echo '<label for="serveiNom">TV Show name:</label>';
    echo '<input type="text" class="form-control" name="name" id="name" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiUsuari">Start year:</label>';
    echo '<input type="text" class="form-control" name="startYear" id="startYear" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiPas">End year:</label>';
    echo '<input type="text" class="form-control" name="endYear" id="endYear">';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiWeb">Seasons:</label>';
    echo '<input type="text" class="form-control" name="season" id="season" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiWeb">Chapters:</label>';
    echo '<input type="text" class="form-control" name="chapter" id="chapter" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Director:</label>';
    echo '<select class="form-select" name="director" id="director" required>';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT d.id, d.nomDirector, d.lastName
    FROM db_tvmovies_directors AS d
    ORDER BY d.lastName ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idDirector = $row['id'];
        $nomDirector = $row['nomDirector'];
        $lastName = $row['lastName'];
        echo "<option value='".$idDirector."'>".$lastName.", ".$nomDirector."</option>"; 
      }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Language:</label>';
    echo '<select class="form-select" name="lang" id="lang" required>';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT l.id, l.language
    FROM db_library_languages  AS l
    ORDER BY l.language ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idLang = $row['id'];
        $language = $row['language'];
        echo "<option value='".$idLang."'>".$language."</option>"; 
      }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Genre:</label>';
    echo '<select class="form-select" name="genre" id="genre" required>';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT t.id, t.topic
    FROM db_topics AS t
    WHERE t.idGenere = 20
    ORDER BY t.topic ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idGen = $row['id'];
        $topic = $row['topic'];
        echo "<option value='".$idGen."'>".$topic."</option>"; 
      }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>TV Producer:</label>';
    echo '<select class="form-select" name="producer" id="producer" required>';
    echo '<option selected disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT d.id, d.producer
    FROM db_tvmovies_distributors AS d
    ORDER BY d.producer ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idProd = $row['id'];
        $producer = $row['producer'];
        echo "<option value='".$idProd."'>".$producer."</option>"; 
      }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Country:</label>';
    echo '<select name="country" id="country" required>';
    echo '<option selected disabled>Select an option:</option>';
    ?>
      <script>
        var url = '../inc/route.php?type=country';
        // Populate dropdown with list of countries
        $('#country').selectize({
          preload: true,
          create: true,
          valueField: 'abbreviation',
          labelField: 'name',
          searchField: 'name',
          options: [],
          load: function(query, callback) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {
                    country: query,
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res);
                }
            });
          }
        });
      </script>
      <?php
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>TV Show image:</label>';
    echo '<select name="img" id="img">';
    echo '<option selected value="">Select an option:</option>';
    echo "<option value='296'>Default image</option>"; 

    echo '</select>';
    echo '</div>';
    echo "<span style='margin-top:15px'> <a href='#' title='upload image' onclick='divUploadImg(7);return false;'>Need to upload a new image?</a></span>";
    echo '<div id="uploadImg"></div>';
    ?>
    <script>
      var url_img = '../inc/route.php?type=img&group=7';
      // Populate dropdown with list of countries
      $('#img').selectize({
        preload: true,
        create: true,
        valueField: 'id',
        labelField: 'alt',
        searchField: 'alt',
        options: [],
        load: function(query, callback) {
          $.ajax({
              url: url_img,
              type: 'GET',
              dataType: 'json',
              error: function() {
                  callback();
              },
              success: function(res) {
                  callback(res);
              }
          });
        }
      });
    </script>
    <?php

    echo "</form>";