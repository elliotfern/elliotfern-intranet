<?php
# conectare la base de datos
include_once('../../inc/connection.php');
include_once('../../inc/functions.php');

if (isset($_POST['idUser'])) {
    $id = $_POST['idUser'];
} else {
    $id = $_POST['idUser'];
}

//call api
//read json file from url in php
$url = APP_SERVER . "/controller/users.php?type=user&id=" .$id;
$input = file_get_contents($url);
$arr = json_decode($input, true);
$vault = $arr[0];

    $idPost = $vault['id']; 
    $usernamePost = $vault['username'];
    $firstNamePost = $vault['firstName'];
    $lastNamePost = $vault['lastName'];
    $emailPost = $vault['email'];

// some action goes here under php
    echo '<div class="container-fluid">';
          
              echo '<div class="alert alert-success" id="updateUserMessageOk" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ADD_OK_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ADD_OK_MESSAGE.'</h6>
              </div>';
      
              echo '<div class="alert alert-danger" id="updateUserMessageErr" style="display:none;role="alert">
              <h4 class="alert-heading"><strong>'.ERROR_TYPE_MESSAGE_SHORT.'</h4></strong>
              <h6>'.ERROR_TYPE_MESSAGE.'</h6>
              </div>
              ';

    echo '<form method="POST" action="" id="modalFormAuthor" class="row g-3" >';

    $timestamp = date('Y-m-d');
    echo '<input type="hidden" id="dateModified" name="dateModified" value="'.$timestamp.'">';
    echo '<input type="hidden" id="id" name="id" value="'.$idPost.'">';

    echo '<div class="col-md-4">';
    echo '<label>First name:</label>';
    echo '<input class="form-control" type="text" name="firstName" id="firstName" value="'.$firstNamePost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutNomCheck">* Invalid data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Last name:</label>';
    echo '<input class="form-control" type="text" name="lastName" id="lastName" value="'.$lastNamePost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutCognom1Check">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Username:</label>';
    echo '<input class="form-control" type="url" name="username" id="username" value="'.$usernamePost.'">';
    echo '<label style="color:#dc3545;display:none" id="AutWikipediaCheck">* Missing data</label>';
    echo '</div>';

    echo '<div class="col-md-4">';
    echo '<label>Password:</label>';
    echo '<input class="form-control" type="text" name="password" id="password">';
    echo '<label style="color:#dc3545;display:none" id="dataNaixCheck">* Invalid data</label>';
    echo "</div>";

    echo '<div class="col-md-4">';
    echo '<label>Email:</label>';
    echo '<input class="form-control" type="text" name="email" id="email" value="'.$emailPost.'">';
    echo '</div>';
