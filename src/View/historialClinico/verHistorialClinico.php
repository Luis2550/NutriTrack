<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Historial Clinico</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>Cedula Paciente</th>
                <th>Fecha Creacion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['historial_clinico'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['ci_paciente']."</td>";
                        echo"<td>".$dato['fecha_creacion']."</td>";
                        echo "<td><a href='index.php?c=historialClinico&a=modificarHistorialClinico&id=".$dato["id_historial_clinico"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=historialClinico&a=eliminarHistorialClinico&id=".$dato["id_historial_clinico"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>