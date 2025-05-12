  <div class="container">

    <div id="barraNavegacioContenidor"></div>

    <main>
      <div class="container contingut">
        <h1>Agenda de contactes</h1>

        <?php if (isUserAdmin()) : ?>
          <p>
            <button onclick="window.location.href='<?php echo APP_INTRANET . $url['contactes']; ?>/nou-contacte/'" class="button btn-gran btn-secondari">Afegir contacte</button>
          </p>
        <?php endif; ?>

        <div id="taulaLlistatContactes"></div>

      </div>
    </main>
  </div>