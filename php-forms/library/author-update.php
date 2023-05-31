<?php
# conectare la base de datos
include_once('../../inc/connection.php');
include_once('../../inc/functions.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    $id = $_POST['id'];
}

$author = selectSingleLibraryAuthor($id);
    $AutNomPost = $author['AutNom']; 
    $AutCognom1Post = $author['AutCognom1'];
    $AutOcupacioPost = $author['AutOcupacio'];
    $AutMovimentPost = $author['AutMoviment'];
    $yearBornPost = $author['yearBorn'];
    $yearDiePost = $author['yearDie'];
    $paisAutorPost = $author['paisAutor'];
    $imgPost = $author['img'];
    $AutWikipediaPost = $author['AutWikipedia'];
    $AutDescripPost = $author['AutDescrip'];
    $nomPaisEngPost = $author['nomPaisEng'];

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="updateAuthorMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="updateAuthorMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormAuthor" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';
    echo '<input type="hidden" id="id" name="id" value="'.$id.'">';

    echo '<div class="col-md-4">';
    echo '<label>First name:</label>';
    echo '<input class="form-control" type="text" name="AutNom" id="AutNom" value="'.$AutNomPost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Last name:</label>';
    echo '<input class="form-control" type="text" name="AutCognom1" id="AutCognom1" value="'.$AutCognom1Post.'">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Wikipedia page:</label>';
    echo '<input class="form-control" type="url" name="AutWikipedia" id="AutWikipedia" value="'.$AutWikipediaPost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Birth year:</label>';
    echo '<input class="form-control" type="text" name="yearBorn" id="yearBorn" value="'.$yearBornPost.'">';
    echo '<label style="color:#dc3545;display:none" id="dataNaixCheck">* Invalid data</label>';
    echo "</div>";

    echo '<div class="col-md-4">';
    echo '<label>Death year:</label>';
    echo '<input class="form-control" type="text" name="yearDie" id="yearDie" value="'.$yearDiePost.'">';
    echo '</div>';

    echo '<div class="col-md-4">
	    <label>Country:</label>
	    <select name="paisAutor" id="paisAutor">';
	    echo '</select>';
	    echo '<label style="color:#dc3545;display:none" id="countryCheck">* Missing data</label>';
	    echo '</div>';

      ?>
      <script>
        var url = '../inc/route.php?type=country';
        var paisId = "<?php echo $paisAutorPost; ?>";
        var paisNom = "<?php echo $nomPaisEngPost; ?>";
        console.log(paisId); 
        $("#paisAutor").val(paisId).change();
        // Populate dropdown with list of provinces
        $('#paisAutor').selectize({
          preload: true,
          create: true,
          valueField: 'abbreviation',
          labelField: 'name',
          searchField: 'name',
          setValue: "2",
          options:[{abbreviation: paisId,name:paisNom}],
          items: [paisId],
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
          },

        });
      </script>
      <?php

    echo '<div class="col-md-4">';
    echo '<label>Author image:</label>';
    echo '<select name="img" id="img">';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT i.id, i.alt
        FROM db_img AS i
        WHERE i.typeImg = 1
        ORDER BY i.alt ASC");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach($data as $row){
            $id = $row['id'];
            $name = $row['alt'];
            if ($imgPost == $id) {
                echo "<option value='".$imgPost."' selected>".$name."</option>"; 
              } else {
                echo "<option value='".$id."'>".$name."</option>";
              }
      }
    echo '</select>
    </div>';
    echo "<span style='margin-top:15px'> <a href='#' title='upload image' onclick='divUploadImg(1);return false;'>Need to upload a new image?</a></span>";
    echo '<div id="uploadImg"> </div>';

    echo '<div class="col-md-4">';
    echo '<label>Profession:</label>';
    echo '<select class="form-select" name="AutOcupacio" id="AutOcupacio">';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT o.id, o.name 
    FROM db_persons_role AS o
    ORDER BY o.name ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $id = $row['id'];
        $name = $row['name'];
        if ($AutOcupacioPost == $id) {
            echo "<option value='".$AutOcupacioPost."' selected>".$name."</option>"; 
          } else {
            echo "<option value='".$id."'>".$name."</option>"; 
          }
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutOcupacioCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Literary movement:</label>';
    echo '<select class="form-select" name="AutMoviment" id="AutMoviment">';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT m.id, m.movement
    FROM db_library_movements AS m
    ORDER BY m.movement ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idMov_antic = $row['id'];
        $nomMov = $row['movement'];
        if ($AutMovimentPost == $idMov_antic) {
            echo "<option value='".$AutMovimentPost."' selected>".$nomMov."</option>"; 
          } else {
            echo "<option value='".$idMov_antic."'>".$nomMov."</option>"; 
          }
      }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutMovimentCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-12">';
    echo '<label>Description:</label>';
    echo "<textarea class='form-control' id='AutDescrip' name='AutDescrip' rows='3'>".$AutDescripPost."</textarea>";
    echo '<label style="color:#dc3545;display:none" id="AutDescripheck">* Missing data</label>';
    echo '</div>';
   

          ?>
              <script>
                $(function() {
                    $('#paisAutor').selectize({
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
                });
              </script>
          <?php

