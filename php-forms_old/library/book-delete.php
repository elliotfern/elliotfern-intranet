<?php
# conectare la base de datos
include_once('../../inc/connection.php');

if (isset($_POST['idBook'])) { //if idBook exists
    $id = $_POST['idBook'];

    $stmt = $conn->prepare("SELECT book.titol
    FROM db_library_books AS book
    WHERE book.id = :id");
    $stmt->execute(['id' => $id]); 
    $data = $stmt->fetchAll();
    
    // and somewhere later:
    foreach ($data as $row) {
        $titolPost = $row['titol']; 
    }
        // some action goes here under php
        echo '<div class="container-fluid">';
                echo '<div class="alert alert-success show_conversation" style="display:none; role="alert">
                <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
                <h6>'.ADD_OK_MESSAGE.'</h6>
                </div>';

                echo '<div class="alert alert-danger show_conversation2" style="display:none; role="alert">
                <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
                <h6>'.ERROR_TYPE_MESSAGE.'</h6>
                </div>';
                
                echo '<form method="POST" action="" id="modalFormDelete" class="row g-3" style="'.FORM_BACKGROUND_COLOR.'">';

                echo '<h3>Book: <em>"'.$titolPost.'"</em></h3>
                <h4>Are you sure you want to delete this book?</h4>';
                echo "<h6>* Warning: this action can not be undone.</h6>";
                
                echo '<input type="hidden" id="idBook" name="idBook" value="'.$id.'">';
                
                echo'</form>
                </div>';

    } else {
        echo '<div class="alert alert-success show_conversation" style="display:none; role="alert">
                <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
                <h6>'.ADD_OK_MESSAGE.'</h6>
                </div>';
    }

?>

