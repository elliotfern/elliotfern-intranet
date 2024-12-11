<?php
# conectare la base de datos
include_once('../../inc/connection.php');

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createAuthorMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createAuthorMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormAuthor" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" id="dateCreated" name="dateCreated" value="'.$timestamp.'">';

    echo '<div class="col-md-4">';
    echo '<label>First name:</label>';
    echo '<input class="form-control" type="text" name="AutNom" id="AutNom" placeholder="First name">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Last name:</label>';
    echo '<input class="form-control" type="text" name="AutCognom1" id="AutCognom1" placeholder="Last name">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Wikipedia page:</label>';
    echo '<input class="form-control" type="url" name="AutWikipedia" id="AutWikipedia" placeholder="Wikipedia">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Birth year:</label>';
    echo '<input class="form-control" type="text" name="yearBorn" id="yearBorn" placeholder="Birth year">';
    echo '<label style="color:#dc3545;display:none" id="dataNaixCheck">* Invalid data</label>';
    echo "</div>";

    echo '<div class="col-md-4">';
    echo '<label>Death year:</label>';
    echo '<input class="form-control" type="text" name="yearDie" id="yearDie" placeholder="Death year">';
    echo '</div>';

    echo '<div class="col-md-4">
	    <label>Country:</label>
	    <select name="paisAutor" id="paisAutor">';
      echo '<option selected value="">Select a country</option>';
	    
	    echo '</select>';
	    echo '<label style="color:#dc3545;display:none" id="countryCheck">* Missing data</label>';
	    echo '</div>';
      
      ?>
      <script>
        var url = '../inc/route.php?type=country';
        // Populate dropdown with list of countries
        $('#paisAutor').selectize({
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

    echo '<div class="col-md-4">';
    echo '<label>Author image:</label>';
    echo '<select name="img" id="img">';
    echo '<option selected value="">Select an option:</option>';
    echo "<option value='296'>Default image</option>"; 

    echo '</select>';
    echo '</div>';
    echo "<span style='margin-top:15px'> <a href='#' title='upload image' onclick='divUploadImg(1);return false;'>Need to upload a new image?</a></span>";
    echo '<div id="uploadImg"></div>';
    ?>
    <script>
      var url_img = '../inc/route.php?type=img&group=1';
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

    echo '<div class="col-md-4">';
    echo '<label>Profession:</label>';
    echo '<select name="AutOcupacio" id="AutOcupacio">';
    echo '<option selected value="">Select an option:</option>';

    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutOcupacioCheck">* Missing data</label>';
    echo '</div>';

    ?>
    <script>
      var url_prof = '../inc/route.php?type=profession';
      // Populate dropdown with list of profession
      $('#AutOcupacio').selectize({
        preload: true,
        create: true,
        valueField: 'id',
        labelField: 'name',
        searchField: 'name',
        options: [],
        load: function(query, callback) {
          $.ajax({
              url: url_prof,
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

    echo '<div class="col-md-4">';
    echo '<label>Literary movement:</label>';
    echo '<select name="AutMoviment" id="AutMoviment">';
    echo '<option selected value="">Select an option:</option>';

    ?>
    <script>
      var url_mov = '../inc/route.php?type=movement';
      // Populate dropdown with list of profession
      $('#AutMoviment').selectize({
        preload: true,
        create: true,
        valueField: 'id',
        labelField: 'movement',
        searchField: 'movement',
        options: [],
        load: function(query, callback) {
          $.ajax({
              url: url_mov,
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

    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutMovimentCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-12">';
    echo '<label>Description:</label>';
    echo "<textarea class='form-control' id='AutDescrip' name='AutDescrip' rows='3'></textarea>";
    echo '<label style="color:#dc3545;display:none" id="AutDescripheck">* Missing data</label>';
    echo '</div>';

    echo "</form>";