<script>
    allTopicsList();
    btnCreateLink();
</script>

<div class="container">
<h2>Topics list</h2>
<h6><a href="<?php echo APP_DEV;?>/links">Links</a> > <a href="<?php echo APP_DEV;?>/links/topics">Topics </a></h6>

<p><button type="button" class="btn btn-warning btn-sm" id="btnCreateLink" data-bs-toggle="modal" data-bs-target="#modalCreateLink">Add link &rarr;</button>

        <div class="table-responsive">
            <table class="table table-striped" id="allTopicsList">
                <thead class="table-primary">
                <tr>
                <th>Topic &darr;</th>
                <th>Category</th>
                <th></th>
                <th></th> 
                </tr>
                </thead>
            <tbody></tbody>
        </table>

</div>

<?php
include_once('modals-links.php');

# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');