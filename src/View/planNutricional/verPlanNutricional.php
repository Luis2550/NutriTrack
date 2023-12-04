<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver plan Nutricional</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>Ci Nutriologo</th>
                <th>Ci Paciente</th>
                <th>fecha inicio</th>
                <th>fecha fin</th>
                <th>duracion Dias</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['plan_nutricional'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['ci_nutriologa']."</td>";
                        echo"<td>".$dato['ci_paciente']."</td>";
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
</body>
</html>