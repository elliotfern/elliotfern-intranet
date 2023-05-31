<?php
# conectare la base de datos
include_once('../../inc/connection.php');

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createActorMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createActorMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormAddActor" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    // id 	actorLastName 	actorFirstName 	actorCountry 	birthYear 	deadYear 	img 	
    // $timestamp = date('Y-m-d');
    //echo '<input type="hidden" id="dateCreated" name="dateCreated" value="'.$timestamp.'">';
    // echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';

    echo '<div class="col-md-4">';
    echo '<label for="serveiNom">First Name:</label>';
    echo '<input type="text" class="form-control" name="actorFirstName" id="actorFirstName" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiUsuari">Last name:</label>';
    echo '<input type="text" class="form-control" name="actorLastName" id="actorLastName" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiPas">Birth year:</label>';
    echo '<input type="text" class="form-control" name="birthYear" id="birthYear">';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label for="serveiWeb">Death year:</label>';
    echo '<input type="text" class="form-control" name="deadYear" id="deadYear" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Country:</label>';
    echo '<select name="actorCountry" id="actorCountry" required>';
    echo '<option selected disabled>Select an option:</option>';
    ?>
      <script>
        var url = '../inc/route.php?type=country';
        // Populate dropdown with list of countries
        $('#actorCountry').selectize({
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
    echo '<label>Actor image:</label>';
    echo '<select name="img" id="img">';
    echo '<option selected value="">Select an option:</option>';
    echo "<option value='296'>Default image</option>"; 

    echo '</select>';
    echo '</div>';
    echo "<span style='margin-top:15px'> <a href='#' title='upload image' onclick='divUploadImg(9);return false;'>Need to upload a new image?</a></span>";
    echo '<div id="uploadImg"></div>';
    ?>
    <script>
      var url_img = '../inc/route.php?type=img&group=9';
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