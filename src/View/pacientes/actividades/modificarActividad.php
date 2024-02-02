<?php
session_start();
// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_usuario.php")?>

<div class="container nuevo-actividades justify-content-center align-items-center" style="height: 100vh;">
    <form id="modificar" name="modificar" method="POST" action="index.php?c=actividad&a=actualizarActividad" autocomplete="off" class="mx-auto col-lg-8 col-xm-12">
        <h2>Editar <?php echo $data['titulo']; ?></h2>

        <input type="hidden" id="id" name="id" value="<?php echo $data["id_actividad"]; ?>" />

     
            <input type="hidden" id="ci_paciente" name="ci_paciente" readonly value="<?php echo $data["actividad"]["ci_paciente"]?>" class="form-control">
    

        <div class="form-group">
            <label for="actividad">Actividad:</label>
            <input type="text" id="actividad" name="actividad" required value="<?php echo $data["actividad"]["actividad"]?>" class="form-control">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripcion:</label>
            <textarea id="descripcion" name="descripcion" class="form-control" style="height: 180px;" required><?php echo htmlspecialchars($data["actividad"]["descripcion"]); ?></textarea>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha :</label>
            <input type="date" id="fecha" name="fecha" readonly value="<?php echo $data["actividad"]["fecha"]?>" class="form-control">
        </div>

        <button id="actualizar" name="actualizar" type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>

<style>
@media (max-width: 767px) {
    .container,
    .form-group,
    #modificar {
        width: 100%;
        max-width: none;
        min-height: auto;
    }
    
    #modificar {
        max-height: none;
        overflow-y: visible;
    }
}
</style>

<?php include("./src/View/templates/footer_usuario.php")?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('modificar').addEventListener('submit', function (event) {
        // Evitar que el formulario se envíe de manera predeterminada
        event.preventDefault();

        // Muestra la alerta después de unos segundos
        setTimeout(function () {
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Actualización realizada con éxito",
                showConfirmButton: false,
            });
        }, 1000); // Cambia el valor del temporizador según tus necesidades

        // Envía el formulario después de mostrar la alerta
        setTimeout(function () {
            document.getElementById('modificar').submit();
        }, 3000); // Asegúrate de ajustar el valor del temporizador según el tiempo de la alerta
    });
});
</script>
