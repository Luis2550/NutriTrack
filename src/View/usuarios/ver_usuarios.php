<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo'];?></title>
</head>
<body>
    <h2>Ver Usuarios</h2>

    <table border="1" width="60%">

        <thead>
            <tr>
                <th>Cédula</th>
                <th>Rol</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Edad</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Sexo</th>
                <th>Foto</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['usuarios'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['ci_usuario']."</td>";
                        echo"<td>".$dato['rol']."</td>";
                        echo"<td>".$dato['nombres']."</td>";
                        echo"<td>".$dato['apellidos']."</td>";
                        echo"<td>".$dato['edad']."</td>";
                        echo"<td>".$dato['correo']."</td>";
                        echo"<td>".$dato['clave']."</td>";
                        echo"<td>".$dato['sexo']."</td>";
                        echo"<td>".$dato['foto']."</td>";
                        echo "<td><a href='index.php?c=Usuarios&a=modificarUsuarios&id=".$dato["ci_usuario"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Usuarios&a=eliminarUsuarios&id=".$dato["ci_usuario"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>