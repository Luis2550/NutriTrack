<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ver Plan Nutricional</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    </head>

    <body class="bg-light" id="body">
        <?php include("./src/View/templates/header_user.php")?>
        <!-- Contenido principal -->
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4 main-content">
            <div class="container">
                
                <div class="col-12 text-center mt-4"> <!-- Agregamos una columna que ocupa todo el ancho y centraremos su contenido -->
                    <h2 class="titulo mb-4 font-weight-bold">Bienvenid@! <?php echo $data['comida_diaria'][0]['nombres'] . " " . $data['comida_diaria'][0]['apellidos'];?></h2>
                </div>

                <div class="col-12 text-center mt-4"> <!-- Agregamos una columna que ocupa todo el ancho y centraremos su contenido -->
                    <h3 class="titulo mb-4 font-weight-bold">¡Estás son tus comidas de hoy!</h3>
                </div>
                  
                <div class="col-12 text-center"> <!-- Agregamos una columna que ocupa todo el ancho y centraremos su contenido -->
                    <p class="rango-semana mt-4 mb-4 font-weight-bold" style="color: #444;"><?php echo $data['dia'];?> -
                        <?php
                        //var_dump($data['comida_diaria']);
                            // Obtén la fecha actual
                            $fechaActual = date('m-d-Y');
                            // Imprime la fecha en el formato mes-día-año
                            echo "" . $fechaActual;
                        ?>
                    </p>
                </div>

                <div class="plan-nutricional row">
                    <?php
                    // Tipos de comida en el orden deseado
                    $tiposDeComidaOrdenados = ["Desayuno", "Almuerzo", "Cena"];

                    foreach ($tiposDeComidaOrdenados as $tipoComidaOrdenado) {
                        // Filtra las comidas por tipo
                        $comidasTipo = array_filter($data['comida_diaria'], function ($comida) use ($tipoComidaOrdenado) {
                            return $comida['tipo_comida'] === $tipoComidaOrdenado;
                        });

                        if (!empty($comidasTipo)) {
                            echo "<div class='col-lg-4 col-md-6'>";
                            echo "<div class='card dia-columna mb-4'>";
                            echo "<div class='card-header' style='background-color: #004080; color: #fff;'>";
                            echo "<h3>{$tipoComidaOrdenado}</h3>";
                            echo "</div>";
                            echo "<div class='card-body'>";
                            echo "<div class='tipo-comida mb-3'>";

                            foreach ($comidasTipo as $comida) {
                                echo "<div class='modulo'>";
                                echo "<p><strong><center>Datos Comida</center></strong></p>";
                                // Agrega IDs
                                $idPrefix = strtolower($tipoComidaOrdenado);
                                echo "<p id='id-tipo-comida-{$idPrefix}'><strong>ID Comida:</strong> {$comida['id_comida']}</p>";
                                echo "<p id='comida-{$idPrefix}'><strong>Comida:</strong> {$comida['comida']}</p>";
                                echo "<p id='proteina-{$idPrefix}'><strong>Proteína:</strong> {$comida['cantidad_proteina']}</p>";
                                echo "<p id='carbohidratos-{$idPrefix}'><strong>Carbohidratos:</strong> {$comida['cantidad_carbohidratos']}</p>";
                                echo "<p id='grasas-{$idPrefix}'><strong>Grasas Saludables:</strong> {$comida['cantidad_grasas_saludables']}</p>";
                                echo "<p id='descripcion-{$idPrefix}'><strong>Descripción:</strong> {$comida['descripcion']}</p>";

                                echo "</div>";
                            }

                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>
                </div>

        
                
            </div>
        </main>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    </body>
    

<?php include("./src/View/templates/footer_administrador.php")?>
