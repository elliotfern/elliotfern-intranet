<div class="container">

    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">
            <h1>Gestió de clients</h1>
            <div id="isAdminButton" style="display: none;">
                <?php if (isUserAdmin()) { ?>
                    <p>
                        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['clients']; ?>/nou-client/'" class="button btn-gran btn-secondari">Afegir client</button>
                    </p>

                    <div class="alert alert-success quadre">
                        <ul class="llistat">
                        </ul>
                    </div>

                <?php } else {
                    // Código que se ejecuta si la condición es falsa (opcional)
                } ?>

            </div>
    </main>
</div>