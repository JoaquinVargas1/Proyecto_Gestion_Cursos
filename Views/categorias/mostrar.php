<?php
require '../../App/Config.php';
require_once '../../App/CategoryController.php';

// Iniciar sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Crear una instancia del controlador de categorías
$categoryController = new CategoryController();

// Procesar las acciones POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addCategory':
            $name = $_POST['name'] ?? '';
            if (!empty($name)) {
                $categoryController->addCategory($name);
                $_SESSION['message'] = 'Categoría agregada exitosamente.';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'El nombre de la categoría es obligatorio.';
                $_SESSION['message_type'] = 'danger';
            }
            break;

        default:
            $_SESSION['message'] = 'Acción desconocida.';
            $_SESSION['message_type'] = 'danger';
            break;
    }
    // Redirigir a esta misma página para evitar reenvío de formulario
    header('Location: mostrar.php');
    exit;
}

// Obtener la lista de categorías
ob_start();
$categoryController->get();
$json = ob_get_clean();

$categoriesData = json_decode($json, true);

if (!is_array($categoriesData)) {
    echo "<pre>Error: La respuesta de la API no tiene el formato esperado.\n";
    echo "Contenido bruto de la respuesta:\n";
    var_dump($json);
    echo "\nContenido de \$categoriesData:\n";
    var_dump($categoriesData);
    echo "</pre>";
    exit;
}

$categories = $categoriesData;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Categorías | Sistema Escolar</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap-1.min.css">
    <link rel="stylesheet" href="../Assets/css/custom.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../Assets/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
  </head>
  <body>
    <div class="wrapper">
      <div class="body-overlay"></div>
      <?php include "../layouts/sidebar.php"; ?> 

      <div id="content">
        <?php include "../layouts/navbar.php"; ?>

        <div class="main-content">
          <div class="row">
            <div class="col-md-12">
              <div class="table-wrapper">
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                      <h2 class="ml-lg-2">Categorías</h2>
                    </div>
                    <div class="col-sm-12 p-0 d-flex justify-content-lg-end justify-content-center">
                      <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal">
                        <i class="material-icons">&#xE147;</i> Agregar
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Mensajes de retroalimentación -->
                <?php if (isset($_SESSION['message'])): ?>
                  <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
                <?php endif; ?>

                <!-- Tabla de Categorías -->
                <table class="table table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($categories)): ?>
                      <?php foreach ($categories as $category):
                        $categoryId = $category['id'] ?? '';
                        $name = $category['name'] ?? '';
                      ?>
                        <tr>
                          <td><?php echo $categoryId; ?></td>
                          <td><?php echo $name; ?></td>
                          <td>
                            <div class="d-flex justify-content-center">
                              <a href="#editCategoryModal" class="btn btn-primary mx-1" data-toggle="modal"
                                 data-id="<?php echo $categoryId; ?>"
                                 data-name="<?php echo $name; ?>">Editar</a>
                              <a href="#deleteCategoryModal" class="btn btn-danger mx-1" data-toggle="modal"
                                 data-id="<?php echo $categoryId; ?>">Eliminar</a>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="3">No hay categorías disponibles.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal para Agregar Categoría -->
        <div id="addCategoryModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Agregar Categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <form action="../../App/CategoryController.php" method="POST">
                  <input type="hidden" name="action" value="addCategory">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name" required>
                  </div>
                  <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <script src="../Assets/js/jquery-3.3.1.slim.min.js"></script>
        <script src="../Assets/js/popper.min.js"></script>
        <script src="../Assets/js/bootstrap-1.min.js"></script>
        <script>
          $(document).ready(function() {
            $(".xp-menubar").on('click', function() {
              $('#sidebar').toggleClass('active');
              $('#content').toggleClass('active');
            });
          });
        </script>
      </div>
    </div>
  </body>
</html>
