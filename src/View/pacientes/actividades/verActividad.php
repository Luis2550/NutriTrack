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

<main class="main main_actividades"> 
    <h2 class="title">Bienvenido! <?php echo $_SESSION['usuario']['nombres'] . " " . $_SESSION['usuario']['apellidos'];?> </h2>
    <h2>Ver Actividades</h2>

    <a name="" id="" class="btn btn-primary" href="http://localhost/nutritrack/index.php?c=Actividad&a=nuevoActividad" role="button">Agregar</a>

    <div class="actividades-container">
        <?php
        if (isset($data['actividades']) && is_array($data['actividades'])) {
            echo "<div class='pizarra'>";
            foreach ($data['actividades'] as $dato) {
                echo "<div class='notita'>";
                echo "<p><strong>Cedula Paciente:</strong> " . $dato['ci_paciente'] . "</p>";
                echo "<p><strong>Actividad:</strong> " . $dato['actividad'] . "</p>";
                echo "<p><strong>Descripcion:</strong> " . $dato['descripcion'] . "</p>";
                echo "<p><strong>Fecha:</strong> " . $dato['fecha'] . "</p>";
                echo "<div class='acciones'>";
                echo "<a href='index.php?c=actividad&a=modificarActividad&id=" . $dato["id_actividad"] . "' class='btn btn-warning'>Modificar</a>";
                echo "<a href='index.php?c=actividad&a=eliminarActividadPaciente&id=" . $dato["id_actividad"] . "' class='btn btn-danger'>Eliminar</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            // No hay actividades para mostrar
            echo "<p>No hay actividades disponibles.</p>";
        }
        ?>
    </div>
</main>

<!-- Ventana Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p id="modalMessage"></p>
  </div>
</div>

<!-- Estilos CSS para la Ventana Modal y la Pizarra con Notitas -->
<style>
  /* Estilos para la ventana modal */
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
  }

  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

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

  .acciones {
    margin-top: 10px;
  }

  /* Otros estilos según necesidades */
</style>

<!-- JavaScript para la Ventana Modal -->
<script>
  function showModal(message) {
    var modal = document.getElementById("myModal");
    var modalMessage = document.getElementById("modalMessage");
    modalMessage.innerHTML = message;
    modal.style.display = "block";
  }

  // Cierra la ventana modal cuando se hace clic en la 'x'
  document.querySelector(".close").addEventListener("click", function() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  });

  // Cierra la ventana modal si el usuario hace clic fuera de ella
  window.addEventListener("click", function(event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

  // Ejemplo de cómo usar la función showModal
  // Puedes llamar a esta función después de la lógica de inserción con el mensaje de error
  // showModal("Error: Ya existe una actividad para este paciente en la misma fecha.");
</script>

<?php include("./src/View/templates/footer_usuario.php")?>
