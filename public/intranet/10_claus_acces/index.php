<?php

# conectare la base de datos
$activePage = "vault";

global $conn;

echo '<h2>Vault Database</h2>';

echo "<p><a href='/vault/new'><button type='button' class='btn btn-light btn-sm' id='btnAddVault'>Insert new vault</button></a></p>";

$data = array();
$stmt = $conn->prepare("SELECT v.id, v.client, c.clientEmpresa, c.clientNom, c.clientCognoms, c.id AS idClient
FROM db_vault AS v
LEFT JOIN db_accounting_hispantic_costumers AS c ON v.client = c.id
GROUP BY v.client ASC
ORDER BY c.clientEmpresa");
$stmt->execute();
if ($stmt->rowCount() === 0) {
  echo 'No rows';
} else {
  echo "<div class='table-responsive'>";
  echo "<table class=''>";
  echo "<thead class='table-primary'>";
  echo "<tr>";
  echo "<th>Client</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  $data = $stmt->fetchAll();
  foreach ($data as $row) {
    $idCostumer = $row['id'];
    echo "<tr>";
    echo "<td>";
    if ($row['client'] == 31) {
      echo "<a href='/vault/elliot/31'>Elliot</a>";
    } else {
      if (empty($row['clientEmpresa'])) {
        echo "<a href='/vault/customer/" . $row['idClient'] . "'>" . $row['clientNom'] . " " . $row['clientCognoms'] . "</a>";
      } else {
        echo "<a href='/vault/customer/" . $row['idClient'] . "'>" . $row['clientEmpresa'] . "</a>";
      }
    }
    echo "</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
  echo "</div>";
}


echo '</div>';
