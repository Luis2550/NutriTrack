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
            <h2 class="title mb-4">Planes de Suscripción </h2>

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
                                    echo "<td><a href='index.php?c=Suscripcion&a=modificarSuscripcion&id=".$dato["id_suscripcion"]."' class='btn btn-success mb-2'><i class='fa-solid fa-pen-to-square' style='color: #fff;'></i></a></td>
                                    <td><button class='btn btn-danger mb-2' onclick='confirmarEliminar(".$dato['id_suscripcion'].")'><i class='fa-solid fa-trash' style='color: #fff;'></i></button></td>";
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
        $('#tabla_id').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                
            }
        });
    });

    function confirmarEliminar(idSuscripcion) {
        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás revertir esto",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo"
        }).then((result) => {
            if (result.isConfirmed) {
                // Redireccionar a la página de eliminar con la confirmación
                window.location.href = "index.php?c=suscripcion&a=eliminarSuscripcion&id=" + idSuscripcion;
            }
        });
    }
</script>

</body>
</html>
