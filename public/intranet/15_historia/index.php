<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['historia']; ?>">Base de dades Història</a></h6>
    </div>

    <main>
        <div class="container contingut">

            <h1>Base de dades d'Història</h1>
            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['historia']; ?>/nou-llibre/'" class="button btn-gran btn-secondari">Afegir esdeveniment</button>

                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir persona</button>
            </p>

            <div class="alert alert-success quadre">
                <ul class="llistat">
                    <li> <a href="<?php echo APP_INTRANET . $url['persones']; ?>/llistat-persones">Llistat de persones</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['historia']; ?>/llistat-organitzacions">Llistat d'organitzacions</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['historia']; ?>/llistat-esdeveniments">Llistat d'esdeveniments</a></li>
                </ul>
            </div>

        </div>
    </main>
</div>