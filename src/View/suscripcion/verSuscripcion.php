<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes Suscripción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
</head>
<body>

<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// ... Aquí va tu código PHP de lógica, obteniendo los datos de suscripciones ...

?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <h2 class="title mb-4"> <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Planes Suscripcion</h2>
                <button class="btn btn-primary" data-toggle="modal" data-target="#agregarModal">
                    <i class="fas fa-plus"></i> 
                </button>
            </div>

            <?php if(isset($data['mensaje'])): ?>
                <div class="mensaje mb-4"><?php echo $data['mensaje']; ?></div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="tabla_id">
                    <thead>
                        <tr>
                            <th>Suscripcion</th>
                            <th>Duracion Dias</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach($data['suscripcion'] as $dato){
                                echo"<tr>";
                                    echo"<td>".$dato['suscripcion']."</td>";
                                    echo"<td>".$dato['duracion_dias']."</td>";
                                    echo "<td>
                                            <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#editarModal_".$dato["id_suscripcion"]."'>
                                                <i class='fas fa-edit'></i> 
                                            </button>
                                        </td>";
                                    echo "<td>
                                            <a href='#' data-toggle='modal' data-target='#eliminarModal_".$dato["id_suscripcion"]."'>
                                                <i class='fas fa-trash-alt'></i>
                                            </a>
                                        </td>";
                                    // Agregamos el modal de confirmación para eliminar
                                    echo "<div class='modal fade' id='eliminarModal_".$dato["id_suscripcion"]."' tabindex='-1' role='dialog' aria-labelledby='eliminarModalLabel_".$dato["id_suscripcion"]."' aria-hidden='true'>
                                            <div class='modal-dialog' role='document'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='eliminarModalLabel_".$dato["id_suscripcion"]."'>Eliminar Plan de Suscripción</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Cerrar'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        ¿Estás seguro de que deseas eliminar este plan de suscripción?
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                        <a class='btn btn-danger' href='index.php?c=Suscripcion&a=eliminarSuscripcion&id=".$dato["id_suscripcion"]."'>Eliminar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";

                                    // Agregamos el modal de edición
                                    echo "<div class='modal fade' id='editarModal_".$dato["id_suscripcion"]."' tabindex='-1' role='dialog' aria-labelledby='editarModalLabel_".$dato["id_suscripcion"]."' aria-hidden='true'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title' id='editarModalLabel_".$dato["id_suscripcion"]."'>Actualizar ".$data['titulo']."</h5>
                                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                            <span aria-hidden='true'>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <!-- Formulario de edición -->
                                                        <form id='editarForm_".$dato["id_suscripcion"]."' method='POST' action='index.php?c=Suscripcion&a=actualizarSuscripcion' autocomplete='off' class='needs-validation' novalidate>
                                                            <div class='mb-3'>
                                                                <label for='suscripcion' class='form-label'>Suscripcion</label>
                                                                <input type='text' class='form-control' id='suscripcion' name='suscripcion' required value='".$dato["suscripcion"]."'>
                                                                <div class='valid-feedback'>
                                                                    ¡Se ve bien!
                                                                </div>
                                                                <div class='invalid-feedback'>
                                                                    Por favor, ingrese una suscripción válida.
                                                                </div>
                                                            </div>

                                                            <div class='mb-3'>
                                                                <label for='duracion_dias' class='form-label'>Duracion Dias</label>
                                                                <input type='number' class='form-control' id='duracion_dias' name='duracion_dias' required value='".$dato["duracion_dias"]."'>
                                                                <div class='valid-feedback'>
                                                                    ¡Se ve bien!
                                                                </div>
                                                                <div class='invalid-feedback'>
                                                                    Por favor, ingrese una duración de días válida.
                                                                </div>
                                                            </div>

                                                            <div class='mb-3'>
                                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                                <button type='submit' class='btn btn-primary'>Actualizar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                echo"</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal para Agregar Plan -->
<div class='modal fade' id='agregarModal' tabindex='-1' role='dialog' aria-labelledby='agregarModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title' id='agregarModalLabel'>Agregar Nuevo Plan de Suscripción</h5>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class='modal-body'>
                <!-- Formulario de Agregar Plan -->
                <form id='nuevo' name='nuevo' method='POST' action='index.php?c=Suscripcion&a=guardarSuscripcion' autocomplete='off' class='needs-validation' novalidate>
                    <h2 class='mt-4 mb-4'>Registro <?php echo $data['titulo'];?></h2>

                    <div class='mb-3'>
                        <label for='suscripcion' class='form-label'>Suscripcion</label>
                        <input type='text' class='form-control' id='suscripcion' name='suscripcion' required>
                        <div class='valid-feedback'>
                            ¡Se ve bien!
                        </div>
                        <div class='invalid-feedback'>
                            Por favor, ingrese una suscripción válida.
                        </div>
                    </div>

                    <div class='mb-3'>
                        <label for='duracion_dias' class='form-label'>Duracion Dias</label>
                        <input type='number' class='form-control' id='duracion_dias' name='duracion_dias' required>
                        <div class='valid-feedback'>
                            ¡Se ve bien!
                        </div>
                        <div class='invalid-feedback'>
                            Por favor, ingrese una duración de días válida.
                        </div>
                    </div>

                    <div class='mb-3'>
                        <button id='guardar' name='guardar' type='submit' class='btn btn-primary'>Registrar</button>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("./src/View/templates/footer_administrador.php")?>

<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
<script src='https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js'></script>
<script src='https://kit.fontawesome.com/your-fontawesome-kit.js'></script> <!-- Reemplaza 'your-fontawesome-kit.js' con el enlace proporcionado por Font Awesome -->

<script>
    $(document).ready(function () {
        $('#tabla_id').DataTable();
    });
</script>

</body>
</html>
