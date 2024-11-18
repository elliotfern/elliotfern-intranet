<h6><a href="<?php echo APP_DEV;?>/links">Links</a> > <a href="<?php echo APP_DEV;?>/links/topics">Topics </a></h6>


<?php
# conectare la base de datos
global $conn;

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
    echo '<label>Nom enllaç</label>';
    echo '<input class="form-control" type="text" name="nom" id="nom">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>URL</label>';
    echo '<input class="form-control" type="text" name="web" id="web">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Tema:</label>';
    echo '<select class="form-select" name="cat" id="cat">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT t.id, 
       CONCAT(c.categoria_ca, ' - ', t.tema_ca) AS categoria_tema
        FROM epgylzqu_elliotfern_intranet.aux_temes AS t
        INNER JOIN epgylzqu_elliotfern_intranet.aux_categories AS c ON t.idGenere = c.id
        ORDER BY c.categoria_ca ASC;");
        $stmt->execute(); 
        $data = $stmt->fetchAll();
        foreach($data as $row) {
            $idTopic = $row['id'];
            $topic = $row['categoria_tema'];
            echo "<option value=".$idTopic.">".$topic."</option>"; 
        }
    echo '</select>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Idioma:</label>';
    echo '<select class="form-select" name="lang" id="lang">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT i.id, i.idioma_ca
    FROM epgylzqu_elliotfern_intranet.aux_idiomes AS i
    ORDER BY i.idioma_ca ASC");
    $stmt->execute(); 
    $data = $stmt->fetchAll();
    foreach($data as $row) {
        $id = $row['id'];
        $idioma_ca = $row['idioma_ca'];
        echo "<option value=".$id.">".$idioma_ca."</option>"; 
    }
echo '</select>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Tipus:</label>';
    echo '<select class="form-select" name="tipus" id="tipus">';
    echo '<option selected value="">Select an option:</option>';
    $stmt = $conn->prepare("SELECT t.id, t.type
        FROM epgylzqu_elliotfern_intranet.db_links_type AS t
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


echo '<button type="button" class="btn btn-primary" id="btnAddLink2">Add Link</button>
</form>';

?>
<script>

// AJAX PROCESS > PHP - MODAL FORM - CREATE NEW LINK
$(function () {
    $("#btnAddLink2").click(function () {
        // check values
        $("#createLinkMessageErr").hide();

        // Stop form from submitting normally
        event.preventDefault();
        let urlAjax = devDirectory + "/api/links/post";

        $.ajax({
            type: "POST",
            url: urlAjax,
            data: {
                nom: $("#nom").val(),
                web: $("#web").val(),
                cat: $("#cat").val(),
                lang: $("#lang").val(),
                tipus: $("#tipus").val(),
                linkCreated: $("#linkCreated").val(),
            },
            success: function (response) {
                if (response.status == "success") {
                    // Add response in Modal body
                    $("#createLinkMessageOk").show();
                    $("#createLinkMessageErr").hide();
                    // Reset the form fields
                    $("#bodyModalNewLink").trigger("reset");
                } else {
                    $("#createLinkMessageErr").show();
                    $("#createLinkMessageOk").hide();
                }

                // Hide the messages after 5 seconds
                setTimeout(function () {
                    $("#createLinkMessageOk").hide();
                    $("#createLinkMessageErr").hide();
                }, 5000);  // 5000 milliseconds = 5 seconds

            },
        });
    });
});

</script>