<div class="container">

  <div class="barraNavegacio">
    <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['vault']; ?>">Claus privades</a></h6>
  </div>

  <main>
    <div class="container">
      <h1>Claus privades</h1>
      <p>
        <button onclick="window.location.href='<?php echo APP_INTRANET . $url['vault']; ?>/nova-clau/'" class="button btn-gran btn-secondari">Afegir clau</button>
      </p>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="table-primary">
            <tr>
              <th>Servei</th>
              <th>Usuari</th>
              <th>Contrasenya</th>
              <th>Tipus</th>
              <th>Modificada</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody> <!-- Aquí se agregarán las filas dinámicamente -->
          </tbody>
        </table>
      </div>

    </div>
  </main>
</div>

<script>
  function showPass(id) {
    let inputField = document.getElementById('passw-' + id);
    let urlAjax = '/api/vault/get/?id=' + id;

    if (inputField.type === "password") {
      fetch(urlAjax, {
          method: "GET",
          headers: {
            'Accept': 'application/json'
          }
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Error en la sol·licitud AJAX');
          }
          return response.json();
        })
        .then(data => {
          if (data.password) {
            inputField.value = data.password; // Mostrar la contraseña
            inputField.type = "text";

            // Copiar la contraseña al portapapeles
            navigator.clipboard.writeText(data.password).then(() => {
              console.log("Contraseña copiada al portapapeles");
            }).catch(err => {
              console.error("Error al copiar al portapapeles: ", err);
            });

            // Ocultar la contraseña después de 5 segundos
            setTimeout(() => {
              inputField.value = '**********'; // Volver al placeholder después de 5 segundos
              inputField.type = "password";
            }, 5000);
          } else {
            inputField.value = data.error; // Mostrar el error
            inputField.type = "text";
          }
        })
        .catch(error => {
          console.error('Error en la sol·licitud AJAX:', error);
          alert('Hubo un problema al intentar obtener la contraseña.');
        });
    }
  }
</script>