<?php
require '../../App/Config.php';
require_once '../../App/StudentsController.php';

// Obtener el ID del estudiante desde la URL
$studentId = $_GET['id'] ?? null;

if (!$studentId) {
    die("Error: No se proporcionó un ID de estudiante.");
}

// Crear una instancia del controlador de estudiantes
$studentsController = new StudentsController();

// Obtener información del estudiante
ob_start();
$studentsController->getStudentByID($studentId);
$response = ob_get_clean();
$studentData = json_decode($response, true);

if (!is_array($studentData) || empty($studentData)) {
    die("Error: No se pudo obtener la información del estudiante.");
}

// Obtener cursos asociados al estudiante
$courses = $studentData['courses'] ?? [];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <title>Detalle del Alumno | Sistema Escolar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/css/bootstrap-1.min.css">
    <link rel="stylesheet" href="../Assets/css/custom.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../Assets/img/logo.png">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../Assets/css/font-awesome.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="wrapper">
      <div class="body-overlay"></div>
      <?php include "../layouts/sidebar.php"; ?> 
      
      <!-- Navbar -->
      <div id="content">
        <?php include "../layouts/navbar.php"; ?>

        <!-- Main Content -->
        <div class="main-content">
          <div class="row">
            <div class="col-md-12">
              <!-- Información del Alumno -->
              <div class="table-title">
                <div class="row">
                  <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                    <h2 class="ml-lg-2">Detalle del Alumno</h2>
                  </div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="col-md-12">
                  <!-- Tarjeta de información del alumno -->
                  <div class="card">
                    <div class="card-body">
                      <ul class="list-unstyled">
                        <li><strong>ID:</strong> <?php echo $studentData['id'] ?? 'N/A'; ?></li>
                        <li><strong>Nombre:</strong> <?php echo $studentData['name'] ?? 'N/A'; ?></li>
                        <li><strong>Email:</strong> <?php echo $studentData['email'] ?? 'N/A'; ?></li>
                        <li><strong>Semestre:</strong> <?php echo $studentData['semester'] ?? 'N/A'; ?></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <h5 class="mb-3">Cursos del Alumno</h5>
              <table class="table table-bordered table-striped table-hover" id="coursesTable">
                <thead>
                  <tr>
                    <th>Semestre</th>
                    <th>Curso</th>
                    <th>Profesor</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($courses)): ?>
                    <?php foreach ($courses as $course): ?>
                      <tr>
                        <td><?php echo $course['semester'] ?? 'N/A'; ?></td>
                        <td><?php echo $course['name'] ?? 'N/A'; ?></td>
                        <td><?php echo $course['professor'] ?? 'N/A'; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No hay cursos disponibles para este estudiante.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Scripts -->
        <script src="../Assets/js/jquery-3.3.1.slim.min.js"></script>
        <script src="../Assets/js/popper.min.js"></script>
        <script src="../Assets/js/bootstrap-1.min.js"></script>
        <script src="../Assets/js/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script type="text/javascript">
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
