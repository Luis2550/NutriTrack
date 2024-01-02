
<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}
?>

<?php include("./src/View/templates/header_administrador.php")?>

<main class>
<h2>Ver Usuarios</h2>

<table border="1" width="40%" id="tabla_id">

    <thead>
        <tr>
            <th>Cédula</th>
            <th>Rol</th>
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
                echo"<tr>";
                    echo"<td>".$dato['ci_usuario']."</td>";
                    echo"<td>".$dato['rol']."</td>";
                    echo"<td>".$dato['nombres']."</td>";
                    echo"<td>".$dato['apellidos']."</td>";
                    echo"<td>".$dato['edad']."</td>";
          
                    echo "<td><a href='index.php?c=Usuarios&a=modificarUsuarios&id=".$dato["ci_usuario"]."'>Modificar</a></td>";
                    echo "<td><a href='index.php?c=Usuarios&a=eliminarUsuarios&id=".$dato["ci_usuario"]."'>Eliminar</a></td>";
                    echo "<td><a href='index.php?c=historialSuscripcion&a=nuevoHistorialSuscripcion&ci_usuario=".$dato["ci_usuario"]."'>Asignar Plan</a></td>";
                echo"</tr>";
            }
        ?>

    </tbody>

</table>


<?php include("./src/View/templates/footer_administrador.php")?>