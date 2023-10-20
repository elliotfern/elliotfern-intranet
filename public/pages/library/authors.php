<script type="module">
    authorsTableLibrary();
</script>

<div class="container">
<h1>Library database</h1>
<h2>Authors</h2>

<p><a href="./new"><button type='button' class='btn btn-dark btn-sm' id='btnAddBook'> <?php echo LIBRARY_BOOKS_ADD;?></button></a></p>

<p><a href="./new"><button type='button' class='btn btn-dark btn-sm' id='btnAddAuthor2'> <?php echo LIBRARY_AUTHORS_ADD;?></button></a></p>
        

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
    
</div>

<?php
# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');