<?php
# conectare la base de datos
global $conn;
include_once(APP_SERVER . '/inc/connection.php');


// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createLinkMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createLinkMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

   echo '<form method="POST" action="" id="bodyModalNewLink" class="row g-3">';

   $timestamp = date('Y-m-d');
   echo '<input type="hidden" id="linkCreated" name="linkCreated" value="'.$timestamp.'">';

    echo '<div class="col-md-4">';
    echo '<label>Link name</label>';
    echo '<input class="form-control" type="text" name="nom" id="nom">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>URL link</label>';
    echo '<input class="form-control" type="text" name="web" id="web">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Topic:</label>';
    echo '<select class="form-select" name="cat" id="cat">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT t.id, t.topic
        FROM db_topics AS t
        ORDER BY t.topic ASC");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach($data as $row) {
            $idTopic = $row['id'];
            $topic = $row['topic'];
            echo "<option value=".$idTopic.">".$topic."</option>"; 
        }
    echo '</select>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Lang:</label>';
    echo '<select class="form-select" name="lang" id="lang">';
    echo '<option selected value="">Select an option:</option>';
    echo "<option value='1' selected>English</option>";
    echo "<option value='2' selected>Catalan</option>"; 
    echo "<option value='3' selected>Spanish</option>"; 
    echo "<option value='4' selected>Italian</option>"; 
    echo "<option value='0' selected>None</option>"; 
    echo '</select>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Type:</label>';
    echo '<select class="form-select" name="tipus" id="tipus">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT t.id, t.type
        FROM db_links_type AS t
        ORDER BY t.type ASC");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach($data as $row) {
            $idType = $row['id'];
            $type = $row['type'];
            echo "<option value=".$idType.">".$type."</option>"; 
        }
    echo '</select>';
    echo '</div>';

echo "</form>";