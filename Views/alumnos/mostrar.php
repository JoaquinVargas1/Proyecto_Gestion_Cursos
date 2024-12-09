<?php
require '../../App/Config.php'; 
require_once '../../App/StudentsController.php';

// Iniciar sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Crear una instancia del controlador de alumnos
$studentsController = new StudentsController();

// Procesar las acciones POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addStudent':
            $name = $_POST['name'] ?? '';
            $lastname = $_POST['lastname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $semester = $_POST['semester'] ?? '';
            if ($name && $lastname && $email && $password && $semester) {
                $studentsController->addStudent($name, $lastname, $email, $password, $semester);
                $_SESSION['message'] = 'Alumno agregado exitosamente.';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Todos los campos son obligatorios para agregar un alumno.';
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

// Obtener la lista de alumnos
ob_start();
$studentsController->get();
$json = ob_get_clean();

$studentsData = json_decode($json, true);

if (!is_array($studentsData)) {
    echo "<pre>Error: La respuesta de la API no tiene el formato esperado.\n";
    echo "Contenido bruto de la respuesta:\n";
    var_dump($json);
    echo "\nContenido de \$studentsData:\n";
    var_dump($studentsData);
    echo "</pre>";
    exit;
}

$students = $studentsData;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Alumnos | Sistema Escolar</title>
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
                      <h2 class="ml-lg-2">Alumnos</h2>
                    </div>
                    <div class="col-sm-12 p-0 d-flex justify-content-lg-end justify-content-center">
                      <a href="#addAlumnoModal" class="btn btn-success" data-toggle="modal">
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

                <!-- Tabla de Alumnos -->
                <table class="table table-striped table-hover text-center">
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
                    <?php if (!empty($students)): ?>
                      <?php foreach ($students as $student):
                        $studentId = $student['id'] ?? '';
                        $name = $student['name'] ?? '';
                        $lastName = $student['lastName'] ?? '';
                        $email = $student['email'] ?? '';
                        $semester = $student['semester'] ?? '';
                      ?>
                        <tr>
                          <td><?php echo $studentId; ?></td>
                          <td><?php echo $name; ?></td>
                          <td><?php echo $lastName; ?></td>
                          <td><?php echo $email; ?></td>
                          <td><?php echo $semester; ?></td>
                          <td>
                            <div class="d-flex justify-content-center">
                              <a href="detalle_alumno.php?id=<?php echo $studentId; ?>" class="btn btn-info mx-1">Ver</a>
                              <a href="#editAlumnoModal" class="btn btn-primary mx-1" data-toggle="modal"
                                 data-id="<?php echo $studentId; ?>"
                                 data-name="<?php echo $name; ?>"
                                 data-lastname="<?php echo $lastName; ?>"
                                 data-email="<?php echo $email; ?>"
                                 data-semester="<?php echo $semester; ?>">Editar</a>
                              <a href="#deleteAlumnoModal" class="btn btn-danger mx-1" data-toggle="modal"
                                 data-id="<?php echo $studentId; ?>">Eliminar</a>
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
                <form action="../../App/StudentsController.php" method="POST">
                  <input type="hidden" name="action" value="addStudent">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name" required>
                  </div>
                  <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" name="lastname" required>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required>
                  </div>
                  <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" class="form-control" name="password" required>
                  </div>
                  <div class="form-group">
                    <label>Semestre</label>
                    <input type="text" class="form-control" name="semester" required>
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

        <!-- Scripts -->
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
