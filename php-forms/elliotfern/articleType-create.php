<?php
# conectare la base de datos
include_once('../../inc/connection.php');
include_once('../../inc/functions.php');


// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="createArticleWpMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="createArticleWpMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';
    echo "<h6>Article: ".$post_titlePost."</h6>";

    echo '<form method="POST" action="" id="modalFormCreateArticle" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    $timestamp = date('Y-m-d');
    //echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';
    
    echo '<div class="col-md-4">';
    echo '<label>WP Article:</label>';
    echo '<select class="form-select" name="idPost" id="idPost">';
    echo '<option selected>Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.ID, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    WHERE (p.post_type = 'post' OR p.post_type= 'page') AND p.post_status = 'publish' AND
    NOT EXISTS (
    SELECT * 
    FROM kvqphwff_data.db_elliotfern_posts_lang AS l 
    WHERE p.ID = l.idPost )
    ORDER BY p.ID ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row){
        $id_antic = $row['ID'];
        $post_title = $row['post_title'];
        echo "<option value='".$id_antic."'>".$id_antic." - ".$post_title."</option>"; 
      }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="AutMovimentCheck">* Missing data</label>';
    echo '</div>';

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
    echo '<option value="1">Elliotfern blog</option>';
    echo '<option value="2">History article</option>';
    echo '<option value="3">History course</option>';
    echo '<option value="4">History timeline</option>';
    echo '<option value="5">History homepage</option>';
    echo '<option value="6"> History event</option>';
    echo '<option value="7">History city</option>';
  echo '</select>';
  echo '</div>';

    echo "</form>";