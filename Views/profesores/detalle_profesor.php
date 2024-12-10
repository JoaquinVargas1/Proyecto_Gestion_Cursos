<?php
require '../../App/Config.php';
require_once '../../App/ProfesorController.php';

// Verificar si se recibe el ID del profesor
if (isset($_GET['id'])) {
    $profesorId = $_GET['id'];

    // Crear instancia del controlador de profesores
    $profesorController = new ProfesorController();
    
    // Obtener detalles del profesor
    ob_start();
    $profesorController->getStudentByID($profesorId);
    $json = ob_get_clean();
    $profesor = json_decode($json, true);

    // Verificar si los detalles se obtuvieron correctamente
    if (!$profesor) {
        echo "<p>Error al obtener los detalles del profesor.</p>";
        exit;
    }
} else {
    echo "<p>No se proporcionó un ID de profesor.</p>";
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no">
    <title>Profesor | Sistema Escolar</title>
    <link rel="stylesheet" href="../../Assets/css/bootstrap-1.min.css">
    <link rel="stylesheet" href="../../Assets/css/custom.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../Assets/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../../Assets/css/font-awesome.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="wrapper">
      <div class="body-overlay"></div>
      <?php include "../../Views/layouts/sidebar.php"; ?> 

      <div id="content">
        <?php include "../../Views/layouts/navbar.php"; ?>

        <div class="main-content">
          <div class="row">
            <div class="col-md-12">
              <div class="table-wrapper">
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                      <h2 class="ml-lg-2">Detalle del Profesor</h2>
                    </div>
                  </div>
                </div>

                <!-- Detalles del Profesor -->
                <div class="row mb-4">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <ul class="list-unstyled">
                          <li><strong>ID:</strong> <?php echo $profesor['id'] ?? 'N/A'; ?></li>
                          <li><strong>Nombre:</strong> <?php echo $profesor['name'] ?? 'N/A'; ?></li>
                          <li><strong>Apellido:</strong> <?php echo $profesor['lastName'] ?? 'N/A'; ?></li>
                          <li><strong>Email:</strong> <?php echo $profesor['email'] ?? 'N/A'; ?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Cursos del Profesor -->
                <h5 class="mb-3">Cursos que Imparte</h5>
                <table class="table table-bordered table-striped table-hover" id="coursesTable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Curso</th>
                      <th>Descripción</th>
                      <th>Categoría</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (!empty($profesor['courses'])): ?>
                      <?php foreach ($profesor['courses'] as $course): ?>
                        <tr>
                          <td><?php echo $course['id'] ?? 'N/A'; ?></td>
                          <td><?php echo $course['name'] ?? 'N/A'; ?></td>
                          <td><?php echo $course['description'] ?? 'N/A'; ?></td>
                          <td><?php echo $course['category']['name'] ?? 'N/A'; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="4">No hay cursos asociados.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Scripts -->
        <script src="../../Assets/js/jquery-3.3.1.slim.min.js"></script>
        <script src="../../Assets/js/popper.min.js"></script>
        <script src="../../Assets/js/bootstrap-1.min.js"></script>
        <script src="../../Assets/js/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script>
          $(document).ready(function() {
            $(".xp-menubar").on('click', function() {
              $('#sidebar').toggleClass('active');
              $('#content').toggleClass('active');
            });
            $(".xp-menubar, .body-overlay").on('click', function() {
              $('#sidebar, .body-overlay').toggleClass('show-nav');
            });
          });
        </script>
      </div>
    </div>
  </body>
</html>
