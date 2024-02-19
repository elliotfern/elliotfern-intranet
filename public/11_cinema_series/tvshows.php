<?php

echo '<h1>Cinema & TV shows Database</h1>';
echo '<h2>TV shows</h2>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddtvshow' onclick='btnFAddTVShow()' data-bs-toggle='modal' data-bs-target='#modalCreateTVShow'>Create tv show</button></p>";

echo "<hr>";

?>
<div class="table-responsive">
            <table class="table table-striped" id="tvshowTable">
                <thead class="table-primary">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Years</th>
                    <th>Producer</th>
                    <th>Country</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
</div>
</div>
<?php

?>
<script>
$(document).ready(function(){
    loadTableTVShows();
});
</script>

<?php

# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');