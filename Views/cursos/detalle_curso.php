<?php
require '../../App/Config.php';
require_once '../../App/CoursesController.php';
require_once '../../App/ProfesorController.php'; 
require_once '../../App/CategoryController.php'; 

// Verificar si el parámetro 'id' está presente en la URL
if (isset($_GET['id'])) {
    $courseId = $_GET['id'];

    
    $coursesController = new CoursesController();
    $profesorController = new ProfesorController();
    $categoryController = new CategoryController();
    // Obtener los datos del curso usando su ID
    $course = $coursesController->getCourseByID($courseId);

    if (!$course || !isset($course['data'])) {
        echo "No se encontró el curso con ID: " . $courseId;
        exit;
    }

    
    $courseData = $course['data'];

    
    $profesor = $profesorController->getProfesorByID($courseData['profesor_id']);
    $profesorName = $profesor['name'] ?? 'Desconocido';

    $category = $categoryController->getCategoryByID($courseData['category_id']);
    $categoryName = $category['name']?? 'Desconocido';
} else {
    echo "ID del curso no proporcionado.";
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <title>Cursos | Sistema Escolar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../Assets/css/bootstrap-1.min.css">
    <!----css3---->
    <link rel="stylesheet" href="../Assets/css/custom.css">
    <link rel="icon" type="image/png" sizes="96x96" href="../../Assets/img/logo.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
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
                          <div class="col-lg-8">
                              <h2 class="mb-4">Detalles del Curso</h2>
                          </div>
                          <!-- Lista de Alumnos Inscritos -->
                          <div class="col-lg-4">
                              <a href="../cursos/alumnos_inscritos" class="btn btn-success">Ver Lista de Alumnos Inscritos</a>
                          </div>
                      </div>         
                  </div>
              </div>



               <!-- Tarjeta de Información del Curso -->
               <div class="card mb-4">
                <div class="card-body">
                  <div class="mb-3">
                    <h5>Nombre</h5>
                    <p id="nombreCurso" class="text-muted"><?= htmlspecialchars($courseData['name'] ?? 'Sin nombre') ?></p>
                  </div>
                  <div class="mb-3">
                    <h5>Descripción</h5>
                    <p id="descripcionCurso" class="text-muted"><?= htmlspecialchars($courseData['description'] ?? 'Sin descripción') ?></p>
                  </div>
                  <div class="mb-3">
                    <h5>Docente</h5>
                    <p id="docenteCurso" class="text-muted"><?= htmlspecialchars($profesorName) ?></p>
                  </div>
                  <div>
                    <h5>Categoría</h5>
                    <p id="categoriaCurso" class="text-muted"><?= htmlspecialchars($category['name'] ?? 'Sin categoría') ?></p>
                  </div>
                </div>
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