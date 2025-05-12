<div class="container">

    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">
            <h1>Arts escèniques, cinema i televisió</h1>

            <div id="isAdminButton" style="display: none;">
                <?php if (isUserAdmin()) : ?>
                    <p>
                        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['cinema']; ?>/nova-pelicula/'" class="button btn-gran btn-secondari">Afegir pel·lícula</button>

                        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['cinema']; ?>/nova-serie/'" class="button btn-gran btn-secondari">Afegir sèrie tv</button>

                        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['cinema']; ?>/nova-obra-teatre/'" class="button btn-gran btn-secondari">Afegir obra de teatre</button>

                        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir actor/a o director/a</button>
                    </p>
                <?php endif; ?>
            </div>

            <div class="alert alert-success quadre">
                <ul class="llistat">
                    <li><a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-pelicules">Llistat de pel·lícules</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-series">Llistat de sèries de televisió</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-obres-teatre">Llistat d'obres de teatre</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-actors">Llistat d'actors/es</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-directors">Llistat de directors/es</a></li>
                </ul>
            </div>

        </div>
    </main>
</div>