<?php
  require '../../App/Config.php';
  require_once '../../App/CategoryController.php';
  $categoryController = new CategoryController();
  $categories = $categoryController->get();
  ?>
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Categorías | Sistema Escolar</title>
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
                      <h2 class="ml-lg-2">Categorías</h2>
                    </div>
                    <div class="col-sm-12 p-0 d-flex justify-content-lg-end justify-content-center">
                      <a href="#addCategoryModal" class="btn btn-success" data-toggle="modal">
                        <i class="material-icons">&#xE147;</i> Agregar
                      </a>
                    </div>
                  </div>
                </div>

                <!-- Tabla de Categorías -->
                <table id="tablaCategorias" class="table table-striped table-hover text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Ejemplo de fila de categoría -->

                    <?php if (isset($categories['data']) && is_array($categories['data']) && count($categories['data'])): ?>
                      <?php foreach ($categories['data'] as $category): ?>
                    <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['name'] ?></td>
                      <td>
                        <div class="d-flex justify-content-center">
                          <a href="detalle_categoria_id=<?= $category['id'] ?>" class="btn btn-info mx-1">Ver</a>
                          <a href="#editCategoryModal" class="btn btn-primary mx-1" data-toggle="modal"   onclick="fillEditForm(<?= htmlspecialchars(json_encode($category)) ?>)">Editar</a>
                          <a href="#deleteCategoryModal" class="btn btn-danger mx-1" data-toggle="modal"   onclick="setCategoryIdToDelete(<?= $category['id'] ?>)">Eliminar</a>
                        </div>
                      </td>
                    </tr>


                    <?php endforeach; ?>
                  <?php else: ?>
                    <tr>
                      <td colspan="6">No hay categorias disponibles.</td>
                    </tr>
                  <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal para Agregar Categoría -->
        <div id="addCategoryModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Agregar Categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <form method="POST" action=<?= BASE_PATH . '/App/CategoryController.php'; ?>>
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" required name="name">
                  </div>
                  <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                  </div>
                  <input type="hidden" name="action" value="addCategory">
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal para Editar Categoría -->
        <div id="editCategoryModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Editar Categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <form  method="POST" action=<?= BASE_PATH . '/App/CategoryController.php'; ?>>
                <input type="hidden" name="categoryId" id="categoryIdToEdit">
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" required  name="name">
                  </div>
                  <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                  </div>
                  <input type="hidden" name="action" value="updateCategory">
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal para Eliminar Categoría -->
        <div id="deleteCategoryModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Eliminar Categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta categoría?</p>
                <p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                

                <form id="deleteStudentForm" method="POST" action="<?= BASE_PATH . '/App/CategoryController.php'; ?>">
                <input type="hidden" name="category_id" id="categoryIdToDelete">
                <input type="hidden" name="action" value="removeCategory">
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




          function fillEditForm(category) {


            document.getElementById('categoryIdToEdit').value = category.id;
            document.querySelector('#editCategoryModal input[name="name"]').value = category.name;
          }



          function setCategoryIdToDelete(category_id) {
          document.getElementById('categoryIdToDelete').value = category_id;

      }


        </script>
      </div>
    </div>
  </body>
</html>