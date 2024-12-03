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
                                    <h2 class="mb-4">Detalles del Curso: <span id="nombreCurso">Matemáticas Avanzadas</span></h2>
                                </div>
                                <!-- Lista de Alumnos Inscritos -->
                                <div class="col-lg-4">
                                    <a href="../cursos/alumnos_inscritos" class="btn btn-success">Ver Lista de Alumnos Inscritos</a>
                                </div>
                            </div>         
                        </div>
                    </div>



              <!-- Información del Curso -->
              <div class="col-lg-8">
                <div class="card mb-4">
                  <div class="card-body">
                    <h4>Descripción</h4>
                    <p id="descripcionCurso">Curso avanzado de matemáticas aplicadas</p>
                    <h4>Docente</h4>
                    <p id="docenteCurso">Arturo Villegas</p>
                    <h4>Categoría</h4>
                    <p id="categoriaCurso">Ciencias</p>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h4>Unidades y Contenido</h4>
                    <ul id="unidadesContenido">
                      <li>Unidad 1: Álgebra avanzada</li>
                      <li>Unidad 2: Cálculo diferencial</li>
                      <li>Unidad 3: Teoría de números</li>
                      <li>Unidad 4: Estadística aplicada</li>
                    </ul>
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
