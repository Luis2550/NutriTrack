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

    <form id="nuevo" name="nuevo" method="POST" action="index.php?c=Citas&a=actualizarCitas" autocomplete="off" class="mx-auto col-lg-8 col-xm-12">

        <h2>Editar <?php echo $data['titulo']; ?></h2>

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
                        ?>
                    </p><br>
                        (Nota: Días feriados no se trabaja)
                </div>
            </div>
        </div>

        <br>

        <input type="hidden" id="id_cita" name="id_cita" required value="<?php echo $data["id_cita"]; ?>">

            <input type="hidden" id="ci_paciente" name="ci_paciente" required readonly value="<?php echo $data["citas"]["ci_paciente"] ?>" class="form-control">
       

        <div class="form-group">
            <label for="fecha2">Fecha:</label>
            <input type="date" id="fecha2" name="fecha2" min="<?= $fecha_actual ?>" max="<?= $fecha_maxima ?>" required value="<?php echo $data["citas"]["fecha"]; ?>" class="form-control">
        </div>

        <div class="form-group">
            <label for="horas_disponibles">Horas Disponibles:</label>
            <select name="horas_disponibles" class="form-control">
                <?php foreach ($data['horas_disponibles'] as $hora) : ?>
                    <option value="<?= $hora ?>" <?php echo ($hora == $data["citas"]["horas_disponibles"]) ? 'selected' : ''; ?>><?= $hora ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ci_nutriologa">Nutrióloga:</label>
            <input type="hidden" id="ci_nutriologa" name="ci_nutriologa" readonly value="<?php echo $data['ci_nutriologa']; ?>" class="form-control">
            <input type="text" id="nombre_completo" name="nombre_completo" readonly value="<?php echo $data['nutriologa']['nombre_completo']; ?>" class="form-control">


        </div>

        <?php
        // Verificar si hay un mensaje de error presente
        $error_message = isset($_GET['error_message']) ? $_GET['error_message'] : '';

        // Mostrar el mensaje de error si está presente
        if (!empty($error_message)) {
            // Mostrar la alerta de error con el mensaje correspondiente
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function () {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Error",
                            text: "' . htmlspecialchars($error_message) . '",
                            showConfirmButton: true,
                        });
                    });
                  </script>';
        }
        ?>

        <div class="form-group">
            <button id="actualizar" name="actualizar" type="submit" class="btn btn-primary">Actualizar</button>
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
}
</style>

<?php include("./src/View/templates/footer_usuario.php") ?>

