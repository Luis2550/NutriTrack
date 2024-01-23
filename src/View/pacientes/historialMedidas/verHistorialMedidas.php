<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// Lógica de manejo de la inserción aquí...

?>

<?php include("./src/View/templates/header_usuario.php")?>

<main class="main main_historial"> 
    <h2 class="title">Bienvenido, <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?>!</h2>
    <h2 class="historial-title" style="text-align: center;">Historial Medidas</h2>


    <div class="historial-container">
        <?php
        if (isset($data['historial_medidas']) && is_array($data['historial_medidas'])) {
            echo "<div class='pizarra'>";
            foreach ($data['historial_medidas'] as $dato) {
                echo "<div class='notita'>";
                echo "<p><strong>Id_Historial Clinico:</strong> " . $dato['id_historial_clinico'] . "</p>";
                echo "<p><strong>Peso:</strong> " . $dato['peso'] . "</p>";
                echo "<p><strong>Estatura:</strong> " . $dato['estatura'] . "</p>";
                echo "<p><strong>Presion Arterial Sistolica:</strong> " . $dato['presion_arterial_sistolica'] . "</p>";
                echo "<p><strong>Presion Arterial Diastolica:</strong> " . $dato['presion_arterial_diastolica'] . "</p>";
                echo "<p><strong>Fecha:</strong> " . $dato['fecha'] . "</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            // No hay historial de medidas para mostrar
            echo "<p>No hay historial de medidas disponibles.</p>";
        }
        ?>
    </div>

    <!-- Gráfica de Historial de Pesos -->
    <div style="width: 80%; margin: auto;">
        <canvas id="pesoChart"></canvas>
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

  /* Estilos para los títulos */
  .title {
    color: #333; /* Color del texto: negro */
    margin-bottom: 10px; /* Margen inferior de 10px */
  }

  .historial-title {
    color: #4caf50; /* Color del texto: verde */
    margin-bottom: 20px; /* Margen inferior de 20px */
  }
</style>

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
