<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Historial Medidas</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>Id_Historial Clinico</th>
                <th>peso</th>
                <th>estaura</th>
                <th>Presion Arterial Sistolica</th>
                <th>Presion Arterial Distolica</th>
                <th>fecha</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['historial_medidas'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_historial_clinico']."</td>";
                        echo"<td>".$dato['peso']."</td>";
                        echo"<td>".$dato['estatura']."</td>";
                        echo"<td>".$dato['presion_arterial_sistolica']."</td>";
                        echo"<td>".$dato['presion_arterial_diastolica']."</td>";
                        echo"<td>".$dato['fecha']."</td>";
                        echo "<td><a href='index.php?c=historialMedidas&a=modificarHistorialMedidas&id=".$dato["id_historial_medidas"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=historialMedidas&a=eliminarHistorialMedidas&id=".$dato["id_historial_medidas"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>