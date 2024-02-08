<?php
    #Verificar el inicio de sesión
    session_start();

    // Verifica si hay una sesión activa
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
        header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
        exit();
    }

?>

<script>
    <?php
    if (!empty($mensaje)) {
        echo "Swal.fire({
            title: '¡Cuidado!',
            text: '$mensaje',
            icon: 'error'
        });";
    }
    ?>
</script>
        <?php include("./src/View/templates/header_administrador.php")?>
        <?php
                // Verificar si hay un mensaje de error presente
                $error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';

                // Mostrar el mensaje de error si está presente
                if (!empty($error_message)) {
                    // Mostrar la alerta de error con el mensaje correspondiente
                    echo '<script>
                            document.addEventListener("DOMContentLoaded", function () {
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Error",
                                    text: "' . htmlspecialchars($error_message) . '",
                                    showConfirmButton: true,
                                });
                            });
                        </script>';
                }
        ?> 
        <!-- Contenido principal -->
        
            <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">
            
            <h2 class="titulo">Banco de Comidas</h2>
            <a class="btnNuevo" href='http://localhost/nutritrack/index.php?c=Comida&a=nuevaComida'><i class="fas fa-plus" style="margin-right: 10px;"></i><strong> Nueva Comida</strong></a>
            <script src="./public/js/verComida.js"></script>
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
                                            <a  class='btn btn-warning' href='index.php?c=Comida&a=modificarComida&id=".$dato["id_comida"]."'><i class='fas fa-pencil-alt'></i></a>
                                            <a onclick='return confirmarEliminarComida(".$dato["id_comida"].")' class='btn btn-danger'href='index.php?c=Comida&a=eliminarComida&id=".$dato["id_comida"]."'><i class='fas fa-trash'></i></a>
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