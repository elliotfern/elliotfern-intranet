<?php
$slug = $routeParams[0];

// Preparar la consulta con placeholders
$query = "SELECT p.id, p.nom, p.EspNomCast, p.EspNomEng, p.EspNomIt, p.EspFundacio, p.EspDescripcio, p.EspDescripcioCast, p.EspDescripcioEng, p.EspDescripcioIt, p.EspTipus, p.EspWeb, p.idCiutat, c.city, a.TipusNom, i.nom AS img, i.alt, i.nameImg, p.coordinades_longitud, p.coordinades_latitud, p.dateCreated, p.dateModified
FROM db_travel_places AS p
INNER JOIN db_cities AS c ON c.id = p.idCiutat
INNER JOIN db_travel_accommodation_type AS a ON p.EspTipus = a.id
LEFT JOIN db_img AS i ON p.img = i.id
WHERE p.slug = :slug";
$stmt = $conn->prepare($query);

// Ligar el valor de $slug a un placeholder
$stmt->bindParam(':slug', $slug, PDO::PARAM_STR);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$data = $stmt->fetchAll();

foreach ($data as $row) {
    $id = $row['id'];
    $nom = $row['nom'];
    $city = $row['city'];
    $EspFundacio = $row['EspFundacio'];
    $EspDescripcio = $row['EspDescripcio'];
    $TipusNom = $row['TipusNom'];
    $EspWeb = $row['EspWeb'];
    $alt = $row['alt'];
    $img = $row['img'];
    $nameImg = $row['nameImg'];
    $coordinades_longitud = !empty($row['coordinades_longitud']) ? $row['coordinades_longitud'] : 2.1734;
    $coordinades_latitud = !empty($row['coordinades_latitud']) ? $row['coordinades_latitud'] : 41.3851;
    $dateCreated = $row['dateCreated'];
    $dateModified = $row['dateModified'];
}

?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="container">
    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['viatges']; ?>">Viatges</a></h6>
    </div>

    <main>
        <div class="container contingut">
            <h1>Fitxa viatge</h1>
            <h2>Espai: <?php echo $nom; ?></h2>

            <button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/modifica-espai/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica fitxa</button>

            <div class="dadesFitxa">
                <strong>Aquesta fitxa ha estat creada el: </strong>
                <span id="dateCreated"><?php echo date('d-m-Y', strtotime($dateCreated)); ?></span>
                <?php if ($dateModified !== '0000-00-00' && $dateModified !== $dateCreated): ?>
                    | Modificada el: <span id="dateModified"><?php echo date('d-m-Y', strtotime($dateModified)); ?></span>
                <?php endif; ?>
            </div>

            <div class='fixaDades'>

                <div class='columna imatge'>
                    <img id="nameImg" src='https://media.elliot.cat/img/viatge-espai/<?php echo $nameImg ?>.jpg' class='img-thumbnail' alt='Imatge' title='Imatge'>
                    <p><span id="alt" style="font-size:12px"><?php echo $alt ?></span></p>
                </div>

                <div class="columna">
                    <div class="quadre-detalls">
                        <p><strong>Ciutat: </strong> <?php echo $city ?></p>
                        <p><strong>Fundació: </strong><?php echo $EspFundacio ?></p>
                        <p><strong>Tipus espai: </strong><?php echo $TipusNom ?></p>
                        <p><strong>Web: </strong> <a href="<?php echo $EspWeb ?>" target="_blank">web</a></p>
                    </div>
                </div>

            </div>

            <hr>
            <div class="container" style="padding:20px;background-color:#ececec;margin-top:25px;margin-bottom:25px">
                <h4>Descripció de l'espai</h4>
                <span id="descripcio"><?php echo $EspDescripcio ?></span>
            </div>

            <!-- Contenedor del mapa -->
            <div id="map" style="width: 100%; height:500px;"></div>

            <hr>
            <h4>Visites realitzades en aquest espai:</h4>

            <div class="table-responsive">
                <table id="taula1" class="table table-striped"></table>
            </div>
        </div>
    </main>
</div>

<script>
    // Coordenadas del punto a localizar (por ejemplo, latitud y longitud)
    var lat = <?php echo $coordinades_latitud; ?>; // Latitud
    var lon = <?php echo $coordinades_longitud; ?>; // Longitud

    // Crear el mapa y centrarlo en las coordenadas
    var map = L.map('map').setView([lat, lon], 17); // 13 es el nivel de zoom

    // Añadir capa de OpenStreetMap al mapa
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Añadir un marcador en las coordenadas
    L.marker([lat, lon]).addTo(map)
        .bindPopup("<b><?php echo $nom ?></b><br><?php echo $city ?>")
        .openPopup();

    // altres operacions

    obtenerDatos("/api/viatges/get/?llistatVisitesEspai=" + <?php echo $id; ?>, "taula1", "Viatge", "viatge", "organitzacio");

    // Función para obtener datos de la API y luego crear la tabla
    function obtenerDatos(url, taula, columna1, urlFitxa, urlFitxa2) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta de la API');
                }
                return response.json();
            })
            .then(data => {
                // Llamamos a la función para crear la tabla con los datos obtenidos
                crearTabla(data, taula, columna1, urlFitxa, urlFitxa2);
            })
            .catch(error => {
                console.error('Hubo un problema con la solicitud fetch:', error);
            });
    }

    function crearTabla(datos, taula, columna1, urlFitxa, urlFitxa2) {
        // Obtener el div donde se insertará la tabla
        const taula1 = document.getElementById(taula);

        // Limpiar cualquier contenido previo en taula1 (por si se vuelve a cargar la tabla)
        taula1.innerHTML = '';

        // Comprobar si los datos están vacíos o si hay un mensaje de error
        if (datos.length === 0 || datos.error === "No rows found") {
            // Mostrar mensaje de que no hay datos
            const mensaje = document.createElement('p');
            mensaje.textContent = "No hi ha dades per mostrar";
            taula1.appendChild(mensaje);
            return; // Salir de la función sin crear la tabla
        }

        // Crear la tabla
        const tabla = document.createElement('table');
        tabla.classList.add('table', 'table-striped');

        // Crear el encabezado de la tabla
        const thead = document.createElement('thead');
        thead.classList.add('table-primary');
        const filaEncabezado = document.createElement('tr');
        const columnaNom = document.createElement('th');
        columnaNom.textContent = columna1;

        const columnaAnys = document.createElement('th');
        columnaAnys.textContent = 'Data';


        const columnaAccions = document.createElement('th');
        columnaAccions.textContent = 'Accions';

        filaEncabezado.appendChild(columnaNom);
        filaEncabezado.appendChild(columnaAnys);
        filaEncabezado.appendChild(columnaAccions);
        thead.appendChild(filaEncabezado);

        // Crear el cuerpo de la tabla
        const tbody = document.createElement('tbody');

        // Llenar la tabla con los datos recibidos por la API
        datos.forEach(item => {
            const fila = document.createElement('tr');

            // Columna "Nom i cognoms"
            const columnaNomCognoms = document.createElement('td');
            columnaNomCognoms.innerHTML = `<a href="${window.location.origin}/gestio/viatges/fitxa-${urlFitxa}/${item.slug}">${item.nom}</a>`;

            // Anys
            const anys = document.createElement('td');

            // Convertir la fecha

            // Array con los meses en catalán
            const mesesCatalan = [
                'gener', 'febrer', 'març', 'abril', 'maig', 'juny', 'juliol', 'agost', 'setembre', 'octubre', 'novembre', 'desembre'
            ];

            // Convertir la fecha
            let fecha = new Date(item.any1);
            let dia = ('0' + fecha.getDate()).slice(-2); // Obtener el día y asegurar que tenga 2 dígitos
            let mes = mesesCatalan[fecha.getMonth()]; // Obtener el nombre del mes en catalán
            let año = fecha.getFullYear(); // Obtener el año

            let fechaFormateada = `${dia} ${mes} ${año}`; // Formato final
            anys.innerHTML = `${fechaFormateada}`;

            // Columna "Accions" (ejemplo con botones de editar y eliminar)
            const columnaAccions = document.createElement('td');
            columnaAccions.innerHTML = `<a href="https://${window.location.host}/gestio/viatges/modifica-${urlFitxa}-${urlFitxa2}/${item.id}">
                <button type="button" class="button btn-petit">Modifica</button>`;

            fila.appendChild(columnaNomCognoms);
            fila.appendChild(anys);
            fila.appendChild(columnaAccions);
            tbody.appendChild(fila);
        });

        // Añadir el encabezado y el cuerpo de la tabla a la tabla principal
        tabla.appendChild(thead);
        tabla.appendChild(tbody);

        // Añadir la tabla al div taula1
        taula1.appendChild(tabla);
    }
</script>