<?php

if (!isset($_SESSION['user'])) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elliot Fernandez - Login page</title>
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
      body {
        background-color: #3c3c3c !important;

      }
    </style>
  </head>

  <body>

    <div class="container" style="margin-top:50px">
      <div class="card mx-auto" style="max-width: 400px;">
        <div class="card-body">
          <div class="container">
            <h1>Login</h1>
            <?php
            echo '<div class="alert alert-success" id="loginMessageOk" style="display:none" role="alert">
                  <h4 class="alert-heading"><strong>Login OK!</h4></strong>
                  <h6>Login successful, please wait a moment.</h6>
                  </div>';

            echo '<div class="alert alert-danger" id="loginMessageErr" style="display:none" role="alert">
                  <h4 class="alert-heading"><strong>Error login</h4></strong>
                  <h6>Username or password are incorrect.</h6>
                  </div>';
            ?>

            <form action="" method="post" class="login" id="loginForm">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control">
              <br>

              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control">
              <br>
              <button name="login" id="btnLogin" class="btn btn-primary">Login</button>

            </form>
          </div>
        </div>
      </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
      // Afegir l'escoltador d'esdeveniments al formulari
      document.getElementById('loginForm').addEventListener('submit', login);

      async function login(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener los valores del formulario
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const loginMessageOk = document.getElementById('loginMessageOk');
        const loginMessageErr = document.getElementById('loginMessageErr');

        try {
          const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              username,
              password
            })
          });

          const data = await response.json();

          if (response.ok) {
            if (data.success) {
              // Guardar el token en localStorage
              localStorage.setItem('token', data.token);

              // Mostrar mensaje de éxito
              loginMessageOk.style.display = 'block';
              loginMessageOk.innerHTML = data.message;
              loginMessageErr.style.display = 'none';

              setTimeout(() => {
                window.location.href = "/admin";
              }, 3000);
            } else {
              // Mostrar mensaje de error
              loginMessageErr.style.display = 'block';
              loginMessageErr.innerHTML = data.message;
              loginMessageOk.style.display = 'none';
            }
          } else {
            throw new Error(data.message || 'Error en la sol·licitud');
          }
        } catch (error) {
          // Mostrar mensaje de error
          loginMessageErr.style.display = 'block';
          loginMessageErr.innerHTML = error.message;
          loginMessageOk.style.display = 'none';
        }
      }
    </script>

  </body>

  </html>
<?php
} else {
  $url_admin = APP_ROOT . '/admin';
  header('Location: ' . $url_admin);
}
