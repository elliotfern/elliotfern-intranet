<?php
# conectare la base de datos
include_once('../../inc/connection.php');
include_once('../../inc/functions.php');

if (isset($_POST['idCourse'])) {
    $id = $_POST['idCourse'];
} else {
    $id = $_POST['idCourse'];
}

$course = selectSinglecourseHistory($id);
    $nameCatPost = $course['nameCat']; 
    $nameCastPost = $course['nameCast'];
    $nameEngPost = $course['nameEng'];
    $nameItPost = $course['nameIt'];
    $nameFrPost = $course['nameFr'];
    $descripCatPost = $course['descripCat'];
    $descripCastPost = $course['descripCast'];
    $descripEngPost = $course['descripEng'];
    $descripItPost = $course['descripIt'];
    $descripFrPost = $course['descripFr'];
    $wpIdCatPost = $course['wpIdCat'];
    $wpIdCastPost = $course['wpIdCast'];
    $wpIdEngPost = $course['wpIdEng'];
    $wpIdItPost = $course['wpIdIt'];
    $wpIdFrPost = $course['wpIdFr'];
    $imgPost = $course['img'];
    $ordrePost = $course['ordre'];

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="updateCourseMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="updateCourseMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormCourse" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    $timestamp = date('Y-m-d');
    //echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';
    echo '<input type="hidden" id="id" name="id" value="'.$id.'">';

    echo '<div class="col-md-4">';
    echo '<label>Course name (Catalan):</label>';
    echo '<input class="form-control" type="text" name="nameCat" id="nameCat" value="'.$nameCatPost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Course name (Spanish):</label>';
    echo '<input class="form-control" type="text" name="nameCast" id="nameCast" value="'.$nameCastPost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Course name (English):</label>';
    echo '<input class="form-control" type="text" name="nameEng" id="nameEng" value="'.$nameEngPost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Course name (Italian):</label>';
    echo '<input class="form-control" type="text" name="nameIt" id="nameIt" value="'.$nameItPost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Course name (French):</label>';
    echo '<input class="form-control" type="text" name="nameFr" id="nameFr" value="'.$nameFrPost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Order:</label>';
    echo '<input class="form-control" type="url" name="ordre" id="ordre" value="'.$ordrePost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo "<hr>";
    echo "<h4>WP pages</h4>";

    echo '<div class="col-md-4">';
    echo '<label>WP Catalan:</label>';
    echo '<select class="form-select" name="wpIdCat" id="wpIdCat">';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.ID, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 1 AND l.type = 3
    ORDER BY p.post_title ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idCat = $row['ID'];
            $post_title = $row['post_title'];
            if ($wpIdCatPost == $idCat) {
                echo "<option value='".$wpIdCatPost."' selected>".$post_title."</option>"; 
              } else {
                echo "<option value='".$idCat."'>".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';

    echo '<div class="col-md-4">';
    echo '<label>WP English:</label>';
    echo '<select class="form-select" name="wpIdEng" id="wpIdEng">';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.id, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 2 AND l.type = 3
    ORDER BY p.post_title ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idEng = $row['id'];
            $post_title = $row['post_title'];
            if ($wpIdEngPost == $idEng) {
                echo "<option value='".$wpIdEngPost."' selected>".$post_title."</option>"; 
              } else {
                echo "<option value='".$idEng."'>".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';

    echo '<div class="col-md-4">';
    echo '<label>WP Spanish:</label>';
    echo '<select class="form-select" name="wpIdCast" id="wpIdCast">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.id, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 3 AND l.type = 3
    ORDER BY p.post_title ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idCast = $row['id'];
            $post_title = $row['post_title'];
            if ($wpIdCastPost == $idCast) {
                echo "<option value='".$wpIdCastPost."' selected>".$post_title."</option>"; 
              } else {
                echo "<option value='".$idCast."'>".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';

    echo '<div class="col-md-4">';
    echo '<label>WP Italian:</label>';
    echo '<select class="form-select" name="wpIdIt" id="wpIdIt">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.id, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 4 AND l.type = 3
    ORDER BY p.post_title ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idIt = $row['id'];
            $post_title = $row['post_title'];
            if ($wpIdItPost == $idIt) {
                echo "<option value='".$wpIdItPost."' selected>".$post_title."</option>"; 
              } else {
                echo "<option value='".$idIt."'>".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';

    echo '<div class="col-md-4">';
    echo '<label>WP French:</label>';
    echo '<select class="form-select" name="wpIdFr" id="wpIdFr">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.id, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 7 AND l.type = 3
    ORDER BY p.post_title ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idFr = $row['id'];
            $post_title = $row['post_title'];
            if ($wpIdFrPost == $idFr) {
                echo "<option value='".$wpIdFrPost."' selected>".$post_title."</option>"; 
              } else {
                echo "<option value='".$idFr."'>".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';
    
    echo "<hr>";
    echo "<h4>Courses descripion</h4>";

    echo '<div class="col-md-12">';
    echo '<label>Description CAT:</label>';
    echo "<textarea class='form-control' id='descripCat' name='descripCat' rows='3'>".$descripCatPost."</textarea>";
    echo '<label style="color:#dc3545;display:none" id="AutDescripheck">* Missing data</label>';
    echo '</div>';
   
    echo '<div class="col-md-12">';
    echo '<label>Description CAST:</label>';
    echo "<textarea class='form-control' id='descripCast' name='descripCast' rows='3'>".$descripCastPost."</textarea>";
    echo '<label style="color:#dc3545;display:none" id="AutDescripheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-12">';
    echo '<label>Description ENG:</label>';
    echo "<textarea class='form-control' id='descripEng' name='descripEng' rows='3'>".$descripEngPost."</textarea>";
    echo '<label style="color:#dc3545;display:none" id="AutDescripheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-12">';
    echo '<label>Description IT:</label>';
    echo "<textarea class='form-control' id='descripIt' name='descripIt' rows='3'>".$descripItPost."</textarea>";
    echo '<label style="color:#dc3545;display:none" id="AutDescripheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-12">';
    echo '<label>Description FR:</label>';
    echo "<textarea class='form-control' id='descripFr' name='descripFr' rows='3'>".$descripFrPost."</textarea>";
    echo '<label style="color:#dc3545;display:none" id="AutDescripheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-12">';
    echo '<label>IMage:</label>';
    echo "<input class='form-control' id='img' name='img' value='".$imgPost."'>";
    echo '<label style="color:#dc3545;display:none" id="AutDescripheck">* Missing data</label>';
    echo '</div>';

    echo "</form>";