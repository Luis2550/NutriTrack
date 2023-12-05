<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Detalle Comida</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Comida</th>
                <th>Comida</th>
                <th>Id Plan Nutricional</th>
                <th>Cedula Nutriologa</th>
                <th>Cedula Paciente</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['detalle_comida'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_comida']."</td>";
                        echo"<td>".$dato['comida']."</td>";
                        echo"<td>".$dato['id_plan_nutricional']."</td>";
                        echo"<td>".$dato['ci_nutriologa']."</td>";
                        echo"<td>".$dato['ci_paciente']."</td>";

                        echo "<td><a href='index.php?c=DetalleComida&a=modificarDetalleComida&id=".$dato["id_comida"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=DetalleComida&a=eliminarDetalleComida&id=".$dato["id_comida"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>