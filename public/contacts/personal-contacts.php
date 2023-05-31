<?php

# conectare la base de datos
$activePage = "contacts";
global $conn;
?>

<div class="container">
<h2><a href="index.php">Contacts</a> > Personal contacts</h2>

<p><button type='button' class='btn btn-warning btn-sm' id='btnCreateLink' onclick='btnCreateLink()' data-bs-toggle='modal' data-bs-target='#modalCreateLink'>Add link &rarr;</button>

<?php
$data = array();
$stmt = $conn->prepare("SELECT c.id, c.name, c.surname, c.email, c.tel, c.birthday, c.facebook, c.twitter, c.linkedin, c.website, c.tipus, c.contacts_country,c.contacts_company
FROM db_contacts AS c
WHERE c.tipus=1
ORDER BY c.name ASC");
$stmt->execute();
    if ($stmt->rowCount() === 0) {
        echo 'No rows';
    } else {
        ?>
        <div class="table-responsive">
            <table class="table table-striped" id="suppliesInvoices">
                <thead class="table-primary">
                <tr>
                <th>First Name &darr;</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Birthday</th>
                <th>Social</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $data = $stmt->fetchAll();
                    foreach ($data as $row) {
                        $name = $row['name'];
                        $surname = $row['surname'];
                        $email = $row['email'];
                        $tel = $row['tel'];
                        $birthday = $row['birthday'];
                        $twitter = $row['twitter'];
                        $linkedin = $row['linkedin'];
                        $website = $row['website'];
                        $id = $row['id'];

                        echo '<tr>';
                        echo "<td><a href='".$id."' target='_blank'>".$name." ".$surname."</a></td>";
                        echo '<td><a href="idGenere='.$id.'">'.$email.'</a></td>';
                        echo '<td><a href="&idTema='.$id.'">'.$tel.'</a></td>';
                        echo '<td>'.$birthday.'</td>';
                        echo '<td>'.$birthday.'</td>';
                        echo '<td>'.$birthday.'</td>';
                        echo "<td>
                          <a href='&LinkId=".$id."' class='btn btn-warning btn-sm' role='button' aria-pressed='true'>Update</a>
                          <a href='&LinkId=".$id."' class='btn btn-danger btn-sm' role='button' aria-pressed='true'>Delete</a>
                        </td>";          
                        echo '</tr>';
                    }
                    echo '</tbody>';                            
                    echo '</table>';
                    echo '</div>';
    }

echo '</div>';

//include_once('modals-links.php');

# footer
include_once(APP_ROOT . '/inc/footer.php');