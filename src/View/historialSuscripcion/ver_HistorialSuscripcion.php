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
                <th>ID Suscripcion</th>
                <th>Cédula Paciente</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['historialsuscripciones'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_suscripcion']."</td>";
                        echo"<td>".$dato['ci_paciente']."</td>";
                        echo"<td>".$dato['fecha_inicio']."</td>";
                        echo"<td>".$dato['fecha_fin']."</td>";

                        echo "<td><a href='index.php?c=HistorialSuscripcion&a=modificarHistorialSuscripcion&id=".$dato["id_suscripcion"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=HistorialSuscripcion&a=eliminarHistorialSuscripcion&id=".$dato["id_suscripcion"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>