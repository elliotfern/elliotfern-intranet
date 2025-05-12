<div class="container">

  <div id="barraNavegacioContenidor"></div>

  <main>
    <div class="container contingut">
      <h1>Claus privades</h1>

      <?php if (isUserAdmin()) : ?>
        <p>
          <button onclick="window.location.href='<?php echo APP_INTRANET . $url['vault']; ?>/nova-clau/'" class="button btn-gran btn-secondari">Afegir clau</button>
        </p>
      <?php endif; ?>

      <div id="taulaLlistatVault"></div>

    </div>
  </main>
</div>