<?php
$slug = $routeParams[0];
?>

<div class="container">
    <main>
        <div class="container">
            <h1>Actor/a: <span id="nom"></span> <span id="cognoms"></span></h1>
            <h6><a href="<?php echo APP_INTRANET . $url['cinema']; ?>">Arts escèniques, cinema i televisió</a> > <a href="<?php echo APP_INTRANET . $url['cinema']; ?>/llistat-actors">Llistat actors</a></h6>

            <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/modifica-persona/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica fitxa</button>

            <div class='row'>
                <div class='col imatge'>
                    <img id="img" src='' class='img-thumbnail' style='height:auto;width:auto;max-width:auto' alt='Author Photo' title='Author photo'>
                </div>

                <div class="col">

                    <div class="quadre-detalls">
                        <p><strong> Anys: </strong><span id="anyNaixement"></span></p>
                        <p id="AutDescrip"> </p>
                        <p><strong>Pais: </strong><span id="pais_cat"></span></p>
                        <p><strong>Professió: </strong><span id="ocupacio"></span></p>
                        <p><strong>Pàgina web: </strong><a id="web" href='' target='_blank' title='Wikipedia'>Web</a></p>
                        <p><strong>Data de creació: </strong><span id="dateCreated"></span></p>
                        <p><strong>Data de modificació: </strong><span id="dateModified"></span></p>
                    </div>
                </div>
            </div>

            <hr>
            <h4>Participació a pel·lícules:</h4>

            <div class="table-responsive">
                <table id="containerTaula" class="table table-striped"></table>
                </table>
            </div>

            <hr>
            <h4>Participació a sèries de televisió:</h4>

            <div class="table-responsive">
                <table class="table table-striped" id="containerTaula2">
                </table>
            </div>

        </div>

</div>
</main>
</div>



<script>
    // Función para realizar la solicitud Axios a la API
    async function connexioApiDades(url, id) {
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
                    if (key === 'img') {
                        document.getElementById('img').src = `https://media.elliot.cat/img/cinema-actor/${data2['nameImg']}.jpg`;
                    }

                    // Casos especiales: Director/a
                    if (key === 'nom' || key === 'cognoms') {
                        const directorUrl = document.getElementById('directorUrl');
                        if (directorUrl && directorUrl.tagName === 'A') {
                            directorUrl.href = `/directors/${data2['director']}`; // Añadir la URL del director
                        }
                    }

                    // Casos especiales: País
                    if (key === 'pais_cat') {
                        const paisUrl = document.getElementById('paisUrl');
                        if (paisUrl && paisUrl.tagName === 'A') {
                            paisUrl.href = `/paisos/${data2['pais']}`; // Añadir la URL del país
                        }
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
                    <th>Títol</th>
                    <th>Any</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
        `;

            data.forEach(pelicula => {
                tableHTML += `
                <tr>
                    <td><a href="/gestio/cinema/fitxa-${categoria}/${pelicula.slug}">${pelicula.titol}</a></td>
                    <td>${pelicula.anyInici}${pelicula.anyFi ? ' - ' + pelicula.anyFi : ''}</td>
                    <td>${pelicula.role}</td>
                </tr>
            `;
            });

            tableHTML += `</tbody>`;

            // Insertar la tabla en el div contenedor
            document.getElementById(taulaId).innerHTML = tableHTML;
        } catch (error) {
            console.error('Error al obtener datos:', error);
            document.getElementById(taulaId).innerHTML = '<tr><td colspan="3">Error al cargar los datos</td></tr>';
        }
    }

    connexioApiDades("/api/cinema/get/?actor=", "<?php echo $slug; ?>")
    taulaDades("/api/cinema/get/?actor-pelicules=", "<?php echo $slug; ?>", "containerTaula", "pelicula")
    taulaDades("/api/cinema/get/?actor-series=", "<?php echo $slug; ?>", "containerTaula2", "serie")
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