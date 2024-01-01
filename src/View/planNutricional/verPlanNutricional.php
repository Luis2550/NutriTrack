
<?php include("./src/View/templates/header_administrador.php")?>


<main>
    <h2>Lista Planes Nutricionales</h2>

    <table border="1" width="60%">

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
                <th>Editar</th>
                <th>Eliminar</th>
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
                        echo "<td><a href='index.php?c=planNutricional&a=modificarPlanNutricional&id=".$dato["id_plan_nutricional"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=planNutricional&a=eliminarPlanNutricional&id=".$dato["id_plan_nutricional"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</main>
</html>

<?php include("./src/View/templates/footer_administrador.php")?>