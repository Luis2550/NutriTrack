<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class="main main_configuracion">
    <div class="vista">

        <h2>Ver Configuración</h2>

        <?php
        foreach ($data['configuraciones'] as $dato) {
            echo "<div class='container card' style='max-width: 500px;'>";
                echo "<div class='card-body'>";
                    echo "<p><strong>Hora inicio mañana:</strong> ".$dato['hora_inicio_manana']."</p>";
                    echo "<p><strong>Hora fin mañana:</strong> ".$dato['hora_fin_manana']."</p>";
                    echo "<p><strong>Hora inicio tarde:</strong> ".$dato['hora_inicio_tarde']."</p>";
                    echo "<p><strong>Hora fin tarde:</strong> ".$dato['hora_fin_tarde']."</p>";
                    echo "<p><strong>Días Laborales:</strong> ".$dato['dias_semana']."</p>";
                    echo "<p><strong>Feriados:</strong> ".$dato['dias_Feriados']."</p>";
                    echo "<p><strong>Duración cita:</strong> ".$dato['duracion_cita']."</p>";
                    echo "<p><strong>Horas totales:</strong> ".$dato['horas_laborales']."</p>";
                    echo "<p class='acciones'>
                            <a href='index.php?c=Configuracion&a=modificarConfiguraciones&id=".$dato["id_configuracion"]."' class='btn btn-warning' >Modificar</a>
                          </p>";
                echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>
