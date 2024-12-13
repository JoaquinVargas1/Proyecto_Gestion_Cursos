<?php 
  require '../App/Config.php'; 

  $errorMessage = '';
if (isset($_GET['error'])) {
  switch ($_GET['error']) {
    case 'usuario_no_encontrado':
      $errorMessage = 'Usuario no encontrado.';
      break;
    case 'contrasena_incorrecta':
      $errorMessage = 'Contraseña incorrecta.';
      break;
    case 'error_desconocido':
      $errorMessage = 'Ha ocurrido un error desconocido.';
      break;
  }
}
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

            <?php if (!empty($errorMessage)): ?>
              <div id="error-message" class="alert alert-danger">
                <?= $errorMessage; ?>
              </div>
            <?php endif; ?>


            <form method="POST" autocomplete="off" role="form" action="<?= BASE_PATH . '/App/AuthController.php'; ?>">
                <h1 class="login-panel-title">Login</h1>

                <div class="login-panel-section">
                  <div class="form-group">
                    <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"></i></span>
                      <input class="form-control" name="email" maxlength="30" placeholder="Correo" type="email" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                      <input class="form-control" name="password" placeholder="Contraseña" type="password" require>
                    </div>
                  </div>
                </div>
                <div class="login-panel-section">
                <button type="submit" class="btn btn-login">
                  <i class="fa fa-sign-in fa-fw" aria-hidden="true"></i> Iniciar sesión
                </button>
                <input type="hidden" name="action" value="login">
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




    <script>
    
    setTimeout(function() {
      var message = document.getElementById('error-message');
      if (message) {
        message.style.transition = "opacity 0.5s";
        message.style.opacity = "0";
        setTimeout(() => message.remove(), 500);
      }
    }, 3000);
  </script>
    <script src="Assets/js/jquery.min.js"></script>
    <script src="Assets/js/bootstrap.min.js"></script>
  </body>
</html>
