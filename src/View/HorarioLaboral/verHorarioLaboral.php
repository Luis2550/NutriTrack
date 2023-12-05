<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo']; ?></title>
</head>
<body>
    <h2>Horario Laboral</h2>
    <br>
    <br>
    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Horario Laboral</th>
                <th>ID Configuración</th>
                <th>Día Inicio</th>
                <th>Día Fin</th>
                <th>Descripción</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Cantidad de Horas Laborales</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['horarioLaboral'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_horario_laboral']."</td>";
                        echo"<td>".$dato['id_configuracion']."</td>";
                        echo"<td>".$dato['dia_inicio']."</td>";
                        echo"<td>".$dato['dia_fin']."</td>";
                        echo"<td>".$dato['descripcion']."</td>";
                        echo"<td>".$dato['hora_inicio']."</td>";
                        echo"<td>".$dato['hora_fin']."</td>";
                        echo"<td>".$dato['cantidad_horas_laborales']."</td>";
                        echo "<td><a href='index.php?c=HorarioLaboral&a=modificarHorarioLaboral&id=".$dato["id_horario_laboral"]."'>Modificar</a></td>";
                        echo "<td><a href='index.php?c=HorarioLaboral&a=eliminarHorarioLaboral&id=".$dato["id_horario_laboral"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>
