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
                <th>ID</th>
                <th>Cédula Nutriologa</th>
                <th>Días Laborales</th>
                <th>Duracion Cita (minutos)</th>
                <th>Día Laboral Inicio</th>
                <th>Día Laboral Fin</th>
                <th>Descripción</th>
                <th>Hora Laboral Inicio</th>
                <th>Hora Laboral Fin</th>
                <th>Hora Descanso Inicio</th>
                <th>Hora Descando Fin</th>
                <th>Cantidad Horas Laborales</th>
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
                        echo"<td>".$dato['dia_inicio']."</td>";
                        echo"<td>".$dato['dia_fin']."</td>";
                        echo"<td>".$dato['descripcion']."</td>";
                        echo"<td>".$dato['hora_inicio']."</td>";
                        echo"<td>".$dato['hora_fin']."</td>";
                        echo"<td>".$dato['hora_descanso_inicio']."</td>";
                        echo"<td>".$dato['hora_descanso_fin']."</td>";
                        echo"<td>".$dato['cantidad_horas_laborales']."</td>";
                        echo "<td><a href='index.php?c=Configuracion&a=modificarConfiguraciones&id=".$dato["id_configuracion"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Configuracion&a=eliminarConfiguraciones&id=".$dato["id_configuracion"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>