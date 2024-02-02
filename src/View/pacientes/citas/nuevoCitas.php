<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php
// Array para almacenar los días permitidos
$diasPermitidos = [];

// Iterar sobre el array $configuraciones e imprimir el campo dias_semana
foreach ($configuraciones as $configuracion) {
    // Convertir la cadena de días_semana a un array
    $diasConfiguracion = explode(',', $configuracion['dias_semana']);

    // Agregar los días al array $diasPermitidos
    $diasPermitidos = array_merge($diasPermitidos, $diasConfiguracion);
}

// Eliminar duplicados y ordenar alfabéticamente (opcional)
$diasPermitidos = array_unique($diasPermitidos);
sort($diasPermitidos);
?>

<?php include("./src/View/templates/header_usuario.php") ?>

<div class="container nuevo-citas justify-content-center align-items-center" style="height: 100vh;">

    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Citas&a=guardarCitas" autocomplete="off" class="mx-auto col-lg-8 col-xm-12">

        <h2>Registro de Citas</h2>
        
        <br>

        <div class="col-sm-12">
            <div class="card text-center">
                <div class="card-body">
                    
                    <p class="card-text">Días Laborales:
                        <?php
                        // Iterar sobre el array $configuraciones e imprimir el campo dias_semana
                        foreach ($configuraciones as $configuracion) {
                            echo $configuracion['dias_semana'];
                        }
                        ?> <br>
                        (Nota. Días feriados no se trabaja)
                    </p>
                
                </div>
            </div>
        </div>

        <br>
        
        <input type="hidden" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $_SESSION['usuario']['ci_usuario']; ?>" class="form-control">
    

        <div class="form-group">
            <label for="fecha2">Fecha:</label>
            <input type="date" id="fecha2" name="fecha2" min="<?= $fecha_actual; ?>" max="<?= $fecha_maxima ?>" required class="form-control">
        </div>

        <div class="form-group">
            <label for="horas_disponibles">Horas Disponibles:</label>
            <select id="horas_disponibles" name="horas_disponibles" required class="form-control">
                <?php foreach ($data['horas_disponibles'] as $hora) : ?>
                    <option value="<?= $hora ?>"><?= $hora ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ci_nutriologa">Nutrióloga:</label>
            <input type="hidden" id="ci_nutriologa" name="ci_nutriologa" readonly value="<?php echo $data['ci_nutriologa']; ?>" class="form-control">
            <input type="text" id="nombre_completo" name="nombre_completo" readonly value="<?php echo $data['nutriologa']['nombre_completo']; ?>" class="form-control">


        </div>
        

       <?php if (isset($_GET['error_message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($_GET['error_message']); ?>
        </div>
    <?php endif; ?>
    

        <div class="form-group">
            <button id="agendar" name="agendar" type="submit" class="btn btn-primary">Agendar</button>
        </div>
    </form>
</div>

<style>
@media (max-width: 767px) {
    .container,
    .form-group,
    #nuevo {
        width: 100%;
        max-width: none;
        min-height: auto;
    }

    #nuevo {
        max-height: none;
        overflow-y: visible;
    }

    .diaslaborales {
        white-space: normal; /* Permite que el texto envuelva */
        word-wrap: break-word; /* Permite que las palabras largas se envuelvan */
        max-width: 100%; /* Limita la anchura del contenedor al 100% del ancho del dispositivo */
    }

    .diaslaborales {
        white-space: normal;
        overflow-wrap: break-word;
        max-width: 100%;
    }
}


</style>

<?php include("./src/View/templates/footer_usuario.php") ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('nuevo').addEventListener('submit', function (event) {
        // Evitar que el formulario se envíe de manera predeterminada
        event.preventDefault();

        // Muestra la alerta después de unos segundos
        setTimeout(function () {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Cita agendada con éxito",
                showConfirmButton: false,
            });
        }, 1000); // Cambia el valor del temporizador según tus necesidades

        // Envía el formulario después de mostrar la alerta
        setTimeout(function () {
            document.getElementById('nuevo').submit();
        }, 3000); // Asegúrate de ajustar el valor del temporizador según el tiempo de la alerta
    });
});
</script>