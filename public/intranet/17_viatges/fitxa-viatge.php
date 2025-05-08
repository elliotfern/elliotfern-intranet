<?php
$slug = $routeParams[0];
?>

<div class="container">
    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['viatges']; ?>">Viatges</a></h6>
    </div>

    <main>
        <div class="container contingut">
            <h1>Fitxa viatge</h1>

            <p><button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/modifica-viatge/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica viatge</button>

                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/nou-espai'" class="button btn-gran btn-secondari">Afegeix espai</button>
            </p>

            <div id="taulaLlistatEspaisViatge"></div>

        </div>
    </main>
</div>