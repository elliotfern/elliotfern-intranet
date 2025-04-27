<?php
$slug = $routeParams[0];
?>

<div class="container">
    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['viatges']; ?>">Viatges</a></h6>
    </div>

    <main>
        <div class="container contingut">
            <h1>Fitxa viatge</h1>

            <?php
            // Preparar la consulta con placeholders
            $query = "SELECT p.id, p.nom, p.EspNomCast, p.EspNomEng, p.EspNomIt, p.EspFundacio, p.EspDescripcio, p.EspDescripcioCast, p.EspDescripcioEng, p.EspDescripcioIt, p.EspTipus, p.EspWeb, p.idCiutat, c.city, a.TipusNom
            FROM db_travel_places AS p
            INNER JOIN db_cities AS c ON c.id = p.idCiutat
            INNER JOIN db_travel_accommodation_type AS a ON p.EspTipus = a.id
            WHERE p.id = :slug";
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
            }

            echo "<h2>Espai: " . $nom . "</h2>";
            echo '<strong>Ciutat:</strong> ' . $city . '<br>';
            echo '<strong>Fundació:</strong> ' . $EspFundacio . '<br>';
            echo '<strong>Tipus espai:</strong> ' . $TipusNom . '<br>';
            echo '<strong>Web:</strong> <a href="' . $EspWeb . '" target="_blank">' . $EspWeb . '</a><br>';
            echo '<strong>Descripció:</strong> ' . $EspDescripcio . '<br>';
            ?>

        </div>
    </main>
</div>