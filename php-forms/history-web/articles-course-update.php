<?php
# conectare la base de datos
include_once('../../inc/connection.php');
include_once('../../inc/functions.php');

if (isset($_POST['idWP'])) {
    $id = $_POST['idWP'];
} else {
    $id = $_POST['idWP'];
}

$article = selectSingleCourseArticleWP($id);
    $wpCatPost = $article['wpCat']; 
    $wpCastPost = $article['wpCast'];
    $wpEngPost = $article['wpEng'];
    $wpItPost = $article['wpIt'];
    $wpFrPost = $article['wpFr'];
    $cursIdPost = $article['cursId'];
    $ordrePost = $article['ordre'];
    $idBiblPost = $article['idBibl'];

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="updateArticleCourseMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="updateArticleCourseMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormArticleCourse" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';
    echo '<input type="hidden" id="id" name="id" value="'.$id.'">';

    echo '<div class="col-md-4">';
    echo '<label>Order:</label>';
    echo '<input class="form-control" type="url" name="ordre" id="ordre" value="'.$ordrePost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Topic bibliography:</label>';
    echo '<select class="form-select" name="idBibl" id="idBibl">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT t.id, t.topic
    FROM db_topics AS t
    WHERE t.idGenere = 1
    ORDER BY t.topic ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idT = $row['id'];
            $topic = $row['topic'];
            if ($idBiblPost == $idT) {
                echo "<option value='".$idBiblPost."' selected>".$topic."</option>"; 
              } else {
                echo "<option value='".$idT."'>".$topic."</option>";
              }
      }
    echo '</select>
    </div>';

    echo "<hr>";
    echo "<h4>WP pages</h4>";

    echo '<div class="col-md-4">';
    echo '<label>WP Catalan:</label>';
    echo '<select class="form-select" name="wpCat" id="wpCat">';
    echo '<option disabled>Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.ID, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 1 AND (l.type = 3 OR l.type = 2)
    ORDER BY p.ID ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idCat = $row['ID'];
            $post_title = $row['post_title'];
            if ($wpCatPost == $idCat) {
                echo "<option value='".$wpCatPost."' selected>".$idCat." - ".$post_title."</option>"; 
              } else {
                echo "<option value='".$idCat."'>".$idCat." - ".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';

    echo '<div class="col-md-4">';
    echo '<label>WP English:</label>';
    echo '<select class="form-select" name="wpEng" id="wpEng">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.ID, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 2 AND (l.type = 3 OR l.type = 2)
    ORDER BY p.ID ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idEng = $row['ID'];
            $post_title = $row['post_title'];
            if ($wpEngPost == $idEng) {
                echo "<option value='".$wpEngPost."' selected>".$idEng." - ".$post_title."</option>"; 
              } else {
                echo "<option value='".$idEng."'>".$idEng." - ".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';

    echo '<div class="col-md-4">';
    echo '<label>WP Spanish:</label>';
    echo '<select class="form-select" name="wpCast" id="wpCast">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.ID, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 3 AND (l.type = 3 OR l.type = 2)
    ORDER BY p.ID ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idCast = $row['ID'];
            $post_title = $row['post_title'];
            if ($wpCastPost == $idCast) {
                echo "<option value='".$wpCastPost."' selected>".$idCast." - ".$post_title."</option>"; 
              } else {
                echo "<option value='".$idCast."'>".$idCast." - ".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';

    echo '<div class="col-md-4">';
    echo '<label>WP Italian:</label>';
    echo '<select class="form-select" name="wpIt" id="wpIt">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.ID, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 4 AND (l.type = 3 OR l.type = 2)
    ORDER BY p.ID ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idIt = $row['ID'];
            $post_title = $row['post_title'];
            if ($wpItPost == $idIt) {
                echo "<option value='".$wpItPost."' selected>".$idIt." - ".$post_title."</option>"; 
              } else {
                echo "<option value='".$idIt."'>".$idIt." - ".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';

    echo '<div class="col-md-4">';
    echo '<label>WP French:</label>';
    echo '<select class="form-select" name="wpFr" id="wpFr">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT p.ID, p.post_title
    FROM kvqphwff_web.xfr_posts AS p
    INNER JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
    WHERE l.lang = 7 AND (l.type = 3 OR l.type = 2)
    ORDER BY p.ID ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idFr = $row['ID'];
            $post_title = $row['post_title'];
            if ($wpFrPost == $idFr) {
                echo "<option value='".$wpFrPost."' selected>".$idFr." - ".$post_title."</option>"; 
              } else {
                echo "<option value='".$idFr."'>".$idFr." - ".$post_title."</option>";
              }
      }
    echo '</select>
    </div>';
    
    echo "<hr>";
    echo "<h4>Course</h4>";

    echo '<div class="col-md-4">';
    echo '<label>Course:</label>';
    echo '<select class="form-select" name="cursId" id="cursId">';
    echo '<option value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT c.id, c.nameEng
    FROM db_openhistory_courses AS c
    ORDER BY c.ordre ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idCourse = $row['id'];
            $nameEng = $row['nameEng'];
            if ($cursIdPost == $idCourse) {
                echo "<option value='".$cursIdPost."' selected>".$nameEng."</option>"; 
              } else {
                echo "<option value='".$idCourse."'>".$nameEng."</option>";
              }
      }
    echo '</select>
    </div>';

    echo "</form>";