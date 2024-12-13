<?php 
  require '../App/Config.php'; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Escolar</title>
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
              <form method="POST" autocomplete="off" role="form" onsubmit="return false;">
                <h1 class="login-panel-title">Login</h1>

                <div class="login-panel-section">
                  <div class="form-group">
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                      <input class="form-control" name="usuario" maxlength="30" placeholder="Correo">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                      <input class="form-control" name="clave" placeholder="Contraseña">
                    </div>
                  </div>
                </div>
                <div class="login-panel-section">
                  <button type="button" class="btn btn-login" onclick="window.location.href='<?php echo BASE_PATH; ?>cursos/mostrar';">
                  <i class="fa fa-sign-in fa-fw" aria-hidden="true"></i> Iniciar sesión
                  </button>
                </div>

                <div class="login-panel-section">
                  <p>¿No tienes una cuenta? <a href="register">Regístrate aquí</a></p>
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
