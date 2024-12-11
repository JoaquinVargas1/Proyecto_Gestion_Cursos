<?php
require '../../App/Config.php';
require_once '../../App/CategoryController.php';

// Iniciar sesión si no está iniciada
if (!isset($_SESSION)) {
    session_start();
}

// Crear una instancia del controlador de categorías
$categoryController = new CategoryController();

// Capturar la salida del método get()
ob_start();
$categoryController->get();
$response = ob_get_clean();

// Decodificar la respuesta JSON
$categories = json_decode($response, true) ?? [];
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
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                            <td><?= $category['id'] ?? ''; ?></td>
                                            <td><?= $category['name'] ?? ''; ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                <a href="../../Views/categorias/detalle_categoria.php?id=<?= $category['id'] ?? ''; ?>" class="btn btn-info mx-1">Ver</a>
                                                    <a href="#editCategoryModal" class="btn btn-primary mx-1" data-toggle="modal"
                                                       data-id="<?= $category['id'] ?? ''; ?>"
                                                       data-name="<?= $category['name'] ?? ''; ?>">Editar</a>
                                                    <a href="#deleteCategoryModal" class="btn btn-danger mx-1" data-toggle="modal"
                                                       data-id="<?= $category['id'] ?? ''; ?>">Eliminar</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
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
                            <form action="../../App/CategoryController.php" method="POST">
                                <input type="hidden" name="action" value="addCategory">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <button type="submit" class="btn btn-success mt-4">Guardar</button>
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
                            <form action="../../App/CategoryController.php" method="POST">
                                <input type="hidden" name="action" value="updateCategory">
                                <input type="hidden" name="categoryId" id="edit_category_id">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" name="name" id="edit_category_name" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Actualizar</button>
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
                            <form action="../../App/CategoryController.php" method="POST">
                                <input type="hidden" name="action" value="removeCategory">
                                <input type="hidden" name="categoryId" id="delete_category_id">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../Assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="../Assets/js/popper.min.js"></script>
    <script src="../Assets/js/bootstrap-1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editCategoryModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $('#edit_category_id').val(button.data('id'));
                $('#edit_category_name').val(button.data('name'));
            });

            $('#deleteCategoryModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                $('#delete_category_id').val(button.data('id'));
            });
        });
    </script>
</body>
</html>
