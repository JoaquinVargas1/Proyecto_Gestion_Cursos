<?php 
  require '../App/Config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Escolar - Registro</title>
    <link href="Assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="Assets/css/awesome-bootstrap-checkbox.min.css" rel="stylesheet">
    <link href="Assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="Assets/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="96x96" href="Assets/img/logo.png">
    <link rel="icon" href="Assets/images/favicon.svg" type="image/x-icon" />
  </head>
  <body>
    <div class="login-background">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-4 col-centered">
            <div class="login-panel text-center">
              <form method="POST" autocomplete="off" role="form" action="register">
                <h1 class="login-panel-title" style="line-height: 1.2;">
                  Registro de<br><span style="font-size: 1.2;">Usuario</span>
                </h1>
                <div class="login-panel-section">
                  <!-- Campo para el Nombre -->
                  <div class="form-group">
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                      <input class="form-control" name="nombre" maxlength="50" placeholder="Nombre" required>
                    </div>
                  </div>

                  <!-- Campo para el Correo -->
                  <div class="form-group">
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-envelope fa-fw" aria-hidden="true"></i></span>
                      <input class="form-control" type="email" name="correo" maxlength="50" placeholder="Correo" required>
                    </div>
                  </div>

                  <!-- Campo para la Contraseña -->
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                      <input class="form-control" type="password" name="clave" placeholder="Contraseña" required>
                    </div>
                  </div>
                </div>

                <div class="login-panel-section">
                  <button type="submit" class="btn btn-login">
                    <i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> Registrarse
                  </button>
                </div>

                <div class="login-panel-section">
                  <p>¿Ya tienes una cuenta? <a href="login">Inicia sesión</a></p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="Assets/js/jquery.min.js"></script>
    <script src="Assets/js/bootstrap.min.js"></script>
  </body>
</html>
