
<?php include("./src/View/templates/header_administrador.php")?>

<br>
<main>
    <script>

    </script>
    
    <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">
    <h2 class="titulo">Lista Planes Nutricionales</h2>
    <a class="btnNuevo" href='http://localhost/nutritrack/index.php?c=PlanNutricional&a=nuevoPlanNutricional'>Nuevo Plan Nutricional</a>

    <table border="1" width="60%" class="tabla_id" id="tabla_id">

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
                        echo "<td><a class='btnAcciones' href='index.php?c=DetalleComida&a=insertar_or_verDetalleComidas&id=".$dato["id_plan_nutricional"]."'>Añadir Comidas</a>";
                        echo "<a class='btnAcciones' href='index.php?c=planNutricional&a=modificarPlanNutricional&id=".$dato["id_plan_nutricional"]."'>Modificar</a>";
                        echo "<a onclick=\"return confirm('¿Estás seguro de que deseas eliminar este plan nutricional?');\" class='btnAcciones' href='index.php?c=planNutricional&a=eliminarPlanNutricional&id=".$dato["id_plan_nutricional"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</main>
</html>

<?php include("./src/View/templates/footer_administrador.php")?>