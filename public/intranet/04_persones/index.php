<script type="module">
    authorsTableLibrary();
</script>

<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['persona']; ?>">Base de dades: Persones</a></h6>
    </div>

    <main>
        <div class="container contingut">

            <h1>Base de dades: Persones</h1>

            <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/nova-persona/'" class="button btn-gran btn-secondari">Afegir autor</button>

            <div class="filter-buttons" style="margin-top:20px">
                <button class="filter-btn" id="filter-1" onclick="filterByGroup(1)">Biblioteca: autors/es</button>
                <button class="filter-btn" id="filter-2" onclick="filterByGroup(2)">Cinema: Directors/es</button>
                <button class="filter-btn" id="filter-3" onclick="filterByGroup(3)">Cinema: Actors</button>
                <button class="filter-btn" id="filter-4" onclick="filterByGroup(4)">Història: personatge</button>
                <button class="filter-btn" id="filter-4" onclick="filterByGroup(5)">Història: polític</button>
                <button class="filter-btn" id="filter-all" onclick="clearFilter()">Mostrar Tots</button>
            </div>

            <style>
                .filter-buttons {
                    text-align: center;
                    margin-bottom: 20px;
                    display: flex;
                    flex-wrap: wrap;
                    /* Permite que los botones se distribuyan en varias filas si es necesario */
                    gap: 10px;
                    /* Espacio entre los botones en cada fila */
                }

                .filter-btn {
                    padding: 10px 20px;
                    margin: 0 10px;
                    font-size: 16px;
                    border: 1px solid #007bff;
                    background-color: #fff;
                    color: #007bff;
                    border-radius: 4px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }

                .filter-btn:hover {
                    background-color: #007bff;
                    color: white;
                }

                .filter-btn:active {
                    transform: scale(0.95);
                }

                .active {
                    background-color: #007bff;
                    color: white;
                }
            </style>

            <div class="table-responsive">
                <table class="table table-striped" id="authorsTable">
                    <thead class="table-primary">
                        <tr>
                            <th></th>
                            <th>Nom i cognoms</th>
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

            <!-- Paginación -->
            <div id="pagination" class="pagination"></div>


        </div>
    </main>
</div>

<script>
    let currentPage = 1;
    const limit = 15;
    let currentFilter = null; // Variable para almacenar el filtro actual

    // Función principal para cargar la tabla
    function authorsTableLibrary(page = 1, group = null) {
        currentPage = page; // Actualiza la página actual
        currentFilter = group; // Establece el filtro actual

        // Desmarcar todos los botones
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.classList.remove('active');
        });

        // Marcar el botón correspondiente
        if (group !== null) {
            document.getElementById(`filter-${group}`).classList.add('active');
        } else {
            document.getElementById('filter-all').classList.add('active');
        }

        let urlAjax = `https://${window.location.host}/api/persones/get/?type=llistatPersones&page=${page}&limit=${limit}`;
        if (group) {
            urlAjax += `&group=${group}`; // Si hay filtro de grupo, lo agregamos a la URL
        }

        fetch(urlAjax)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.json();
            })
            .then(data => {
                try {
                    let html = '';
                    const totalPages = data.totalPages;

                    // Construir las filas de la tabla con los datos
                    data.data.forEach(author => {
                        let dirImg = 'default-directory';
                        let dirUrl = '';

                        switch (author.grup) {
                            case 1:
                                dirImg = 'biblioteca-autor';
                                dirUrl = 'biblioteca/fitxa-autor';
                                break;
                            case 2:
                                dirImg = 'cinema-director';
                                dirUrl = 'cinema/fitxa-director';
                                break;
                            case 3:
                                dirImg = 'cinema-actor';
                                dirUrl = 'cinema/fitxa-actor';
                                break;
                            case 4:
                                dirImg = 'historia-persona';
                                dirUrl = 'historia/fitxa-personatge';
                                break;
                            case 5:
                                dirImg = 'politic';
                                dirUrl = 'historia/fitxa-politic';
                                break;
                        }

                        const fullImgUrl = `https://media.elliot.cat/img/${dirImg}/${author.nameImg}.jpg`;
                        const detailUrl = `https://${window.location.host}/gestio/${dirUrl}/${author.slug}`;
                        const editUrl = `https://${window.location.host}/gestio/base-dades-persones/modifica-persona/${author.slug}`;

                        html += `<tr>
                        <td class="text-center">
                            <a id="${author.id}" title="Author page" href="${detailUrl}">
                                <img src="${fullImgUrl}" style="height:70px">
                            </a>
                        </td>
                        <td>
                            <a href="${detailUrl}">${author.AutNom} ${author.AutCognom1}</a>
                        </td>
                        <td>${author.country || ''}</td>
                        <td>${author.profession || ''}</td>
                        <td>${author.yearDie ? `${author.yearBorn} - ${author.yearDie}` : author.yearBorn}</td>
                        <td>
                            <a href="${editUrl}">
                                <button type="button" class="button btn-petit">Modifica</button>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="button btn-petit">Elimina</button>
                        </td>
                    </tr>`;
                    });

                    // Insertar las filas en la tabla
                    document.querySelector('#authorsTable tbody').innerHTML = html;

                    // Actualizar el paginador
                    updatePagination(totalPages, currentPage);

                } catch (error) {
                    console.error('Error al procesar los datos:', error);
                }
            })
            .catch(error => console.error('Error en la petición:', error));
    }

    // Función para filtrar por grupo
    function filterByGroup(group) {
        authorsTableLibrary(1, group); // Llama a la función con el grupo seleccionado y página 1
    }

    // Función para limpiar el filtro y mostrar todos los resultados
    function clearFilter() {
        authorsTableLibrary(1, null); // Llama a la función sin filtro
    }

    // Llamada inicial para cargar la primera página sin filtro
    authorsTableLibrary(currentPage);

    // Función para actualizar la paginación
    function updatePagination(totalPages, currentPage) {
        const paginationElement = document.querySelector('#pagination');
        if (!paginationElement) return;

        let paginationHtml = '';

        // Crear los botones de paginación
        for (let i = 1; i <= totalPages; i++) {
            const isActive = i === currentPage ? 'current-page' : '';
            paginationHtml += `<a href="javascript:void(0)" class="page-btn ${isActive}" 
            onclick="authorsTableLibrary(${i}, ${currentFilter})">${i}</a>`;
        }

        paginationElement.innerHTML = paginationHtml;
    }
</script>