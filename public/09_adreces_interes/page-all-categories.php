<script type="module">
    categoriesLinks();
    btnCreateLink();
</script>

<h2>Categories links list</h2>
<h6><a href="<?php echo APP_DEV;?>/links">Links</a> > <a href="<?php echo APP_DEV;?>/links/categories">Categories </a></h6>

<p><button type="button" class="btn btn-warning btn-sm" id="btnCreateLink" data-bs-toggle="modal" data-bs-target="#modalCreateLink">Add link &rarr;</button>

        <div class="table-responsive">
            <table class="table table-striped" id="categoriesLinks">
                <thead class="table-primary">
                <tr>
                <th>Category</th>
                <th>Actions</th> 
                </tr>
            </thead>
            <tbody></tbody>
        </table>


<?php

# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');