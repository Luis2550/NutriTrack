<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Roles</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Rol</th>
                <th>Rol</th>
                <th>Descripcion</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['rol'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_rol']."</td>";
                        echo"<td>".$dato['rol']."</td>";
                        echo"<td>".$dato['descripcion']."</td>";
                        
                        echo "<td><a href='index.php?c=Rol&a=modificarRol&id=".$dato["id_rol"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Rol&a=eliminarRol&id=".$dato["id_rol"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>