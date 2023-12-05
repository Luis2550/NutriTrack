<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Calendario de Citas</h2>
    <br>
    <br>
    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Calendario Citas</th>
                <th>Cédula Paciente</th>
                <th>Cédula Nutriologa</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Estado</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['calendarioCitas'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_calendario_citas']."</td>";
                        echo"<td>".$dato['ci_paciente']."</td>";
                        echo"<td>".$dato['ci_nutriologa']."</td>";
                        echo"<td>".$dato['fecha']."</td>";
                        echo"<td>".$dato['hora_inicio']."</td>";
                        echo"<td>".$dato['hora_fin']."</td>";
                        echo"<td>".$dato['estado']."</td>";
                        echo "<td><a href='index.php?c=CalendarioCitas&a=modificarCalendarioCitas&id=".$dato["id_calendario_citas"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=CalendarioCitas&a=eliminarCalendarioCitas&id=".$dato["id_calendario_citas"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>