<?php
require '../../App/Config.php';
require_once '../../App/CoursesController.php';
require_once '../../App/StudentsController.php';
require_once '../../App/InscriptionsController.php';

$studentsController = new StudentsController();
$students = $studentsController->get();
$coursesController = new CoursesController();
$courses = $coursesController->get();
$inscriptionscontroller = new InscriptionsController();
$inscriptions = $inscriptionscontroller->get();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title>Cursos | Sistema Escolar</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../Assets/css/bootstrap-1.min.css">
  <!----css3---->
  <link rel="stylesheet" href="../Assets/css/custom.css">
  <link rel="icon" type="image/png" sizes="96x96" href="../../Assets/img/logo.png">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <!-- Google Material Icon -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="../Assets/css/font-awesome.min.css" rel="stylesheet" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="body-overlay"></div>
    <?php include "../layouts/sidebar.php"; ?>

    <!-- Navbar -->
    <div id="content">
      <?php include "../layouts/navbar.php"; ?>

      <!-- Main Content -->
      <div class="main-content">
        <div class="row">
          <div class="col-md-12">
            <div class="table-wrapper">
              <div class="table-title">
                <div class="row">
                  <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                    <h2 class="ml-lg-2"> Lista de alumnos inscritos</h2>
                  </div>
                  <div class="col-sm-12 p-0 d-flex justify-content-lg-end justify-content-center">
                    <a href="#addAlumnoModal" class="btn btn-success" data-toggle="modal">
                      <i class="material-icons">&#xE147;</i> Agregar
                    </a>
                  </div>
                </div>
              </div>

              <!-- Tabla de Alumnos -->
              <table id="tablaAlumnos" class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Curso</th>

                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($inscriptions['data']) && is_array($inscriptions['data']) && count($inscriptions['data'])): ?>
                    <?php foreach ($inscriptions['data'] as $inscription): ?>
                      <?php
                      // Encuentra el nombre del alumno por ID
                      $student = $studentsController->getStudentByID($inscription['user_id']);
                      $studentName = $student['name'] ?? 'Desconocido';

                      // Encuentra el nombre del curso por ID
                      $courseN = $coursesController->getCourseByID($inscription['course_id']);
                      $courseName = $courseN['name'] ?? 'Desconocido';
                      ?>
                      <tr>
                        <td><?= isset($inscription['id']) ? $inscription['id'] : 'N/A' ?></td>
                        <td><?= $studentName ?></td>
                        <td><?= $courseName ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="3">No hay alumnos inscritos disponibles.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para Agregar Alumno -->
      <div id="addAlumnoModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Alumno</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?= BASE_PATH . '/App/InscriptionsController.php'; ?>">
                <div class="form-group">
                  <label>Fecha</label>
                  <input type="date" class="form-control" required name="date_inscription">
                </div>
                <div class="form-group">
                  <label>Alumno</label>
                  <select class="form-control" required name="user_id">
                    <option>Seleccione un Alumno</option>
                    <?php if (isset($students['data']) && is_array($students['data']) && count($students['data'])): ?>
                      <?php foreach ($students['data'] as $student): ?>

                        <option value="<?= $student['id'] ?>"><?= $student['name'] ?></option>


                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6">No hay Alumnos disponibles.</td>
                      </tr>
                    <?php endif; ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Curso</label>
                  <select class="form-control" required name="course_id">
                    <option>Seleccione un Curso<i class="fa fa-i-cursor" aria-hidden="true"></i></option>
                    <?php if (isset($courses['data']) && is_array($courses['data']) && count($courses['data'])): ?>
                      <?php foreach ($courses['data'] as $course): ?>

                        <option value="<?= $course['id'] ?>"><?= $course['name'] ?></option>


                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6">No hay Cursos disponibles.</td>
                      </tr>
                    <?php endif; ?>
                  </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                <input type="hidden" name="action" value="addInscription">
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal para Eliminar AlumnoAlumno -->
      <div id="deleteAlumnoModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Alumno</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <p>¿Estás seguro de que deseas eliminar este Alumno?</p>
              <p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
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