<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Enfermedad Previa</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Enfermedad Previa</th>
                <th>ID Historial Clinico</th>
                <th>Enfermedad Previa</th>
                <th>Descripcion</th>
                <th>Fecha de Registro de Enfermdad</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['enfermedadesprev'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_enfermedad_previa']."</td>";
                        echo"<td>".$dato['id_historial_clinico']."</td>";
                        echo"<td>".$dato['enfermedad_previa']."</td>";
                        echo"<td>".$dato['descripcion']."</td>";
                        echo"<td>".$dato['fecha']."</td>";

                        echo "<td><a href='index.php?c=EnfermedadPrevia&a=modificarEnfermedadPrevia&id=".$dato["id_enfermedad_previa"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=EnfermedadPrevia&a=eliminarEnfermedadPrevia&id=".$dato["id_enfermedad_previa"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>