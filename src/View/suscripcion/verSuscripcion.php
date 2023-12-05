<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Suscripcion</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Suscripcion</th>
                <th>Suscripcion</th>
                <th>Duracion Dias</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['suscripcion'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_suscripcion']."</td>";
                        echo"<td>".$dato['suscripcion']."</td>";
                        echo"<td>".$dato['duracion_dias']."</td>";
                        echo"<td>".$dato['estado']."</td>";
                        
                        echo "<td><a href='index.php?c=Suscripcion&a=modificarSuscripcion&id=".$dato["id_suscripcion"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Suscripcion&a=eliminarSuscripcion&id=".$dato["id_suscripcion"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>