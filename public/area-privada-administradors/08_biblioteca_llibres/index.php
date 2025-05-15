<div class="container">

    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">

            <h1>Biblioteca de llibres</h1>

            <div id="isAdminButton" style="display: none;">
                <?php if (isset($_COOKIE['user_id']) && $_COOKIE['user_id'] === '1') : ?>
                    <p>
                        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['biblioteca']; ?>/nou-llibre/'" class="button btn-gran btn-secondari">Afegir llibre</button>

                        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir autor/a</button>
                    </p>
                <?php endif; ?>
            </div>

            <div class="alert alert-success quadre">
                <ul class="llistat">
                    <li> <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>/llistat-llibres">Llistat de llibres</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>/llistat-autors">Llistat d'autors/es</a></li>
                </ul>
            </div>

        </div>
    </main>
</div>