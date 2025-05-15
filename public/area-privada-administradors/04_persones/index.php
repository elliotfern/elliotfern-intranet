<div class="container">

    <div id="barraNavegacioContenidor"></div>

    <main>
        <div class="container contingut">

            <h1>Base de dades: Persones</h1>

            <?php if (isUserAdmin()) : ?>
                <p>
                    <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir autor</button>
                </p>
            <?php endif; ?>

            <div id="taulaLlistatPersones"></div>

        </div>
    </main>
</div>