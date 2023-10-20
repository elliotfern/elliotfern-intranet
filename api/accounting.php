<?php

// Informacion usuario
// ruta => api/auth/?type=user&id=1&token="

if (isset($_GET['type']) && $_GET['type'] == 'accounting-customers' ) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare(
        "SELECT c.id, c.clientNom, c.clientCognoms, c.clientEmail, c.clientWeb, c.clientNIF, c.clientEmpresa, c.clientAdreca, c.clientCiutat, c.clientCP, c.clientProvincia, c.clientPais, c.clientTelefon, c.clientRegistre, ci.city, co.country, cou.county, c.clientStatus, s.estatNom
        FROM db_accounting_hispantic_costumers AS c
        INNER JOIN db_cities AS ci ON c.clientCiutat = ci.id
        INNER JOIN db_countries AS co ON c.clientPais = co.id
        INNER JOIN db_countries_counties AS cou ON c.clientProvincia = cou.id
        INNER JOIN  db_accounting_hispantic_costumers_status AS s ON c.clientStatus = s.id
        ORDER BY c.clientRegistre DESC");
        $stmt->execute();
        if($stmt->rowCount() === 0) echo ('No rows');
        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data[] = $users;
        }
        echo json_encode($data);
    } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-customers-invoices' ) {
        global $conn;
        $data = array();
        $stmt = $conn->prepare(
            "SELECT ic.id, ic.idUser, ic.facConcepte, ic.facData, YEAR(ic.facData) AS yearInvoice,  ic.facDueDate, ic.facSubtotal, ic.facFees, ic.facTotal, ic.facVAT, ic.facIva, ic.facEstat, ic.facPaymentType, vt.ivaPercen, ist.estat, pt.tipusNom, c.clientNom, c.clientCognoms, c.clientEmpresa
            FROM db_accounting_hispantic_invoices_customers  AS ic
            INNER JOIN db_accounting_hispantic_vat_type AS vt ON ic.facIva = vt.id
            INNER JOIN  db_accounting_hispantic_invoices_status AS ist ON ist.id = ic.facEstat
            INNER JOIN db_accounting_hispantic_payment_type AS pt ON ic.facPaymentType = pt.id
            INNER JOIN db_accounting_hispantic_costumers AS c ON ic.idUser = c.id
            ORDER BY ic.id ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
            while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                $data[] = $users;
            }
            echo json_encode($data);
        } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-elliotfernandez-customers-invoices' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
                "SELECT ic.id, ic.idUser, ic.facConcepte, ic.facData, YEAR(ic.facData) AS yearInvoice,  ic.facDueDate, ic.facSubtotal, ic.facFees, ic.facTotal, ic.facVAT, ic.facIva, ic.facEstat, ic.facPaymentType, vt.ivaPercen, ist.estat, pt.tipusNom, c.clientNom, c.clientCognoms, c.clientEmpresa
                FROM db_accounting_soletrade_invoices_customers  AS ic
                LEFT JOIN db_accounting_hispantic_vat_type AS vt ON ic.facIva = vt.id
                LEFT JOIN db_accounting_hispantic_invoices_status AS ist ON ist.id = ic.facEstat
                LEFT JOIN db_accounting_hispantic_payment_type AS pt ON ic.facPaymentType = pt.id
                LEFT JOIN db_accounting_hispantic_costumers AS c ON ic.idUser = c.id
                ORDER BY ic.id DESC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);
        
            } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-elliotfernandez-supplies-invoices' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT s.id, s.facEmpresa, s.facConcepte, s.facData, s.facSubtotal, s.facImportIva, s.facTotal, s.facIva, s.facPagament, c.id AS idEmpresa, c.empresaNom, c.empresaNIF, c.empresaDireccio, co.country, vt.ivaPercen, pt.tipusNom, cos.clientEmpresa
                    FROM db_accounting_soletrade_invoices_suppliers AS s
                    INNER JOIN db_accounting_hispantic_supplier_companies as c ON s.facEmpresa = c.id
                    INNER JOIN db_countries AS co ON c.empresaPais = co.id
                    INNER JOIN db_accounting_hispantic_vat_type AS vt ON s.facIva = vt.id
                    INNER JOIN db_accounting_hispantic_payment_type AS pt ON s.facPagament = pt.id
                    LEFT JOIN db_accounting_hispantic_costumers AS cos ON s.clientVinculat = cos.id
                    ORDER BY s.facData DESC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
    
        } elseif ( (isset($_GET['type']) && $_GET['type'] == 'customers-invoices') && (isset($_GET['id']) ) ) {
                $id = $_GET['id'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT ic.id, ic.idUser, ic.facConcepte, ic.facData, YEAR(ic.facData) AS yearInvoice,  ic.facDueDate, ic.facSubtotal, ic.facFees, ic.facTotal, ic.facVAT, ic.facIva, ic.facEstat, ic.facPaymentType, vt.ivaPercen, ist.estat, pt.tipusNom, pt.id AS idPayment, c.clientNom, c.clientCognoms, c.clientEmpresa, c.clientEmail, c.clientWeb, c.clientNIF, c.clientAdreca, ciu.city AS clientCiutat, pro.county AS clientProvincia, pa.country AS clientPais, c.clientCP
                    FROM db_accounting_soletrade_invoices_customers  AS ic
                    LEFT JOIN db_accounting_hispantic_vat_type AS vt ON ic.facIva = vt.id
                    LEFT JOIN db_accounting_hispantic_invoices_status AS ist ON ist.id = ic.facEstat
                    LEFT JOIN db_accounting_hispantic_payment_type AS pt ON ic.facPaymentType = pt.id
                    LEFT JOIN db_accounting_hispantic_costumers AS c ON ic.idUser = c.id
                    LEFT JOIN db_cities AS ciu ON ciu.id = c.clientCiutat
                    LEFT JOIN db_countries_counties AS pro ON pro.id = c.clientProvincia
                    LEFT JOIN db_countries AS pa ON pa.id = c.clientPais
                    WHERE ic.id = $id");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
    } elseif ( (isset($_GET['type']) && $_GET['type'] == 'invoice-products') && (isset($_GET['id']) ) ) {
                    $id = $_GET['id'];
                    global $conn;
                    $data = array();
                    $stmt = $conn->prepare(
                        "SELECT p.id, p.invoice, pd.product, p.notes, p.price
                        FROM db_accounting_soletrade_invoices_customers_products AS p
                        LEFT JOIN db_accounting_soletrade_products AS pd ON pd.id = p.product
                        WHERE p.invoice = $id
                        GROUP BY p.id
                        ORDER BY p.price desc");
                        $stmt->execute();
                        if($stmt->rowCount() === 0) echo ('No rows');
                        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                            $data[] = $users;
                        }
                        echo json_encode($data);

      } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-supplies-invoices' ) {
        global $conn;
        $data = array();
        $stmt = $conn->prepare(
            "SELECT s.id, s.facEmpresa, s.facConcepte, s.facData, s.facSubtotal, s.facImportIva, s.facTotal, s.facIva, s.facPagament, s.loanDirectors, c.id AS idEmpresa, c.empresaNom, c.empresaNIF, c.empresaDireccio, co.country, vt.ivaPercen, pt.tipusNom
            FROM db_accounting_hispantic_invoices_suppliers AS s
            INNER JOIN db_accounting_hispantic_supplier_companies as c ON s.facEmpresa = c.id
            INNER JOIN db_countries AS co ON c.empresaPais = co.id
            INNER JOIN db_accounting_hispantic_vat_type AS vt ON s.facIva = vt.id
            INNER JOIN db_accounting_hispantic_payment_type AS pt ON s.facPagament = pt.id
            ORDER BY s.id ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
            while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                $data[] = $users;
            }
            echo json_encode($data);
}