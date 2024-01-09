<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_historialMed"> 
   
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>


    <h2>Ver Historial Medidas</h2>

    <a
        name=""
        id=""
        class="btn btn-primary"
        href="http://localhost/nutritrack/index.php?c=historialMedidas&a=nuevoHistorialMedidas"
        role="button"
        >Agregar</a
    >
    
    <br>
    <br>

    <table border="1" width="60%" id="tabla_id">

        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Peso</th>
                <th>Estatura</th>
                <th>Presion Arterial Sistolica</th>
                <th>Presion Arterial Diastolica</th>
                <th>Fecha</th>
                <th>Acciones</th>

            </tr>
        </thead>

        <tbody>

            <?php
                foreach($data['historial_medidas'] as $dato){
                    echo"<tr>";
                        echo"<td>".$dato['ci_usuario']."</td>";
                        echo"<td>".$dato['nombres']."</td>";
                        echo"<td>".$dato['apellidos']."</td>";
                        echo"<td>".$dato['peso']."</td>";
                        echo"<td>".$dato['estatura']."</td>";
                        echo"<td>".$dato['presion_arterial_sistolica']."</td>";
                        echo"<td>".$dato['presion_arterial_diastolica']."</td>";
                        echo"<td>".$dato['fecha']."</td>";
                
                        echo "<td class='celda-acciones'>
                            <a class='btn btn-modificar' href='index.php?c=historialMedidas&a=modificarHistorialMedidas&id=".$dato["id_historial_medidas"]."'>Modificar</a>
                            <a class='btn btn-eliminar' href='index.php?c=historialMedidas&a=eliminarHistorialMedidas&id=".$dato["id_historial_medidas"]."'>Eliminar</a>
                        </td>";
                    echo "</tr>";

                }
            ?>
        </tbody>
    </table>

    <?php include("./src/View/templates/footer_administrador.php")?>
