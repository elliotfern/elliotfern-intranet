<div class="container">

    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">
            <h1>Intranet</h1>
            <div id="isAdminButton" style="display: none;">
                <?php if (isUserAdmin()) { ?>
                    <p>

                    </p>

                    <div class="alert alert-success quadre">
                        <ul class="llistat">
                            <li></li>
                        </ul>
                    </div>

                <?php } else {
                    // Código que se ejecuta si la condición es falsa (opcional)
                } ?>

            </div>
    </main>
</div>