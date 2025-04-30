<div class="container contingut">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['auxiliars']; ?>">Auxiliars</a></h6>
    </div>

    <main>
        <div class="container contingut">
            <h1>Taules auxiliars</h1>
            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['auxiliars']; ?>/nova-imatge/'" class="button btn-gran btn-secondari">Afegir imatge</button>

            </p>

            <div class="alert alert-success quadre">
                <ul class="llistat">
                    <li><a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-pelicules">Llistat d'imatges</a></li>
                </ul>
            </div>

        </div>
    </main>
</div>