<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

// Lógica de manejo de la inserción aquí...

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

    <div class="historial-container">
        <?php
        if (isset($data['historial_medidas']) && is_array($data['historial_medidas'])) {
            echo "<div class='pizarra'>";
            foreach ($data['historial_medidas'] as $dato) {
                echo "<div class='notita'>";
                echo "<p><strong>Cédula:</strong> " . $dato['ci_usuario'] . "</p>";
                echo "<p><strong>Nombres:</strong> " . $dato['nombres'] . "</p>"; // Agregado
                echo "<p><strong>Apellidos:</strong> " . $dato['apellidos'] . "</p>";
                echo "<p><strong>Peso:</strong> " . $dato['peso'] . "</p>";
                echo "<p><strong>Estatura:</strong> " . $dato['estatura'] . "</p>";
                echo "<p><strong>Presion Arterial Sistolica:</strong> " . $dato['presion_arterial_sistolica'] . "</p>";
                echo "<p><strong>Presion Arterial Diastolica:</strong> " . $dato['presion_arterial_diastolica'] . "</p>";
                echo "<p><strong>Fecha:</strong> " . $dato['fecha'] . "</p>";
                echo "<div class='celda-acciones'>
                        <a class='btn btn-modificar' href='index.php?c=historialMedidas&a=modificarHistorialMedidas&id=".$dato["id_historial_medidas"]."'>Modificar</a>
                        <a class='btn btn-eliminar' href='index.php?c=historialMedidas&a=eliminarHistorialMedidas&id=".$dato["id_historial_medidas"]."'>Eliminar</a>
                      </div>";
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

<?php include("./src/View/templates/footer_administrador.php")?>
