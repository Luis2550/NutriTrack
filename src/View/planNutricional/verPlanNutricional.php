<?php include("./src/View/templates/header_administrador.php")?>

<br>
<main>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">
    <h2 class="titulo">Agregar comidas</h2>
    <a class="btnNuevo" href='http://localhost/nutritrack/index.php?c=PlanNutricional&a=nuevoPlanNutricional'>Nuevo Plan Nutricional</a>
    <h2 class="titulo">Plan nutricional</h2>
    <a class="btnNuevo" href='http://localhost/nutritrack/index.php?c=PlanNutricional&a=nuevoPlanNutricional'>Nuevo Plan Nutricional</a>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="tabla_id">

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
                                <a class='btn btn-info' href='index.php?c=DetalleComida&a=insertar_or_verDetalleComidas&id=".$dato["id_plan_nutricional"]."'>Añadir Comidas</a>
                                <a class='btn btn-warning' href='index.php?c=planNutricional&a=modificarPlanNutricional&id=".$dato["id_plan_nutricional"]."'>Modificar</a>
                                <a onclick=\"return confirm('¿Estás seguro de que deseas eliminar este plan nutricional?');\" class='btn btn-danger' href='index.php?c=planNutricional&a=eliminarPlanNutricional&id=".$dato["id_plan_nutricional"]."'>Eliminar</a>
                            </td>";
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
        $('#tabla_id').DataTable();
    });
</script>

</html>

<?php include("./src/View/templates/footer_administrador.php")?>
