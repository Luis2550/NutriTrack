<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

usort($data['historial_medidas'], function($a, $b) {
    return strtotime($a['fecha']) - strtotime($b['fecha']);
});

?>

<?php include("./src/View/templates/header_administrador.php")?>


<main class="main main_historialMed"> 
    
    <br>
    <h2 class="titulo_h2 text-center">Ver Historial Medidas</h2>
    <br>

    <?php 
        foreach ($histClinico['datos'] as $dato) {
            // Mostrar la carta solo cuando $dato['ci_usuario'] sea igual a $data['ci_usuario']
            if ($dato['ci_paciente'] == $data['ci_usuario']) {
    
                $cedula = $data['ci_usuario'];
                $id_clinico = $dato['id_historial_clinico']; // Cambiado a 'id_historial_clinico'

            }
        }

    ?>


    <a
        name=""
        id=""
        class="btn btn-primary"
        href="http://localhost/nutritrack/index.php?c=historialMedidas&a=nuevoHistorialMedidas&id=<?php echo $id_clinico; ?>"
        role="button"
        >Agregar</a
    >
    
    <br>
    <br>

    <div class="historial-container">
    <?php
    if (isset($data['historial_medidas']) && is_array($data['historial_medidas'])) {
        echo "<div class='pizarra'>";
        // Arrays para almacenar datos del peso y la fecha
        $pesosArray = [];
        $fechasArray = [];
        foreach ($data['historial_medidas'] as $dato) {
            // Mostrar la carta solo cuando $dato['ci_usuario'] sea igual a $data['ci_usuario']
            if ($dato['ci_usuario'] == $data['ci_usuario']) {
                echo "<div class='notita'>";
                echo "<p class='card-text mb-1'><strong>Cédula:</strong> " . $dato['ci_usuario'] . "</p>";
                echo "<p class='card-text mb-1'><strong>Nombres:</strong> " . $dato['nombres'] . "</p>"; // Agregado
                echo "<p class='card-text mb-1'><strong>Apellidos:</strong> " . $dato['apellidos'] . "</p>";
                echo "<p class='card-text mb-1'><strong>Peso:</strong> " . $dato['peso'] . "</p>";
                echo "<p class='card-text mb-1'><strong>Estatura:</strong> " . $dato['estatura'] . "</p>";
                echo "<p class='card-text mb-1'><strong>Presion Arterial Sistolica:</strong> " . $dato['presion_arterial_sistolica'] . "</p>";
                echo "<p class='card-text mb-1'><strong>Presion Arterial Diastolica:</strong> " . $dato['presion_arterial_diastolica'] . "</p>";
                echo "<p class='card-text mb-3'><strong>Fecha:</strong> " . $dato['fecha'] . "</p>";
                echo "<div class='celda-acciones'>
                        <a class='btn btn-modificar' href='index.php?c=historialMedidas&a=modificarHistorialMedidas&id=".$dato["id_historial_medidas"]."'>Modificar</a>
                        <a class='btn btn-eliminar' href='index.php?c=historialMedidas&a=eliminarHistorialMedidas&id=".$dato["id_historial_medidas"]."&ci_usuario=".$cedula."'>Eliminar</a>
                      </div>";
                echo "</div>";

                // Almacenar datos del peso y la fecha que cumplen con la condición
                $pesosArray[] = $dato['peso'];
                $fechasArray[] = $dato['fecha'];
            }
        }
        echo "</div>";
    } else {
        // No hay historial de medidas para mostrar
        echo "<p>No hay historial de medidas disponibles.</p>";
    }
    ?>
</div>


    <!-- Gráfica de Historial de Pesos -->
    <div class="grafica" style="width: 80%; margin: auto;">
        <canvas class="grafica-2" id="pesoChart"></canvas>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="http://localhost/nutritrack/index.php?c=historialClinico&a=verHistorialClinicoSecuencial&ci_usuario=<?php echo $data['ci_usuario']; ?>"
            role="button"
        >
            Regresar
        </a>

        <a
            name=""
            id=""
            class="btn btn-primary"
            href="http://localhost/nutritrack/index.php?c=Actividad&a=verActividad&ci_usuario=<?php echo $data['ci_usuario']; ?>"
            role="button"
        >
            Siguiente
        </a>
    </div>
</main>

<!-- Estilos CSS para la Pizarra con Notitas -->
<style>
    /* Estilos para la Pizarra con Notitas */
    .pizarra {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .notita {
        background-color: #ffebcd; /* Fondo de color blanco almendra */
        border: 2px solid #deb887; /* Borde marrón burlywood */
        border-radius: 8px;
        padding: 10px;
        width: calc(33.333% - 20px); /* Ajusta según tus necesidades */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .celda-acciones {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 10px;
        text-decoration: none;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-modificar {
        background-color: #28a745;
    }

    .btn-eliminar {
        background-color: #dc3545;
    }

    /* Otros estilos según necesidades */
</style>

<!-- JavaScript para la Gráfica de Historial de Pesos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos del historial de pesos
    var fechas = <?php echo json_encode($fechasArray); ?>;
    var pesos = <?php echo json_encode($pesosArray); ?>;

    // Configurar datos para el gráfico
    var ctx = document.getElementById('pesoChart').getContext('2d');
    var pesoChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: fechas,
            datasets: [{
                label: 'Historial de Pesos',
                data: pesos,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                x: [{
                    type: 'linear',
                    position: 'bottom'
                }]
            }
        }
    });
</script>


<?php include("./src/View/templates/footer_administrador.php")?>
