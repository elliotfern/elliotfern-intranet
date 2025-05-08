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

            <p><button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/modifica-viatge/<?php echo $slug; ?>'" class="button btn-gran btn-secondari">Modifica viatge</button>

                <button onclick="window.location.href='<?php echo APP_INTRANET . $url['viatges']; ?>/nou-espai'" class="button btn-gran btn-secondari">Afegeix espai</button>
            </p>

            <?php
            // Preparar la consulta con placeholders
            $query = "SELECT p.nom, p.id, v.dataVisita, c.city, p.slug
            FROM db_travel_places_visited AS v
            INNER JOIN db_viatges_llistat AS l ON v.idViatge = l.id
            INNER JOIN db_travel_places AS p ON p.id = v.espId
            INNER JOIN db_cities AS c ON c.id = idCiutat
            WHERE l.slug = :slug
            GROUP BY p.id
            ORDER BY v.dataVisita";
            $stmt = $conn->prepare($query);

            // Ligar el valor de $slug a un placeholder
            $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $data = $stmt->fetchAll();
            echo '<div class="table-responsive">
                    <table class="table table-striped" id="authorsTable">
                    <thead class="table-primary">
                    <tr>
                        <th>Espai</th>
                        <th>Ciutat</th>
                        <th>Visita</th>
                    </tr>
                    </thead>
                    <tbody>';
            foreach ($data as $row) {
                $id = $row['id'];
                $nom = $row['nom'];
                $city = $row['city'];
                $slug = $row['slug'];
                $dataVisita = $row['dataVisita'];
                $dataInici_formateada = date("d/m/Y", strtotime($dataVisita));

                echo "<tr>";
                echo "<td><a href='/gestio/viatges/fitxa-espai/" . $slug . "'>" . $nom . "</a></td>";
                echo '<td>' . $city . '</td>';
                echo "<td>" . $dataInici_formateada . " </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            ?>

        </div>
    </main>
</div>