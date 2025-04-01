<div class="container">
    <main>
        <div class="container">

            <h1>Biblioteca de llibres</h1>
            <h6><a href="<?php echo APP_INTRANET . $url['biblioteca']; ?>">Biblioteca</a> > Inici </h6>

            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['biblioteca']; ?>/nou-llibre/'" class="button btn-gran btn-secondari">Afegir llibre</button>

                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['biblioteca']; ?>/nou-autor/'" class="button btn-gran btn-secondari">Afegir autor/a</button>
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
<style>
    .llistat {
        list-style: none;
        padding: 0;
        margin: 0;
        text-align: left;
    }

    .quadre {
        width: 50%;
    }
</style>