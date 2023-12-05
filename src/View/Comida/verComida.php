<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comida</title>
</head>
<body>
    <h2>Lista de Comidas</h2>
    <br>
    <br>
    <table border="1" width="60%">

        <thead>
            <tr>
                <th>ID Comida</th>
                <th>Comida</th>
                <th>Número de Comidas</th>
                <th>Día</th>
                <th>Descripción</th>
                <th>Cantidad de Proteína</th>
                <th>Cantidad de Carbohidratos</th>
                <th>Cantidad de Grasas Saludables</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['comida'] as $dato){
                    echo "<tr>";
                        echo "<td>".$dato['id_comida']."</td>";
                        echo "<td>".$dato['comida']."</td>";
                        echo "<td>".$dato['numero_comidas']."</td>";
                        echo "<td>".$dato['dia']."</td>";
                        echo "<td>".$dato['descripcion']."</td>";
                        echo "<td>".$dato['cantidad_proteina']."</td>";
                        echo "<td>".$dato['cantidad_carbohidratos']."</td>";
                        echo "<td>".$dato['cantidad_grasas_saludables']."</td>";
                        echo "<td><a href='index.php?c=Comida&a=modificarComida&id=".$dato["id_comida"]."'>Modificar</a></td>";
                        echo "<td><a href='index.php?c=Comida&a=eliminarComida&id=".$dato["id_comida"]."'>Eliminar</a></td>";
                    echo "</tr>";
                }
            ?>

        </tbody>

    </table>
</body>
</html>
