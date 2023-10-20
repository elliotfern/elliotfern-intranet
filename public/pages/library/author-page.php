<?php
$slug = $params['slug'];
?>

<script type="module">
    authorPageInfoLibrary('<?php echo $slug; ?>')
</script>

<div class="container">
<h1>Library database</h1>
<h2 id="authorName"></h2>

<div class='row'>
      <div class='col-sm-8'>
         <img id="authorPhoto" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Author Photo' title='Author photo'>
        </div>
        
        <div class="col-sm-4">
            <a href="update/<?php echo $slug; ?>"><button type="button" id="btnUpdateAuthor" class="btn btn-sm btn-warning">Update author</button></a>
        
                <div class="alert alert-primary" role="alert" style="margin-top:10px">
                    <strong><p id="authorYearBirth"><?php echo LIBRARY_YEAR_BIRTH;?>: </p></strong>

                    <p id="authorDescrip"> </p>

                    <p><strong><?php echo COUNTRY;?>: </strong> <a id="linkAuthor" href='' title='Country'><span id="authorCountry"></span></a></p>
                      
                    <p><strong><?php echo LIBRARY_PROFESSION;?>: </strong><span id="authorprofession"></span></p>

                    <p><strong><?php echo LIBRARY_MOVEMENT; ?>: </strong><a id="linkMovement" href='' title='Movement'><span id="authorMovement"></span></a></p>

                    <p><strong><?php echo LIBRARY_WIKIPEDIA;?>: </strong><a id="authorWeb" href='' target='_blank' title='Wikipedia'>Web</a></p>

                    <p><strong><?php echo CREATED_DATE;?>: </strong><span id="authorCreated"></span></p>
                      
                    <p><strong><?php echo UPDATED_DATE;?>: </strong><span id="authorUpdated"></span></p>
                </div>
        </div>
    </div>

    <hr>

    <h4>Author works</h4>

<div class="table-responsive">
            <table class="table table-striped" id="booksAuthor">
                <thead class="table-primary">
                <tr>
                    <th>Work</th>
                    <th>Publication year <?php echo TABLE_COLUMN_ROW;?></th>
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