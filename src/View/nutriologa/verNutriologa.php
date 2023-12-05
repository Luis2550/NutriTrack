<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Nutrologa</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>Ci Nutriologa</th>
                <th>cantidad_cupos</th>
                <th>certificacion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['nutriologa'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['ci_nutriologa']."</td>";
                        echo"<td>".$dato['cantidad_cupos']."</td>";
                        echo"<td>".$dato['certificacion']."</td>";
                        echo "<td><a href='index.php?c=nutriologa&a=modificarNutriologa&id=".$dato["ci_nutriologa"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=nutriologa&a=eliminarNutriologa&id=".$dato["ci_nutriologa"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>