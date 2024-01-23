<!DOCTYPE html>
<html lang="es">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Ver Plan Nutricional</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
  </head>
  
  <body>

<?php
  session_start();

  // Verifica si hay una sesión activa
  if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
  }

?>

<?php include("./src/View/templates/header_usuario.php")?>

<br>
<main>
    <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">
    <h2 class="titulo">Lista Planes Nutricionales</h2>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">

    <br><br>

    <div class="fecha" style="font-weight: bold;">
        <?php
            // Obtén la fecha actual
            $fechaActual = date('m-d-Y');

            // Imprime la fecha en el formato mes-día-año
            echo "Fecha: " . $fechaActual;
        ?>
    </div>
    <br>

    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="tabla_id">

            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Duración Dias</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <?php
                    foreach($data['plan_nutricional'] as $dato){
                        echo"<tr>";
                            echo"<td>".$dato['nombres']."</td>";
                            echo"<td>".$dato['apellidos']."</td>";
                            echo"<td>".$dato['fecha_inicio']."</td>";
                            echo"<td>".$dato['fecha_fin']."</td>";
                            echo"<td>".$dato['duracion_dias']."</td>";
                            echo "<td><a class='btn btn-warning' href='index.php?c=pacienteDetalleComida&a=verDetalleComidas&id=".$dato["id_plan_nutricional"]."'><i class='fas fa-eye'></i>";
                        echo"</tr>";
                    }
                ?>

            </tbody>

        </table>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>


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
</script>

<?php include("./src/View/templates/footer_administrador.php")?>