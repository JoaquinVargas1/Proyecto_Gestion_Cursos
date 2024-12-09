<?php
require '../../App/Config.php';
require_once '../../App/CoursesController.php';

// Iniciar sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Crear instancia del controlador
$coursesController = new CoursesController();

// Procesar acciones POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addCourse':
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            $profesorId = $_POST['profesorId'] ?? '';

            if (!empty($name) && !empty($description) && !empty($category_id) && !empty($profesorId)) {
                $coursesController->addCourse($name, $description, $category_id, $profesorId);
                $_SESSION['message'] = 'Curso agregado exitosamente.';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Todos los campos son obligatorios para agregar un curso.';
                $_SESSION['message_type'] = 'danger';
            }
            break;

        default:
            $_SESSION['message'] = 'Acción desconocida.';
            $_SESSION['message_type'] = 'danger';
            break;
    }
    // Redirigir a evitar reenvío de formulario
    header('Location: mostrar.php');
    exit;
}

// Obtener la lista de cursos
ob_start();
$coursesController->get();
$json = ob_get_clean();

$coursesData = json_decode($json, true);

if (!is_array($coursesData)) {
    echo "<pre>Error: La respuesta de la API no tiene el formato esperado.\n";
    echo "Contenido bruto de la respuesta:\n";
    var_dump($json);
    echo "\nContenido de \$coursesData:\n";
    var_dump($coursesData);
    echo "</pre>";
    exit;
}

$courses = $coursesData;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cursos | Sistema Escolar</title>
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
                                        <h2 class="ml-lg-2">Cursos</h2>
                                    </div>
                                    <div class="col-sm-12 p-0 d-flex justify-content-lg-end justify-content-center">
                                        <a href="#addCursoModal" class="btn btn-success" data-toggle="modal">
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

                            <!-- Tabla de Cursos -->
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Docente</th>
                                        <th>Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($courses)): ?>
                                        <?php foreach ($courses as $course):
                                            $courseId = $course['id'] ?? '';
                                            $name = $course['name'] ?? '';
                                            $description = $course['description'] ?? '';
                                            $profesorName = $course['profesor']['name'] ?? 'N/A';
                                            $categoryName = $course['category']['name'] ?? 'N/A';
                                        ?>
                                            <tr>
                                                <td><?php echo $courseId; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $description; ?></td>
                                                <td><?php echo $profesorName; ?></td>
                                                <td><?php echo $categoryName; ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="detalle_curso.php?id=<?php echo $courseId; ?>" class="btn btn-info mx-1">Ver</a>
                                                        <a href="#editCursoModal" class="btn btn-primary mx-1" data-toggle="modal">Editar</a>
                                                        <a href="#deleteCursoModal" class="btn btn-danger mx-1" data-toggle="modal">Eliminar</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6">No hay cursos disponibles.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Agregar Curso -->
            <div id="addCursoModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Curso</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="../../App/CoursesController.php" method="POST">
                                <input type="hidden" name="action" value="addCourse">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label>Descripción</label>
                                    <textarea class="form-control" name="description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Docente</label>
                                    <input type="text" class="form-control" name="profesorId" required>
                                </div>
                                <div class="form-group">
                                    <label>Categoría</label>
                                    <input type="text" class="form-control" name="category_id" required>
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
        </div>
    </div>
</body>
</html>
