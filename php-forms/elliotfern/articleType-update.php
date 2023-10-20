<?php
# conectare la base de datos
include_once('../../inc/connection.php');
include_once('../../inc/functions.php');

if (isset($_POST['idWP'])) {
    $idWP = $_POST['idWP'];
} else {
    $idWP = $_POST['idWP'];
}

$article = selectSingleArticleWPType($idWP);
    $id = $article['id'];
    $langPost = $article['lang'];
    $typePost = $article['type'];
    $post_titlePost = $article['post_title'];

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="updateArticleWpMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="updateArticleWpMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';
    echo "<h6>Article: ".$post_titlePost."</h6>";

    echo '<form method="POST" action="" id="modalFormArticle" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    $timestamp = date('Y-m-d');
    //echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';
    echo '<input type="hidden" id="idPost" name="idPost" value="'.$idWP.'">';
    echo '<input type="hidden" id="id" name="id" value="'.$id.'">';

    echo '<div class="col-md-4">';
    echo '<label>Language:</label>';
    echo '<select class="form-select" name="lang" id="lang">';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT l.id, l.language
    FROM db_library_languages AS l
    ORDER BY l.language ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $id_antic = $row['id'];
        $language = $row['language'];
        if ($langPost == $id_antic) {
            echo "<option value='".$langPost."' selected>".$language."</option>"; 
          } else {
            echo "<option value='".$id_antic."'>".$language."</option>"; 
          }
      }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutMovimentCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Type post:</label>';
    echo '<select class="form-select" name="type" id="type">';
    echo '<option disabled>Select an option:</option>';
    if (!empty($typePost)) {
      if ($typePost == 1 ) {
        $typeName = "Elliotfern blog";
      } elseif ($typePost == 2 ) {
        $typeName = "History article";
      } elseif ($typePost == 3 ) {
        $typeName = "History course";
      } elseif ($typePost == 4 ) {
        $typeName = "History timeline";
      } elseif ($typePost == 5 ) {
        $typeName = "History homepage";
      }
    echo "<option value='".$typePost."' selected>".$typeName."</option>"; 
    echo '<option value="1">Elliotfern blog</option>';
    echo '<option value="2">History article</option>';
    echo '<option value="3">History course</option>';
    echo '<option value="4">History timeline</option>';
    echo '<option value="5">History homepage</option>';
    echo '<option value="6"> History event</option>';
    echo '<option value="7">History city</option>';
  } else {
    echo '<option value="1">Elliotfern blog</option>';
    echo '<option value="2">History article</option>';
    echo '<option value="3">History course</option>';
    echo '<option value="4">History timeline</option>';
    echo '<option value="5">History homepage</option>';
    echo '<option value="6"> History event</option>';
    echo '<option value="7">History city</option>';
  }
  echo '</select>';
  echo '</div>';

    echo "</form>";