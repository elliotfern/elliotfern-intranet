<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['viatges']; ?>">Viatges</a></h6>
    </div>

    <main>
        <div class="container contingut">
            <h1>Viatges</h1>

            <p><button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/nou-viatge'" class="button btn-gran btn-secondari">Nou viatge</button>

                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/nou-espai'" class="button btn-gran btn-secondari">Nou espai</button>
            </p>

            <div class="alert alert-success quadre">
                <ul class="llistat">
                    <li> <a href="<?php echo APP_INTRANET . $url['viatges']; ?>/llistat-viatges">Llistat de viatges</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['viatges']; ?>/llistat-espais">Llistat d'espais</a></li>
                </ul>
            </div>

        </div>
    </main>
</div>