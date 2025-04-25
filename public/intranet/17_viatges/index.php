<div class="container">

    <div class="barraNavegacio">
        <h6><a href="<?php echo APP_INTRANET; ?>">Intranet</a> > <a href="<?php echo APP_INTRANET . $url['viatges']; ?>">Viatges</a></h6>
    </div>

    <main>
        <div class="container contingut">
            <h1>Viatges</h1>

            <?php
            $stmt = $conn->prepare("SELECT l.id, l.viatge, l.descripcio, l.dataInici, l.dataFi, l.slug
            FROM db_viatges_llistat AS l
            ORDER BY l.dataInici DESC");
            $stmt->execute();
            $data = $stmt->fetchAll();
            echo '<div class="table-responsive">
                    <table class="table table-striped" id="authorsTable">
                    <thead class="table-primary">
                    <tr>
                        <th>Viatge</th>
                        <th>Descripcio</th>
                        <th>Dates</th>
                    </tr>
                    </thead>
                    <tbody>';
            foreach ($data as $row) {
                $id = $row['id'];
                $viatge = $row['viatge'];
                $descripcio = $row['descripcio'];
                $slug = $row['slug'];
                $dataInici = $row['dataInici'];
                $dataInici_formateada = date("d/m/Y", strtotime($dataInici));
                $dataFi = $row['dataFi'];
                $dataFi_formateada = date("d/m/Y", strtotime($dataFi));

                echo "<tr>";
                echo "<td><a href='/gestio/viatges/fitxa-viatge/" . $slug . "'>" . $viatge . "</a></td>";
                echo '<td>' . $descripcio . '</td>';
                echo "<td>" . $dataInici_formateada . " - " . $dataFi_formateada . " </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            ?>

        </div>
    </main>
</div>