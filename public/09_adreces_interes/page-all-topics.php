<script>
    allTopicsList();
    </script>

<h2>Enllaços > Tots els temes</h2>
<h6><a href="/adreces">Links</a> > <a href="/adreces/topics">Topics</a></h6>


<a href="<?php APP_WEB;?>/adreces/new" class="btn btn-warning btn-sm">Add link &rarr;</a>


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
require_once(APP_ROOT . '/public/01_inici/footer.php');