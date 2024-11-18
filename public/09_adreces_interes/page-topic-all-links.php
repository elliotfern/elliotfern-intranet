<?php
if (isset($_GET['id']) ) {
    $id = $_GET['id'];
}
$id = $params['id'];
?>

<script>
    categoriaAllLinksByTopic('<?php echo $id; ?>');

    function refreshTable(id) {
        // Llama a tu función para obtener y mostrar la tabla actualizada
        categoriaAllLinksByTopic(id);
}

// LINKS 

// AJAX PROCESS > PHP - MODAL FORM - CREATE NEW LINK
$(function () {
    $("#btnAddLink").click(function () {
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

// LINKS

// AJAX PROCESS > PHP - MODAL FORM - UPDATE LINK
function btnUpdateLink(event) {
    console.log("clic en la funcion de actualizar link")
    // Stop form from submitting normally
    event.preventDefault();
    let urlAjax = devDirectory + "/api/links/put";
    console.log(urlAjax)
    $.ajax({
        type: "POST",
        url: urlAjax,
        data: {
            id: $("#id").val(),
            nom: $("#nom").val(),
            web: $("#web").val(),
            cat: $("#catTopicsLinks").val(),
            lang: $("#lang").val(),
            tipus: $("#tipusLinks").val(),
        },
        success: function (response) {
            console.log(response)
            if (response.status == "success") {
                // Add response in Modal body
                $("#updateLinkMessageOk").show();
                $("#updateLinkMessageErr").hide();
                $("#botoSave").hide();
            } else {
                $("#updateLinkMessageErr").show();
                $("#updateLinkMessageOk").hide();
            }
        },
    });
}

</script>

<h6><a href="<?php echo APP_DEV;?>/links">Links</a> > <a href="<?php echo APP_DEV;?>/links/topics">Topics </a></h6>
<h2 id="titolTopic"></h2>
<h4 id="titolTopicCategoria"></h4>

<a href="<?php APP_WEB;?>/adreces/new" class="btn btn-warning btn-sm">Add link &rarr;</a>

<hr>
<!-- Botón para refrescar la tabla -->
<button onclick="refreshTable('<?php echo $id; ?>')">Refrescar Tabla</button>

<div class="table-responsive">
   <table class="table table-striped" id="topicsLinks">
     <thead class="table-primary">
                <tr>
                <th>Link &darr;</th>
                <th>Language</th>
                <th>Type</th>
                <th></th>
                <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
</div>
<div id="pagination"></div>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');