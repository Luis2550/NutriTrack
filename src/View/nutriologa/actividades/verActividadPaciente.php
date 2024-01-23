<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion');
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<!-- Agrega las referencias a Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<main class="main main_nuevo_actividades"> 
<h2 class="mt-4 mb-4" style="font-family: 'Arial', sans-serif; color: black; text-align: center; padding: 10px; border-radius: 8px;">Actividades de <?php echo $data["actividad"]["nombres"]. " " .$data["actividad"]["apellidos"]?></h2>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color: #7FFFD4;"> <!-- Color verde agua -->
                <div class="card-body">
                
                    <p class="card-text"><strong>Actividad:</strong> <?php echo $data["actividad"]["actividad"]?></p>
                    <p class="card-text"><strong>Descripcion:</strong> <?php echo htmlspecialchars($data["actividad"]["descripcion"]); ?></p>
                    <p class="card-text"><strong>Fecha:</strong> <?php echo $data["actividad"]["fecha"]?></p>
                </div>
            </div>
        </div>

        <!-- Repite este bloque para cada tarjeta adicional -->
        <div class="col-md-4 mb-4">
            <!-- Otra tarjeta -->
        </div>

        <div class="col-md-4 mb-4">
            <!-- Otra tarjeta -->
        </div>
    </div>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>
