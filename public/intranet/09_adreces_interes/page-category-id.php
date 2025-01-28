<?php
if (isset($_GET['id']) ) {
    $id = $_GET['id'];
}

$id = $params['id'];
?>

<script>
    categoriaAllTopics('<?php echo $id; ?>');
    btnCreateLink();
</script>

<h6><a href="<?php echo APP_DEV;?>/links">Links</a> > <a href="<?php echo APP_DEV;?>/links/categories">Categories </a></h6>
<h2 id="titolCategoria"></h2>

<p><button type="button" class="btn btn-warning btn-sm" id="btnCreateLink" data-bs-toggle="modal" data-bs-target="#modalCreateLink">Add link &rarr;</button>

<div class="table-responsive">
            <table class="table table-striped" id="categoriaLinks">
                <thead class="table-primary">
                <tr>
                <th>Topic</th>
                <th>Actions</th> 
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        
<?php

# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');