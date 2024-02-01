<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// Ordena el array por fecha de forma ascendente
usort($data['historial_medidas'], function($a, $b) {
    return strtotime($a['fecha']) - strtotime($b['fecha']);
});
?>

<?php include("./src/View/templates/header_usuario.php")?>

<main class="main">
    <h2 class="historial-title mt-3 mb-4">Historial Medidas</h2>
    
    <!-- Contenedor con estilos de Bootstrap -->
    <div class="row justify-content-center">
        <?php
        if (isset($data['historial_medidas']) && is_array($data['historial_medidas'])) {
            foreach ($data['historial_medidas'] as $dato) {
        ?>
                <!-- Carta con estilos personalizados y Bootstrap -->
                <div class="card col-10 col-sm-6 col-md-4 mb-4 mx-2" style="max-width: 300px; background-color: #cbe7ff; border: 1px solid #1c448c; color: black;">
                    <div class="card-body">
                        <p class="card-text"><strong>Número Historial Clínico:</strong> <?php echo $dato['id_historial_clinico']; ?></p>
                        <p class="card-text"><strong>Peso:</strong> <?php echo $dato['peso']; ?></p>
                        <p class="card-text"><strong>Estatura:</strong> <?php echo $dato['estatura']; ?></p>
                        <p class="card-text"><strong>Presión Arterial Sistólica:</strong> <?php echo $dato['presion_arterial_sistolica']; ?></p>
                        <p class="card-text"><strong>Presión Arterial Diastólica:</strong> <?php echo $dato['presion_arterial_diastolica']; ?></p>
                        <p class="card-text"><strong>Fecha:</strong> <?php echo $dato['fecha']; ?></p>
                    </div>
                </div>
        <?php
            }
        } else {
            // No hay historial de medidas para mostrar
            echo "<p class='col-md-12'>No hay historial de medidas disponibles.</p>";
        }
        ?>
    </div>

    <!-- Gráfica de Historial de Pesos -->
    <div style="width: 80%; margin: auto;">
        <canvas id="pesoChart"></canvas>
    </div>

    <!-- JavaScript para la Gráfica de Historial de Pesos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos del historial de pesos (ejemplo)
        var fechas = <?php echo json_encode(array_column($data['historial_medidas'], 'fecha')); ?>;
        var pesos = <?php echo json_encode(array_column($data['historial_medidas'], 'peso')); ?>;

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

<?php include("./src/View/templates/footer_usuario.php")?>
