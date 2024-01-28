<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planes Suscripción</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha384-oG1JUpLhKoFY83KstwNU+J4dX25F1q5sOFJ31qK4vgoiSQe8ZQFqAtvjM2SLZXuJ" crossorigin="anonymous">
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

            <div class="d-flex justify-content-end mb-3">
                <a href='http://localhost/NutriTrack/index.php?c=Suscripcion&a=nuevoSuscripcion' class='btn btn-success'>
                    <i class='fas fa-plus-circle'></i> Agregar Plan
                </a>
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
                                echo "<tr>";
                                    echo "<td>".$dato['suscripcion']."</td>";
                                    echo "<td>".$dato['duracion_dias']."</td>";
                                    echo "<td><a href='index.php?c=Suscripcion&a=modificarSuscripcion&id=".$dato["id_suscripcion"]."' class='btn btn-outline-success btn-sm'><i class='fas fa-edit'></i></a></td>
                                    <td><button type='button' class='btn btn-outline-danger btn-sm' data-toggle='modal' data-target='#eliminarModal_".$dato["id_suscripcion"]."'><i class='fas fa-trash-alt border-0'></i></button></td>";
                                   
                                    echo "<div class='modal fade' id='eliminarModal_".$dato["id_suscripcion"]."' tabindex='-1' role='dialog' aria-labelledby='eliminarModalLabel_".$dato["id_suscripcion"]."' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='eliminarModalLabel_".$dato["id_suscripcion"]."'>Confirmar Eliminación</h5>
                                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                        <span aria-hidden='true'>&times;</span>
                                                    </button>
                                                </div>
                                                <div class='modal-body'>
                                                    ¿Estás seguro de que deseas eliminar este dato?
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>
                                                    <a href='index.php?c=Suscripcion&a=eliminarSuscripcion&id=".$dato["id_suscripcion"]."' class='btn btn-danger'>Eliminar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                                
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<!-- Modal para Agregar Suscripción -->


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
