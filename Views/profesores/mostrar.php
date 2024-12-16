<?php
require '../../App/Config.php';
require_once '../../App/ProfesorController.php';
$profesorController = new ProfesorController();
$profesors = $profesorController->get();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title>Profesores | Sistema Escolar</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../Assets/css/bootstrap-1.min.css">
  <link rel="stylesheet" href="../Assets/css/custom.css">
  <link rel="icon" type="image/png" sizes="96x96" href="../../Assets/img/logo.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="../Assets/css/font-awesome.min.css" rel="stylesheet" />
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
                    <h2 class="ml-lg-2">Profesores</h2>
                  </div>
                  <div class="col-sm-12 p-0 d-flex justify-content-lg-end justify-content-center">
                    <a href="#addProfesorModal" class="btn btn-success" data-toggle="modal">
                      <i class="material-icons">&#xE147;</i> Agregar
                    </a>
                  </div>
                </div>
              </div>

              <!-- Tabla de Profesores -->
              <table id="tablaProfesores" class="table table-striped table-hover text-center">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Ejemplo de fila de profesor -->
                  <?php if (isset($profesors['data']) && is_array($profesors['data']) && count($profesors['data'])): ?>
                    <?php foreach ($profesors['data'] as $profesor): ?>
                      <tr>
                        <td><?= $profesor['id'] ?></td>
                        <td><?= $profesor['name'] ?></td>
                        <td><?= $profesor['lastName'] ?></td>
                        <td><?= $profesor['email'] ?></td>

                        <td>
                          <div class="d-flex justify-content-center">
                            <a href="detalle_profesor_id=<?= $profesor['id'] ?>" class="btn btn-info mx-1">Ver</a>
                            <a href="#editProfesorModal" class="btn btn-primary mx-1" data-toggle="modal" onclick="fillEditForm(<?= htmlspecialchars(json_encode($profesor)) ?>)">Editar</a>
                            <a href="#deleteProfesorModal" class="btn btn-danger mx-1" data-toggle="modal" onclick="setProfesorIdToDelete(<?= $profesor['id'] ?>)">Eliminar</a>
                          </div>
                        </td>
                      </tr>

                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6">No hay profesores disponibles.</td>
                    </tr>
                  <?php endif; ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para Agregar Profesor -->
      <div id="addProfesorModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Profesor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?= BASE_PATH . '/App/ProfesorController.php'; ?>">
                <div class="form-group">
                  <label>Nombres</label>
                  <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" name="lastName" required>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" required>
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                <input type="hidden" name="action" value="addProfesor">
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal para Editar Profesor -->
      <div id="editProfesorModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Editar Profesor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?= BASE_PATH . '/App/ProfesorController.php'; ?>">

                <input type="hidden" name="profesorId" id="profesorIdToEdit">
                <div class="form-group">
                  <label>Nombres</label>
                  <input type="text" class="form-control" required name="name">
                </div>
                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" class="form-control" required name="lastName">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" required name="email">
                </div>
                <div class="d-flex justify-content-between mt-4">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                <input type="hidden" name="action" value="updateProfesor">
              </form>
            </div>
          </div>
        </div>
      </div>



      <!-- Modal para Eliminar Profesor -->
      <div id="deleteProfesorModal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Eliminar Profesor</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
              <p>¿Estás seguro de que deseas eliminar este Profesor?</p>
              <p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
            </div>
            <div class="modal-footer">


              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

              <form id="deleteStudentForm" method="POST" action="<?= BASE_PATH . '/App/ProfesorController.php'; ?>">
                <input type="hidden" name="profesorId" id="profesorIdToDelete">
                <input type="hidden" name="action" value="removeProfesor">
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form>

            </div>
          </div>
        </div>
      </div>

      <script src="../Assets/js/jquery-3.3.1.slim.min.js"></script>
      <script src="../Assets/js/popper.min.js"></script>
      <script src="../Assets/js/bootstrap-1.min.js"></script>
      <script src="../Assets/js/jquery-3.3.1.min.js"></script>
      <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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


        function fillEditForm(profesor) {

          document.getElementById('profesorIdToEdit').value = profesor.id;
          document.querySelector('#editProfesorModal input[name="name"]').value = profesor.name;
          document.querySelector('#editProfesorModal input[name="lastName"]').value = profesor.lastName;
          document.querySelector('#editProfesorModal input[name="email"]').value = profesor.email;




          console.log(profesor);

        }



        function setProfesorIdToDelete(profesorId) {
          document.getElementById('profesorIdToDelete').value = profesorId;

        }
      </script>
    </div>
  </div>
</body>

</html>