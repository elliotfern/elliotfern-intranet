<script type="module">
    authorsTableLibrary();
</script>

<h1>Cinema & TV shows Database</h1>
<h2>Directors</h2>

<p><button type='button' class='btn btn-dark btn-sm' id='btnAddActor' onclick='btnFAddActor()' data-bs-toggle='modal' data-bs-target='#modalCreateActor'>Create new Actor</button></p>


<hr>

<div class="">
    <table class="table table-striped datatable" id="actorsTable">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Anys</th>
                <th>Pais</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody> <!-- Agregado este tbody -->
        </tbody>
    </table>
</div>

</div>
</div>

<script>
    function authorsTableLibrary() {
        const urlAjax = `https://${window.location.host}/api/cinema/get/?directors`;

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
              <a id="${author.id}" title="Author page" href="./autor/fitxa/${author.slug}">
                <img src="https://media.elliot.cat/img/library-author/${author.nameImg}.jpg" style="height:70px">
              </a>
            </td>
            <td>
              <a id="${author.id}" title="Author page" href="./fitxa-autor/${author.slug}">
                ${author.nom} ${author.cognoms}
              </a>
            </td>
            <td>
              <a id="${author.idCountry}" title="Authors by country" href="./by-country/${author.idCountry}">
                ${author.country}
              </a>
            </td>
            <td>
              <a id="${author.idProfession}" title="Authors by profession" href="./by-profession/${author.idProfession}">
                ${author.profession}
              </a>
            </td>
            <td>
             ${!author.yearDie ? author.yearBorn : `${author.yearBorn} - ${author.yearDie}`}
            </td>
            <td>
              <a href="./modifica/autor/${author.id}">
                <button type="button" class="btn btn-sm btn-warning">Modifica</button>
              </a>
            </td>
            <td>
              <button type="button" class="btn btn-sm btn-danger">Elimina</button>
            </td>
          </tr>`;
                    });

                    const tableBody = document.querySelector('#actorsTable tbody');
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