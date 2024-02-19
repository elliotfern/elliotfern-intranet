<script type="module">
    authorsTableLibrary();
</script>

<h1>Library database</h1>
<h2>Authors</h2>

<p><button type='button' class='btn btn-outline-secondary' id='btnCreateLink' onclick='inserirLlibre()'>Afegir nou llibre &rarr;</button>

<button type='button' class='btn btn-outline-success' id='btnCreateLink' onclick='inserirAutor()'>Afegir nou autor &rarr;</button>
</p>
        
<hr>

    <div class="table-responsive">
            <table class="table table-striped" id="authorsTable">
                <thead class="table-primary">
                <tr>
                    <th></th>
                    <th>Author <?php echo TABLE_COLUMN_ROW;?></th>
                    <th>Country</th>
                    <th>Profession</th>
                    <th>Years</th>
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