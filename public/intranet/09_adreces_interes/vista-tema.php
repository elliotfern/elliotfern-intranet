<?php
if (isset($routeParams[0])) {
    $id = $routeParams[0];
}

?>

<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['adreces']; ?>">Adreces d'interès</a> > <a href="<?php echo APP_INTRANET . $url['adreces']; ?>/llistat-temes">Llistat de temes</a></h6>
    </div>

    <main>
        <div class="container">
            <h1>Adreces d'interés</h1>
            <h2 id="titolTopic"></h2>
            <h4 id="titolTopicCategoria"></h4>
            <p>
                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['adreces']; ?>/nou-link/'" class="button btn-gran btn-secondari">Afegir enllaç</button>

            </p>


            <!-- Botón para refrescar la tabla -->
            <button onclick="refreshTable('<?php echo $id; ?>')">Refrescar Tabla</button>

            <div class="table-responsive">
                <table class="table table-striped" id="topicsLinks">
                    <thead class="table-primary">
                        <tr>
                            <th>Enllaç &darr;</th>
                            <th>Idioma</th>
                            <th>Tipus</th>
                            <th>Data creació</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

            </div>
            <div id="pagination"></div>


        </div>
    </main>
</div>

<script>
    categoriaAllLinksByTopic('<?php echo $id; ?>');

    function refreshTable(id) {
        // Llama a tu función para obtener y mostrar la tabla actualizada
        categoriaAllLinksByTopic(id);
    }

    function formatDate(dateString) {
        const date = new Date(dateString); // Crear un objeto Date con la cadena de fecha
        const day = String(date.getDate()).padStart(2, '0'); // Obtener el día con 2 dígitos
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Obtener el mes (añadir 1 porque los meses empiezan desde 0)
        const year = date.getFullYear(); // Obtener el año

        return `${day}-${month}-${year}`; // Retornar la fecha en formato DD-MM-YYYY
    }

    async function categoriaAllLinksByTopic(idTopic, page = 1, itemsPerPage = 10) {
        const urlAjax = `/api/adreces/get/?type=topic&id=${idTopic}&page=${page}&itemsPerPage=${itemsPerPage}`;

        try {
            const response = await fetch(urlAjax, {
                method: "GET",
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();
            if (!data.length) {
                console.warn("No data received");
                return;
            }

            const totalPages = Math.ceil(data[0].total_count / itemsPerPage);

            document.getElementById('titolTopic').innerHTML = `Tema: ${data[0].tema}`;
            document.getElementById('titolTopicCategoria').innerHTML = `Categoria: <a href="../categoria/${data[0].idCategoria}">${data[0].genre}</a>`;



            let html = data.map(link => {
                // Formatear la fecha de cada link
                const formattedDate = formatDate(link.dateCreated);
                return `
            <tr>
                <td><a href="${link.url}" target="_blank">${link.nom}</a></td>

                <td>${link.idioma_ca}</td>

                <td>${link.type_ca}</td>

                <td>${formattedDate}</td>

                <td><a class="button btn-petit" href="https://${window.location.host}/gestio/adreces/modifica-link/${link.linkId}" role="button">Modifica</a></td>

                <td><a class="button btn-petit" href="../modifica-link/${link.linkId}" role="button">Elimina</a></td>
            </tr>
       `;
            }).join('');

            document.querySelector('#topicsLinks tbody').innerHTML = html;

            createPaginationLinks(page, totalPages, idTopic);

        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Función para crear los enlaces de paginación
    function createPaginationLinks(currentPage, totalPages, idTopic) {
        const paginationContainer = document.getElementById('pagination');
        paginationContainer.innerHTML = '';

        for (let i = 1; i <= totalPages; i++) {
            const pageLink = document.createElement('a');
            pageLink.href = '#';
            pageLink.textContent = i;
            pageLink.classList.toggle('current-page', i === currentPage);

            pageLink.addEventListener('click', (event) => {
                event.preventDefault();
                categoriaAllLinksByTopic(idTopic, i);
            });

            paginationContainer.appendChild(pageLink);
        }
    }
</script>