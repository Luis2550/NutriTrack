<?php
    #Verificar el inicio de sesión
    session_start();

    // Verifica si hay una sesión activa
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
        header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ver Planes Nutricionales</title>
        <!--Este enlace es estático-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!--Estos enlace son dinámicos-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    </head>



    <body>
        <?php include("./src/View/templates/header_admin.php")?>
        <br>
        <!-- Contenido principal -->
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4 main-content">
        <!-- Contenido de la página aquí -->
            <main>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
                <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">
                <h2 class="titulo">Agregar Comidas</h2>
                <a class="btnNuevo" href='http://localhost/nutritrack/index.php?c=Comida&a=verComida'>Ver Comidas</a>
                <h2 class="titulo">Lista de los Planes Nutricionales</h2>
                <a class="btnNuevo" href='http://localhost/nutritrack/index.php?c=PlanNutricional&a=nuevoPlanNutricional'>Nuevo Plan Nutricional</a>
                
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
                    <table class="table table-bordered dataTable" id="tabla_id" style="width:100%">

                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Sexo</th>
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
                                        echo"<td>".$dato['ci_usuario']."</td>";
                                        echo"<td>".$dato['nombres']."</td>";
                                        echo"<td>".$dato['apellidos']."</td>";
                                        echo"<td>".$dato['edad']."</td>";
                                        echo"<td>".$dato['sexo']."</td>";
                                        echo"<td>".$dato['fecha_inicio']."</td>";
                                        echo"<td>".$dato['fecha_fin']."</td>";
                                        echo"<td>".$dato['duracion_dias']."</td>";
                                        echo "<td>
                                            <a class='btn btn-info' href='index.php?c=DetalleComida&a=insertar_or_verDetalleComidas&id=".$dato["id_plan_nutricional"]."'><!---<i class='fas fa-plus'></i>-->Agregar Comidas</a>
                                            <a class='btn btn-warning' href='index.php?c=planNutricional&a=modificarPlanNutricional&id=".$dato["id_plan_nutricional"]."'><i class='fas fa-pencil-alt'></i></a>
                                            <a onclick=\"return confirm('¿Esta segur@ de que desea eliminar este plan nutricional?');\" class='btn btn-danger' href='index.php?c=planNutricional&a=eliminarPlanNutricional&id=".$dato["id_plan_nutricional"]."'><i class='fas fa-trash'></i></a>
                                        </td>";
                                    echo"</tr>";
                                }
                            ?>
                        </tbody>

                    </table>
                </div>
            </main>
        </main>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>




        <script>
            $(document).ready(function () {
                $('#tabla_id').DataTable({
                    "autoWidth": true,
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
    </body>

<?php include("./src/View/templates/footer_admin.php")?>