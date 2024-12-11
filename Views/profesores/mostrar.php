<?php 
require '../../App/Config.php'; 
require_once '../../App/ProfesorController.php';

// Crear una instancia del controlador de profesores
$profesorController = new ProfesorController();

// Obtener la lista de profesores
$response = $profesorController->get();
$profesores = json_decode($response, true) ?? []; // Decodificar respuesta de la API
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profesores | Sistema Escolar</title>
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
                                    <?php foreach ($profesores as $profesor): ?>
                                        <tr>
                                            <td><?php echo $profesor['id'] ?? ''; ?></td>
                                            <td><?php echo $profesor['name'] ?? ''; ?></td>
                                            <td><?php echo $profesor['lastName'] ?? ''; ?></td>
                                            <td><?php echo $profesor['email'] ?? ''; ?></td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="../../Views/profesores/detalle_profesor.php?id=<?php echo $profesor['id'] ?? ''; ?>" class="btn btn-info mx-1">Ver</a>
                                                    <a href="#editProfesorModal" 
                                                       class="btn btn-primary mx-1" 
                                                       data-toggle="modal"
                                                       data-id="<?php echo $profesor['id'] ?? ''; ?>"
                                                       data-name="<?php echo $profesor['name'] ?? ''; ?>"
                                                       data-lastname="<?php echo $profesor['lastName'] ?? ''; ?>"
                                                       data-email="<?php echo $profesor['email'] ?? ''; ?>">Editar</a>
                                                    <a href="#deleteProfesorModal" 
                                                       class="btn btn-danger mx-1" 
                                                       data-toggle="modal"
                                                       data-id="<?php echo $profesor['id'] ?? ''; ?>">Eliminar</a>
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

            <!-- Modal para Agregar Profesor -->
            <div id="addProfesorModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Profesor</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="../../App/ProfesorController.php" method="POST">
                                <input type="hidden" name="action" value="addProfesor">
                                <div class="form-group">
                                    <label>Nombres</label>
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
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
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
                            <form action="../../App/ProfesorController.php" method="POST">
                                <input type="hidden" name="action" value="updateProfesor">
                                <input type="hidden" name="profesorId" id="edit_profesorId">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input type="text" class="form-control" name="name" id="edit_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" name="lastname" id="edit_lastname" required>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" id="edit_email" required>
                                </div>
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" name="password" id="edit_password" required>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
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
                            <form action="../../App/ProfesorController.php" method="POST">
                                <input type="hidden" name="action" value="removeProfesor">
                                <input type="hidden" name="profesorId" id="delete_profesorId">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
