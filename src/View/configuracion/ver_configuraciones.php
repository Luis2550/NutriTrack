<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Pacientes</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Configuracion</th>
                <th>Cédula Nutriologa</th>
                <th>Días Laborales</th>
                <th>Duracion Cita (minutos)</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['configuraciones'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_configuracion']."</td>";
                        echo"<td>".$dato['ci_nutriologa']."</td>";
                        echo"<td>".$dato['dias_laborales']."</td>";
                        echo"<td>".$dato['duracion_cita']."</td>";

                        echo "<td><a href='index.php?c=Configuracion&a=modificarConfiguraciones&id=".$dato["id_configuracion"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Configuracion&a=eliminarConfiguraciones&id=".$dato["id_configuracion"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>