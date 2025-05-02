<script type="module">
    authorsTableLibrary();
</script>

<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['historia']; ?>">Base de dades Història</a> > <a href="<?php echo APP_INTRANET . $url['historia']; ?>/llistat-organitzacions">Llistat d'organitzacions</a> </h6>
    </div>

    <main>
        <div class="container contingut">

            <h1>Base de dades d'Història: llistat d'organitzacions</h1>

            <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir autor</button>

            <div class="table-responsive">
                <table class="table table-striped" id="authorsTable">
                    <thead class="table-primary">
                        <tr>
                            <th></th>
                            <th>Autor/a</th>
                            <th>País</th>
                            <th>Professió</th>
                            <th>Anys</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>
    </main>
</div>

<script>
    function authorsTableLibrary() {
        const urlAjax = `https://${window.location.host}/api/biblioteca/get/?type=totsAutors`;

        fetch(urlAjax)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                try {
                    let html = '';
                    data.forEach(author => {
                        html += `<tr>
            <td class="text-center">
              <a id="${author.id}" title="Author page" href="./fitxa-autor/${author.slug}">
                <img src="https://media.elliot.cat/img/biblioteca-autor/${author.nameImg}.jpg" style="height:70px">
              </a>
            </td>
            <td>
              <a id="${author.id}" title="Author page" href="./fitxa-autor/${author.slug}">
                ${author.AutNom} ${author.AutCognom1}
              </a>
            </td>
            <td>
                ${author.country}
            </td>
            <td>
                ${author.profession}
            </td>
            <td>
             ${!author.yearDie ? author.yearBorn : `${author.yearBorn} - ${author.yearDie}`}
            </td>
            <td>
              <a href="https://${window.location.host}/gestio/persona/modifica-persona/${author.slug}">
                <button type="button" class="btn btn-sm btn-warning">Modifica</button>
              </a>
            </td>
            <td>
              <button type="button" class="btn btn-sm btn-danger">Elimina</button>
            </td>
          </tr>`;
                    });

                    const tableBody = document.querySelector('#authorsTable tbody');
                    if (tableBody) {
                        tableBody.innerHTML = html;
                    } else {
                        console.error("No se encontró el tbody de la tabla de autores.");
                    }
                } catch (error) {
                    console.error('Error al procesar los datos:', error);
                }
            })
            .catch(error => console.error('Error en la petición:', error));
    }
</script>