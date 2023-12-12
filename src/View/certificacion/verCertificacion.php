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
                <th>ID Certificacion</th>
                <th>Cedula Nutriologa</th>
                <th>Titulo</th>
                <th>Archivo</th>
           
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['certificacion'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['id_certificacion']."</td>";
                        echo"<td>".$dato['ci_nutriologa']."</td>";
                        echo"<td>".$dato['titulo']."</td>";
                        echo"<td>".$dato['archivo']."</td>";
            
                        
                        echo "<td><a href='index.php?c=Certificacion&a=modificarCertificacion&id=".$dato["id_certificacion"]."'>Modificar</a></td>";
						echo "<td><a href='index.php?c=Certificacion&a=eliminarCertificacion&id=".$dato["id_certificacion"]."'>Eliminar</a></td>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>