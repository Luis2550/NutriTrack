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
            </tr>
        </thead>

        <tbody>
            <?php
                foreach($data['usuarios'] as $dato){
                    // Agregar condición para mostrar solo cuando id_rol sea igual a 1
                    if($dato['id_rol'] == 1){
                        echo "<tr>";
                            echo "<td>".$dato['nombres']."</td>";
                            echo "<td>".$dato['apellidos']."</td>";
                            echo "<td>".$dato['edad']."</td>";
                            echo "<td>".$dato['correo']."</td>";
                            echo "<td><a href='index.php?c=Usuarios&a=modificarUsuarios_n&id=".$dato["ci_usuario"]."' class='btn btn-outline-success btn-sm'><i class='fas fa-edit'></i></a></td>";
                            echo "<td><a href='index.php?c=Usuarios&a=eliminarUsuarios&id=".$dato["ci_usuario"]."' class='btn btn-outline-danger btn-sm'><i class='fas fa-trash-alt'></i></a></td>";
                        echo "</tr>";
                    }
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
        $('#tabla_usuarios').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
                
            }
        });
    });
</script>
