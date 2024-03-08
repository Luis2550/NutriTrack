<?php
session_start();

// Verifica si hay una sesión activa
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Paciente') {
    header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
    exit();
}

?>
        <?php include("./src/View/templates/header_usuario.php")?>
        <!-- Contenido principal -->
        
            <div class="container">
                
                <div class="row">
    

                    <div class="col-12 text-center"> <!-- Agregamos una columna que ocupa todo el ancho y centraremos su contenido -->
                        <h3 class="text-center rango-semana mt-4 mb-4 font-weight-bold" style="color: #444;"><?php echo $data['dia'];?> -
                            <?php
                            //var_dump($data['comida_diaria']);
                                // Obtén la fecha actual
                                $fechaActual = date('m-d-Y');
                                // Imprime la fecha en el formato mes-día-año
                                echo "" . $fechaActual;
                            ?>
                        </h3>
                    </div>

                    <div class="plan-nutricional row">
                        <?php
                        // Tipos de comida en el orden deseado
                        $tiposDeComidaOrdenados = ["Desayuno", "Almuerzo", "Cena"];

                        if (!empty($data['comida_diaria'])) {
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
                        } else {
                            echo "<div class='d-flex justify-content-center align-items-center vh-12'>";
                            echo "    <div class='text-center'>";
                            echo "        <p class=''>No hay registros de comidas diarias.</p>";
                            echo "    </div>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
                
            </div>
        </main>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    </body>
    

<?php include("./src/View/templates/footer_usuario.php")?>
