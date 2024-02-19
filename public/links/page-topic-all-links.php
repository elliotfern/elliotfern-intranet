<?php
if (isset($_GET['id']) ) {
    $id = $_GET['id'];
}
$id = $params['id'];
?>

<script>
    btnCreateLink();
    categoriaAllLinksByTopic('<?php echo $id; ?>');

    function refreshTable(id) {
        // Llama a tu función para obtener y mostrar la tabla actualizada
        categoriaAllLinksByTopic(id);
}

</script>

<h6><a href="<?php echo APP_DEV;?>/links">Links</a> > <a href="<?php echo APP_DEV;?>/links/topics">Topics </a></h6>
<h2 id="titolTopic"></h2>
<h4 id="titolTopicCategoria"></h4>

<p><button type="button" class="btn btn-warning btn-sm" id="btnCreateLink" data-bs-toggle="modal" data-bs-target="#modalCreateLink">Add link &rarr;</button>

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
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');