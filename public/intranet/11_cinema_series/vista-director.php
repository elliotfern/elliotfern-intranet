<?php
$slug = $routeParams[0];
?>

<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['cinema']; ?>">Arts escèniques, cinema i televisió</a> > <a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-directors">Llistat directors</a></h6>
    </div>

    <main>
        <div class="container contingut">
            <h1>Arts escèniques, cinema i televisió</h1>
            <h2>Director/a: <span id="nom"></span> <span id="cognoms"></span></h2>
            <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/modifica-persona/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica fitxa</button>

            <div class='row'>
                <div class='col imatge'>
                    <img id="img" src='' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Cartell' title='Cartell'>
                </div>

                <div class="col">
                    <div class="quadre-detalls">
                        <p><strong> Anys: </strong><span id="anyNaixement"></span></p>
                        <p id="AutDescrip"> </p>
                        <p><strong>Pais: </strong><span id="pais_cat"></span></p>
                        <p><strong>Professió: </strong><span id="professio_ca"></span></p>
                        <p><strong>Pàgina web: </strong><a id="web" href='' target='_blank' title='web'>Web</a></p>
                        <p><strong>Data de creació: </strong><span id="dateCreated"></span></p>
                        <p><strong>Data de modificació: </strong><span id="dateModified"></span></p>
                    </div>
                </div>

            </div>

            <hr>
            <h4>Direcció de pel·lícules:</h4>

            <div class="table-responsive">
                <table class="table table-striped" id="directorPelicules"></table>
                </table>
            </div>

            <hr>
            <h4>Direcció de sèries de televisió:</h4>

            <div class="table-responsive">
                <table class="table table-striped" id="directorSeries">
                </table>
            </div>

        </div>
    </main>
</div>

<script>
    connexioApiGetDades("/api/cinema/get/?director=", "<?php echo $slug; ?>")

    async function connexioApiGetDades(url, id) {
        const urlAjax = `${url}${id}`;

        try {
            const response = await fetch(urlAjax, {
                method: 'GET'
            });

            if (!response.ok) {
                throw new Error('Error en la sol·licitud AJAX');
            }

            const data = await response.json();

            // Asegúrate de que data sea un objeto o array adecuado
            const data2 = Array.isArray(data) ? data[0] : data;

            for (let key in data2) {
                if (data2.hasOwnProperty(key)) {
                    let value = data2[key];

                    // Buscar el elemento `<span>` con el ID correspondiente
                    const element = document.getElementById(key);
                    if (element) {
                        // Verificar que el elemento es un `<span>` antes de modificar
                        if (element.tagName === 'SPAN') {
                            // Decodificar HTML si es necesario y asignar solo el texto
                            element.textContent = value; // Solo reemplazar el contenido del `span`
                        }
                    }

                    // Actualizar el DOM con la información recibida
                    if (key === 'nameImg') {
                        document.getElementById('img').src = `https://media.elliot.cat/img/cinema-director/${data2['nameImg']}.jpg`;
                    }

                    if (key === 'web') {
                        document.getElementById('web').href = data2['web'];
                    }

                    // Formatear fechas si es necesario
                    if (key === 'dateCreated' || key === 'dateModified' || key === 'dataVista') {
                        const dateElement = document.getElementById(key);
                        if (dateElement && dateElement.tagName === 'SPAN') {
                            dateElement.textContent = value; // Formatear y agregar la fecha
                        }
                    }

                    // Anys naixement i defuncio
                    if (key === 'anyNaixement' || key === 'anyDefuncio') {
                        const dateElement = document.getElementById(key);
                        if (dateElement && dateElement.tagName === 'SPAN') {
                            const anyNaixement = parseInt(data2['anyNaixement'], 10);
                            const anyDefuncio = data2['anyDefuncio'] ? parseInt(data2['anyDefuncio'], 10) : null;
                            const anyActual = new Date().getFullYear();

                            let edad;

                            if (!anyDefuncio) {
                                edad = anyActual - anyNaixement; // Calcula la edad actual si sigue vivo
                            } else {
                                edad = anyDefuncio - anyNaixement; // Calcula la edad en caso de fallecimiento
                            }

                            dateElement.innerHTML = `${anyNaixement} - ${anyDefuncio || ""} (${edad} anys)`;
                        }
                    }

                    // Anys naixement i defuncio
                    if (key === 'dateCreated') {
                        const dateElement = document.getElementById('dateCreated');
                        if (dateElement && dateElement.tagName === 'SPAN') {
                            const dateObj = new Date(value);
                            const day = dateObj.getDate();
                            const month = dateObj.getMonth() + 1; // Los meses van de 0 a 11
                            const year = dateObj.getFullYear();

                            dateElement.textContent = `${day}-${month}-${year}`;
                        }
                    }

                    // Anys naixement i defuncio
                    if (key === 'dateModified') {
                        const dateElement = document.getElementById('dateModified');
                        if (dateElement && dateElement.tagName === 'SPAN') {
                            const dateObj = new Date(value);
                            const day = dateObj.getDate();
                            const month = dateObj.getMonth() + 1; // Los meses van de 0 a 11
                            const year = dateObj.getFullYear();

                            dateElement.textContent = `${day}-${month}-${year}`;
                        }
                    }


                }
            }
            taulaDades("/api/cinema/get/?directorPelicules=", data2['id'], "directorPelicules", "pelicula")
            taulaDades("/api/cinema/get/?directorSeries=", data2['id'], "directorSeries", "serie")

        } catch (error) {
            console.error('Error al parsear JSON:', error); // Muestra el error de parsing
        }
    }

    async function taulaDades(url, id, taulaId, categoria) {
        const urlApi = `${url}${id}`;
        try {
            const response = await fetch(urlApi);
            if (!response.ok) {
                throw new Error('Error en la solicitud a la API');
            }

            const data = await response.json();
            if (!Array.isArray(data) || data.length === 0) {
                document.getElementById(taulaId).innerHTML = '<tr><td colspan="3">No s\'han trobat resultats.</td></tr>';
                return;
            }

            // Crear la estructura de la tabla
            let tableHTML = `
            <thead class="table-primary">
                <tr>
                    <th></th>
                    <th>Títol</th>
                    <th>Any</th>
                    <th>Gènere</th>
                </tr>
            </thead>
            <tbody>
        `;

            data.forEach(pelicula => {
                tableHTML += `
                <tr>
                    <td><a id="pelicula-${pelicula.id}" title="${categoria}" href="${window.location.origin}/gestio/cinema/fitxa-${categoria}/${pelicula.slug}">
                        <img src="https://media.elliot.cat/img/cinema-${categoria}/${pelicula.nameImg}.jpg" width="100" height="auto">
                    </a></td>
                    <td><a href="/gestio/cinema/fitxa-${categoria}/${pelicula.slug}">${pelicula.name}</a></td>
                    <td>${pelicula.anyInici}${pelicula.anyFi ? ' - ' + pelicula.anyFi : ''}</td>
                    <td>${pelicula.genere_ca}</td>
                </tr>
            `;
            });

            tableHTML += `</tbody>`;

            // Insertar la tabla en el div contenedor
            document.getElementById(taulaId).innerHTML = tableHTML;
        } catch (error) {
            console.error('Error al obtener datos:', error);
            document.getElementById(taulaId).innerHTML = '<tr><td colspan="3">Error al carregar les dades</td></tr>';
        }
    }
</script>

<style>
    .row {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-top: 20px;
        margin-bottom: 30px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .col {
        flex: 1;
        margin: 2px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .imatge {
        flex: 0 0 300px;
        /* Limita el ancho de la primera columna a 200px */
    }


    .img-thumbnail {
        max-width: 300px;
        height: auto !important;
        border-radius: 8px;
    }

    .quadre-detalls {
        border: 1px black;
    }

    /* Media query para pantallas más pequeñas */
    @media (max-width: 600px) {
        .container {
            flex-direction: column;
            /* Cambia la dirección del flex a columna */
        }

        .imatge {
            flex: 1 1 100%;
            /* La primera columna ocupa el 100% del ancho en dispositivos pequeños */
        }
    }
</style>