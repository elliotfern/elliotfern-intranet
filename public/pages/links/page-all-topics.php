<script>
    allTopicsList();
    btnCreateLink();
</script>

<h2>Enllaços > Tots els temes</h2>
<h6><a href="/adreces">Links</a> > <a href="/adreces/topics">Topics</a></h6>

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
# footer
require_once(APP_ROOT . '/public/php/footer.php');