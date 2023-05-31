<?php
# conectare la base de datos
global $conn;

if (isset($_POST['idLink'])) {
    $idLink = $_POST['idLink'];
} else {
    $idLink = $_POST['idLink'];
}


//call api
//read json file from url in php
$url = APP_SERVER . "/controller/links.php?type=link&id=" .$idLink;
$input = file_get_contents($url);
$arr = json_decode($input, true);
$obj = $arr[0];

$nom_old = $obj['nom'];
$web_old = $obj['web'];
$cat_old = $obj['cat'];
$lang_old = $obj['lang'];
$tipus_old = $obj['tipus'];
$linkCreated_old = $obj['linkCreated'];
$linkUpdated_old = $obj['linkUpdated'];

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="updateLinkMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="updateLinkMessageErr">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormUpdateLink" class="row g-3">';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" id="dateModified" name="linkUpdated" value="'.$timestamp.'">';
    echo '<input type="hidden" id="id" name="id" value="'.$obj['id'].'">';

    echo '<div class="col-md-4">';
    echo '<label>Name link:</label>';
    echo '<input class="form-control" type="text" name="nom" id="nom" value="'.$nom_old.'">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>URL link:</label>';
    echo '<input class="form-control" type="text" name="web" id="web" value="'.$web_old.'">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Link topic:</label>';
    echo '<select class="form-select" name="cat" id="cat">';
    echo '<option disabled>Select an option:</option>';
    //call api
    //read json file from url in php
    $url2 = APP_SERVER . "/controller/library.php?type=topics";
    $input2 = file_get_contents($url2);
    $arr2 = json_decode($input2, true);
    foreach ($arr2 as $obj2) {
      $idtopic = $obj2['id'];
      $topic = $obj2['topic'];
        if ($cat_old == $idtopic) {
          echo "<option value=".$idtopic." selected>".$topic."</option>"; 
        } else {
          echo "<option value=".$idtopic.">".$topic."</option>"; 
        }
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="nomAutorErr">* Author name is missing</label>';
    echo "</div>";

    echo '<div class="col-md-4">';
    echo '<label>Language:</label>';
    echo '<select class="form-select" name="lang" id="lang">';
    echo '<option disabled>Select an option:</option>';
    if ($lang_old == 1) {
        echo "<option value=1 selected>English</option>";
        echo "<option value=2>Catalan</option>";
        echo "<option value=3>Spanish</option>";
        echo "<option value=4>Italian</option>";
        echo "<option value=0>None</option>";
    } elseif ($lang_old == 2) {
        echo "<option value=2 selected>Catalan</option>";
        echo "<option value=1>English</option>";
        echo "<option value=3>Spanish</option>";
        echo "<option value=4>Italian</option>";
        echo "<option value=0>None</option>";
    } elseif ($lang_old == 3) {
        echo "<option value=3 selected>Spanish</option>";
        echo "<option value=1>English</option>";
        echo "<option value=2>Catalan</option>";
        echo "<option value=4>Italian</option>";
        echo "<option value=0>None</option>";
    } elseif ($lang_old == 4) {
        echo "<option value=4 selected>Italian</option>";
        echo "<option value=1>English</option>";
        echo "<option value=2>Catalan</option>";
        echo "<option value=3>Spanish</option>";
        echo "<option value=0>None</option>";
    } elseif ($lang_old == 0) {
        echo "<option value=0 selected>None</option>";
        echo "<option value=1>English</option>";
        echo "<option value=2>Catalan</option>";
        echo "<option value=3>Spanish</option>";
        echo "<option value=4>Italian</option>";

    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="nomAutorErr">* Author name is missing</label>';
    echo "</div>";

    echo '<div class="col-md-4">';
    echo '<label>Type link:</label>';
    echo '<select class="form-select" name="tipus" id="tipus">';
    echo '<option disabled>Select an option:</option>';
    //call api
    //read json file from url in php
    $url3 = APP_SERVER . "/controller/links.php?type=type";
    $input3 = file_get_contents($url3);
    $arr3 = json_decode($input3, true);
    foreach ($arr3 as $obj3) {
      $idtype = $obj3['id'];
      $type = $obj3['type'];
      if ($tipus_old == $idtype) {
        echo "<option value=".$idtype." selected>".$type."</option>"; 
      } else {
        echo "<option value=".$idtype.">".$type."</option>"; 
      }
    }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="nomAutorErr">* Author name is missing</label>';
    echo "</div>";