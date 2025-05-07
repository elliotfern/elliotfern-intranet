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

            <button onclick="window.location.href='<?php echo APP_INTRANET . $url['persona']; ?>/modifica-persona/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica fitxa</button>

            <div class="dadesFitxa">
                <strong>Aquesta fitxa ha estat creada el: </strong>
                <span id="dateCreated"><?php echo date('d-m-Y', strtotime($dateCreated)); ?></span>
                <?php if ($dateModified !== '0000-00-00' && $dateModified !== $dateCreated): ?>
                    | Modificada el: <span id="dateModified"><?php echo date('d-m-Y', strtotime($dateModified)); ?></span>
                <?php endif; ?>
            </div>

            <div class='fixaDades'>

                <div class='columna imatge'>
                    <img id="nameImg" src='<?php echo $nameImg ?>' class='img-thumbnail' alt='Imatge' title='Imatge'>
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

                <hr>
                <div class="container" style="padding:20px;background-color:#ececec;margin-top:25px;margin-bottom:25px">
                    <h4>Descripció de l'espai</h4>
                    <span id="descripcio"><?php echo $EspDescripcio ?></span>
                </div>

                <!-- Contenedor del mapa -->
                <div id="map" style="width: 100%; height:500px;"></div>

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
</script>