<?php
# conectare la base de datos
include_once('../../inc/connection.php');
$idBook = $_POST['idBook'];

// some action goes here under php
    echo '<div class="container-fluid">';
          
    echo '<div class="alert alert-success" id="addCollectionBookMessageOk" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
    echo '<div class="alert alert-danger" id="addCollectionBookMessageErr" style="display:none;margin-top:20px" role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>';

    echo '<form method="POST" action="" id="addCollectionBookForm" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';
    echo '<input type="hidden" id="idBook" name="idBook" value="'.$idBook.'">';

    echo ' <div class="row">';
    echo '<div class="col-md-6">';
    echo '<label>Collection:</label>';
    echo '<select name="idCollection" id="idCollection">';
    echo '<option disabled>Select a collection:</option>';
    $stmt = $conn->prepare("SELECT id, nomCollection 	
    FROM db_library_collection
    ORDER BY nomCollection ASC;");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
        foreach($data as $row){
            $idColl = $row['id'];
            $nomCollection = $row['nomCollection']; 
            echo "<option value=".$idColl.">".$nomCollection."</option>"; 
        }
    echo '</select>';
    echo '<label style="color:#dc3545;display:none" id="nomAutorErr">* Author name is missing</label>';
    echo "<span style='margin-top:15px'> <a href='#' title='New collection' onclick='divCreateNewCollection();return false;'>Need to create new collection?</a></span>
          <div id='createNewCollection'> </div>";
    echo "</div>";

    echo '<div class="col-md-6 separador">';
    echo '<label>Order:</label>';
    echo '<input class="form-control" type="text" name="ordre" id="ordre">';
    echo '<label style="color:#dc3545;display:none" id="anyErr">* Year is missing</label>';
    echo "</div>";
    echo "</div>";
 
   echo "</form>";

   ?>
   <script>
   $(function() {
    $('#idCollection').selectize({
      create: true,
      preload: true,
      valueField: 'id',
      labelField: 'text',
      searchField: 'text',                  
    });
});
</script>