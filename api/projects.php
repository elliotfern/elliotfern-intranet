<?php

// JSON of Links > all categories
if (isset($_GET['type']) && $_GET['type'] == 'projects' ) {
  global $conn;
  $data = array();
  $stmt = $conn->prepare(
      "SELECT p.id, p.nomProjecte, p.descripcioProjecte, p.estatProjecte, p.categoriaProjecte, p.dataIniciProjecte, p.dataActualitzacioProjecte, p.prioritatProjecte, p.clientProjecte, p.projectBudget, p.projectInvoice, c.clientEmpresa
      FROM db_projects AS p
      INNER JOIN db_accounting_hispantic_costumers AS c ON p.clientProjecte = c.id
      ORDER BY p.dataIniciProjecte DESC");
      $stmt->execute();
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      echo json_encode($data);

}