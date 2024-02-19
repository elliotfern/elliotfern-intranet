<?php
$slug = $params['slug'];
?>

<script type="module">
    bookInfoLibrary('<?php echo $slug; ?>')
</script>

    <h1>Library database</h1>
    <h2 id="titolBook"></h2>

    

        <div class="book-info">
            <p id="titolBook"></p>
        
        </div>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');