<h2>La meva biblioteca</h2>

<p><button type='button' class='btn btn-outline-secondary' id='btnCreateLink' onclick='inserirLlibre()'>Afegir nou llibre &rarr;</button>

<button type='button' class='btn btn-outline-success' id='btnCreateLink' onclick='inserirAutor()'>Afegir nou autor &rarr;</button>
</p>

<div class="alert alert-success" role="alert">
    <ul>
        <li> <a href="<?php echo APP_DEV .'/biblioteca/llibres';?>">Col·lecció de llibres</a></li>
        <li><a href="<?php echo APP_DEV .'/biblioteca/autors';?>">Col·lecció d'autors/es</a></li>
    
</ul>
</div>

<?php
# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');