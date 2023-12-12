<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Citas</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Paciente</th>
                <th>Cedula Paciente</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Cedula Nutriologa</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['citas'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_cita']."</td>";
                        echo"<td>".$dato['ci_paciente']."</td>";
                        echo"<td>".$dato['fecha']."</td>";
                        echo"<td>".$dato['hora_inicio']."</td>";
                        echo"<td>".$dato['hora_fin']."</td>";
                        echo"<td>".$dato['ci_nutriologa']."</td>";
                        
                        echo "<td><a href='index.php?c=Citas&a=modificarCitas&id=".$dato["id_cita"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Citas&a=eliminarCitas&id=".$dato["id_cita"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>