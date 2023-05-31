<?php
# conectare la base de datos
include_once('../../inc/connection.php');

if (isset($_POST['idActor'])) {
    $idAc = filter_input(INPUT_POST, 'idActor', FILTER_SANITIZE_NUMBER_INT);
} else {
    $idAc = filter_input(INPUT_POST, 'idActor', FILTER_SANITIZE_NUMBER_INT);
}

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createActorTVshowMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createActorTVshowMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormAddActorTVShow" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';	
    // $timestamp = date('Y-m-d');
    //echo '<input type="hidden" id="dateCreated" name="dateCreated" value="'.$timestamp.'">';
    // echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';

    echo '<div class="col-md-4">';
    echo '<label for="serveiWeb">Role:</label>';
    echo '<input type="text" class="form-control" name="role" id="role" required>';
    echo '<label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Actor:</label>';
    echo '<select class="form-select" name="idActor" id="idActor" required>';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT a.id, a.actorLastName, a.actorFirstName
    FROM db_tvmovies_actors AS a
    ORDER BY a.actorLastName ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $id = $row['id'];
        $actorLastName = $row['actorLastName'];
        $actorFirstName = $row['actorFirstName'];
        if ($idAc == $id) {
            echo "<option value='".$idAc."' selected>".$actorLastName.", ".$actorFirstName."</option>"; 
          } else {
            echo "<option value='".$id."'>".$actorLastName.", ".$actorFirstName."</option>"; 
          }
    }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>TV Show:</label>';
    echo '<select class="form-select" name="idtvShow" id="idtvShow" required>';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT s.id, s.name
    FROM db_tvmovies_tvshows AS s
    ORDER BY s.name ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $idS = $row['id'];
        $name = $row['name'];
            echo "<option value='".$idS."'>".$name."</option>"; 
     
    }
    echo '</select>
    <label style="color:#dc3545">* </label>';
    echo '</div>';

    echo "</form>";