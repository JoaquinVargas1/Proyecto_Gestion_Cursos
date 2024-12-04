<?php
  require '../../App/Config.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <title>Detalle de Categoría | Sistema Escolar</title>
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
              <!-- Información de la Categoría -->
                <div class="table-title">
                  <div class="row">
                    <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
                      <h2 class="ml-lg-2">Detalle de la Categoría</h2>
                    </div>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-md-12">
                    <!-- Tarjeta de información de la categoría -->
                    <div class="card">
                      <div class="card-body">
                        <ul class="list-unstyled">
                          <li><strong>ID:</strong> 1</li>
                          <li><strong>Nombre:</strong> Tecnología</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>

                <h5 class="mb-3">Cursos en esta Categoría</h5>
                <table class="table table-bordered table-striped table-hover" id="coursesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Curso</th>
                            <th>Descripción</th>
                            <th>Profesor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Introducción a la Programación</td>
                            <td>Conceptos básicos de programación y lógica.</td>
                            <td>Jonathan Giovanni Soto Muñoz</td>
                        </tr>
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
