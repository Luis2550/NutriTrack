<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Pcientes</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>Cedula Paciente</th>
                <th>Suscripcion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['pacientes'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['ci_paciente']."</td>";
                        echo"<td>".$dato['id_suscripcion']."</td>";

                        echo "<td><a href='index.php?c=Pacientes&a=modificarPacientes&id=".$dato["ci_paciente"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Pacientes&a=eliminarPacientes&id=".$dato["ci_paciente"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>