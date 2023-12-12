<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Actividades</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>Cedula Paciente</th>
                <th>Actividad</th>
                <th>Descripcion</th>
                <th>Fecha</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['actividad'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['ci_paciente']."</td>";
                        echo"<td>".$dato['actividad']."</td>";
                        echo"<td>".$dato['descripcion']."</td>";
                        echo"<td>".$dato['fecha']."</td>";
                        echo "<td><a href='index.php?c=actividad&a=modificarActividad&id=".$dato["id_actividad"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=actividad&a=eliminarActividad&id=".$dato["id_actividad"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>