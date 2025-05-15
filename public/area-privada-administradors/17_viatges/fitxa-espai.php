<?php
$slug = $routeParams[0];
?>

<div class="container">
    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">
            <h1>Viatges</h1>
            <h2><span id="titolPagina"></span></h2>

            <div id="isAdminButton" style="display: none;">
                <?php if (isset($_COOKIE['user_id']) && $_COOKIE['user_id'] === '1') : ?>
                    <p>
                        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/modifica-espai/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica fitxa</button>
                    </p>
                <?php endif; ?>
            </div>

            <div class="dadesFitxa" id="dadesFitxa"></div>

            <div id="dadesContainer"></div>

            <div id="dadesDescripcio"></div>

            <!-- Contenedor del mapa -->
            <div id="dadesMapa" style="width: 100%; height:500px;"></div>

            <hr>
            <h4>Visites realitzades en aquest espai:</h4>

            <div id="taulaLlistatVisites"></div>

        </div>
    </main>
</div>