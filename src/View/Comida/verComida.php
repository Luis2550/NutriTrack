<?php
    #Verificar el inicio de sesión
    session_start();

    // Verifica si hay una sesión activa
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
        header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
        exit();
    }

?>


        <?php include("./src/View/templates/header_administrador.php")?>
        
        <!-- Contenido principal -->
        
            <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">
            
            <h2 class="titulo">Banco de Comidas</h2>
            <a class="btnNuevo" href='http://localhost/nutritrack/index.php?c=Comida&a=nuevaComida'>Nueva Comida</a>
            
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
                            <th>ID</th>
                            <th>Comida</th>
                            <th>Tipo Comida</th>
                            <th>Descripción</th>
                            <th>Cantidad de Proteína</th>
                            <th>Cantidad de Carbohidratos</th>
                            <th>Cantidad de Grasas Saludables</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                            foreach($data['comida'] as $dato){
                                echo "<tr>";
                                    echo "<td>".$dato['id_comida']."</td>";
                                    echo "<td>".$dato['comida']."</td>";
                                    echo "<td>".$dato['tipo_comida']."</td>";
                                    echo "<td>".$dato['descripcion']."</td>";
                                    echo "<td>".$dato['cantidad_proteina']."</td>";
                                    echo "<td>".$dato['cantidad_carbohidratos']."</td>";
                                    echo "<td>".$dato['cantidad_grasas_saludables']."</td>";
                                    echo "<td>
                                        <a onclick=\"return confirm('Al modificar está comida, se modificará en cada plan nutricional que se haya agregado esta comida.'+ String.fromCharCode(10) +'¿Esta segur@ de que desea modificar esta comida?');\" class='btn btn-warning' href='index.php?c=Comida&a=modificarComida&id=".$dato["id_comida"]."'><i class='fas fa-pencil-alt'></i></a>
                                        <a onclick=\"return confirm('Al modificar está comida, se eliminará en cada plan nutricional que se haya agregado esta comida.'+ String.fromCharCode(10) +'¿Esta segur@ de que desea eliminar está comida?');\" class='btn btn-danger'href='index.php?c=Comida&a=eliminarComida&id=".$dato["id_comida"]."'><i class='fas fa-trash'></i></a>
                                    </td>";
                                echo "</tr>";
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
    </body>

<?php include("./src/View/templates/footer_administrador.php")?>