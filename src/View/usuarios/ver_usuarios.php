<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>
<h2>Ver Usuarios</h2>
<main class="container mt-4">
    <div class="table-responsive">
        <table class="table table-bordered table-sm" id="tabla_usuarios">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Edad</th>
                    <th>Correo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Asignar Plan</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($data['usuarios'] as $dato){
                        echo"<tr>";
                            echo"<td>".$dato['nombres']."</td>";
                            echo"<td>".$dato['apellidos']."</td>";
                            echo"<td>".$dato['edad']."</td>";
                            echo"<td>".$dato['correo']."</td>";
                            echo "<td><a href='index.php?c=Usuarios&a=modificarUsuarios_n&id=".$dato["ci_usuario"]."' class='btn btn-outline-success btn-sm'><i class='fas fa-edit'></i></a></td>";
                            echo "<td><a href='index.php?c=Usuarios&a=eliminarUsuarios&id=".$dato["ci_usuario"]."' class='btn btn-outline-danger btn-sm'><i class='fas fa-trash-alt'></i></a></td>";
                            echo "<td><a href='index.php?c=historialSuscripcion&a=nuevoHistorialSuscripcion&ci_usuario=".$dato["ci_usuario"]."' class='btn btn-link'><i class='fas fa-plus'></i> Asignar Plan</a></td>";
                        echo"</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php include("./src/View/templates/footer_administrador.php")?>

<script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
<script src='https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js'></script>
<script src='https://kit.fontawesome.com/your-fontawesome-kit.js'></script> <!-- Reemplaza 'your-fontawesome-kit.js' con el enlace proporcionado por Font Awesome -->

<script>
    $(document).ready(function () {
        $('#tabla_usuarios').DataTable();
    });
</script>
