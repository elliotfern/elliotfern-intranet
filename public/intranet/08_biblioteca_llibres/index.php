<div class="container">

<div class="barraNavegacio">
    <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>">Biblioteca</a></h6>
  </div>

    <main>
        <div class="container contingut">

            <h1>Biblioteca de llibres</h1>
            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['biblioteca']; ?>/nou-llibre/'" class="button btn-gran btn-secondari">Afegir llibre</button>

                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir autor/a</button>
            </p>

            <div class="alert alert-success quadre">
                <ul class="llistat">
                    <li> <a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>/llistat-llibres">Llistat de llibres</a></li>
                    <li><a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>/llistat-autors">Llistat d'autors/es</a></li>

                </ul>
            </div>

        </div>
    </main>
</div>