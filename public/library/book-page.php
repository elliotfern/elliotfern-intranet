<?php
$slug = $params['slug'];
?>

<script type="module">
    bookInfoLibrary('<?php echo $slug; ?>')
</script>

<div class="container">
    <h1>Library database</h1>
    <h2 id="titolBook"></h2>

    

        <div class="book-info">
            <p id="titolBook"></p>
        
        </div>

</div>

<?php
# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');