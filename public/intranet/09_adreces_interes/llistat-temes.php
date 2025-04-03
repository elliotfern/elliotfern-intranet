<div class="container">
    <main>
        <div class="container">
            <h1>Adreces d'interés: llistat de temes</h1>
            <h6><a href="<?php echo APP_INTRANET . $url['adreces']; ?>">Adreces</a> > Llistat temes </h6>
            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['adreces']; ?>/nou-link/'" class="button btn-gran btn-secondari">Afegir enllaç</button>

            </p>

            <div class="table-responsive">
                <table class="table table-striped" id="allTopicsList">
                    <thead class="table-primary">
                        <tr>
                            <th>Tema &darr;</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
        </div>
    </main>
</div>

<script>
    allTopicsList();

    async function allTopicsList() {
        const urlAjax = "/api/adreces/get/?type=all-topics";

        try {
            // Realizar la solicitud fetch
            const response = await fetch(urlAjax, {
                method: 'GET',
            });

            // Verificar si la respuesta es exitosa
            if (!response.ok) {
                throw new Error('Error al realizar la solicitud');
            }

            const data = await response.json();

            let html = '';
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';

                html += '<td><a href="./tema/' + data[i].idTema + '">' + data[i].tema + '</a></td>';

                html += '<td><a href="./categoria/' + data[i].idGenre + '">' + data[i].genre + '</a></td>';

                html += '</tr>';
            }

            // Inyectar el contenido HTML en el DOM
            document.querySelector('#allTopicsList tbody').innerHTML = html;

        } catch (error) {
            console.error('Error al realizar la solicitud o al procesar los datos:', error);
        }
    }
</script>