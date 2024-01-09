
<?php include("./src/View/templates/header_usuario.php")?>

<br>
<main>
    <link rel="stylesheet" href="./public/css/plan_nutricional_ver_pacientes.css">
    <h2 class="titulo">Lista Planes Nutricionales</h2>

    <table border="1" width="60%" class="tabla_id" id="tabla_id">

        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Duración Dias</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['plan_nutricional'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['nombres']."</td>";
                        echo"<td>".$dato['apellidos']."</td>";
                        echo"<td>".$dato['fecha_inicio']."</td>";
                        echo"<td>".$dato['fecha_fin']."</td>";
                        echo"<td>".$dato['duracion_dias']."</td>";
                        echo "<td><a class='btnAcciones' href='index.php?c=pacienteDetalleComida&a=verDetalleComidas&id=".$dato["id_plan_nutricional"]."'>Ver Comidas</a>";
                    echo"</tr>";
                }
            ?>

        </tbody>

    </table>
</main>
</html>

<?php include("./src/View/templates/footer_usuario.php")?>