<?php
require '../../App/Config.php';
require_once '../../App/StudentsController.php';

$studentsController = new StudentsController();
$students = $studentsController->get();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title>Alumnos | Sistema Escolar</title>
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
                    <h2 class="ml-lg-2">Alumnos</h2>
                  </div>
                  <div class="col-sm-12 p-0 d-flex justify-content-lg-end justify-content-center">
                    <a href="#addAlumnoModal" class="btn btn-success" data-toggle="modal">
                      <i class="material-icons">&#xE147;</i> Agregar
                    </a>
                  </div>
                </div>
              </div>

              <!-- Tabla de Alumnos -->
              <table id="tablaAlumnos" class="table table-striped table-hover text-center">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Semestre</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Ejemplo de fila de alumno -->
                  <?php if (isset($students['data']) && is_array($students['data']) && count($students['data'])): ?>
                    <?php foreach ($students['data'] as $student): ?>
                      <tr>
                        <td><?= $student['id'] ?></td>
                        <td><?= $student['name'] ?></td>
                        <td><?= $student['lastName'] ?></td>
                        <td><?= $student['email'] ?></td>
                        <td><?= $student['semester'] ?></td>
                        <td>
                          <div class="d-flex justify-content-center">
                            <a href="detalle_alumno_id=<?= $student['id'] ?>" class="btn btn-info mx-1">Ver</a>
                            <a href="#editAlumnoModal" class="btn btn-primary mx-1" data-toggle="modal">Editar</a>
                            <a href="#deleteAlumnoModal" class="btn btn-danger mx-1" data-toggle="modal">Eliminar</a>
                          </div>
                        </td>
                      </tr>

                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6">No hay alumnos disponibles.</td>
                    </tr>
                  <?php endif; ?>

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
              <form method="POST" action="<?= BASE_PATH . '/App/StudentsController.php'; ?>">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" required name="name" placeholder="Nombre" >
                </div>
                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" required name="lastname" placeholder="Apellidos"   >
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" required name="email" placeholder="Email"  >
                </div>
                <div class="form-group">
                  <label>Semestre</label>
                  <select class="form-control" required name="semester">
                  <option value="PRIMER">PRIMER</option>
                  <option value="SEGUNDO">SEGUNDO</option>
                  <option value="TERCER">TERCER</option>
                  <option value="CUARTO">CUARTO</option>
                  <option value="QUINTO">QUINTO</option>
                  <option value="SEXTO">SEXTO</option>
                  <option value="SETIMO">SETIMO</option>
                  <option value="OCTAVO">OCTAVO</option>
                  <option value="NOVENO">NOVENO</option>
                  </select>
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                <input type="hidden" name="action" value="addStudent">
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para Editar Alumno -->
      <div id="editAlumnoModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Alumno</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?= BASE_PATH . '/App/StudentsController.php'; ?>">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" required name="name" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" required name="lastname" placeholder="Apellidos">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" required name="email" placeholder="Email">
                </div>
                <div class="form-group">
                 <label>Semestre</label>
                  <select class="form-control" required name="semester">
                  <option value="PRIMER">PRIMER</option>
                  <option value="SEGUNDO">SEGUNDO</option>
                  <option value="TERCER">TERCER</option>
                  <option value="CUARTO">CUARTO</option>
                  <option value="QUINTO">QUINTO</option>
                  <option value="SEXTO">SEXTO</option>
                  <option value="SETIMO">SETIMO</option>
                  <option value="OCTAVO">OCTAVO</option>
                  <option value="NOVENO">NOVENO</option>
                  </select>
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
                <input type="hidden" name="action" value="updateStudent">
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal para Eliminar Alumno -->
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
              <button onclick="removeStudent(<?=$studentsId?>)" type="button" class="btn btn-danger">Eliminar</button>
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