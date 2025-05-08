<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['viatges']; ?>">Viatges</a></h6>
    </div>

    <main>
        <div class="container contingut">
            <h1>Viatges</h1>
            <h2>Llistat de viatges</h2>
            <p><button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/nou-viatge'" class="button btn-gran btn-secondari">Nou viatge</button></p>

            <div id="taulaLlistatViatges"></div>

        </div>
    </main>
</div>