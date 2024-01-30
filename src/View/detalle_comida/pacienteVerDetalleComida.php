<?php include("./src/View/templates/header_usuario.php")?>

<style>
    h2 {
            text-align: center;
            color: #0066cc;
        }

        .plan-nutricional {
            margin-top: 20px;
        }

        .dia-columna {
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .modulo {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
        }

        .tipo-comida {
            margin-top: 10px;
        }

        

/* Estilos para la tabla en la pantalla modal */
#myModalContent table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px; /* Espacio superior para separar la tabla del contenido anterior */
}

#myModalContent th, #myModalContent td {
    border: 1px solid #ddd; /* Borde de las celdas */
    padding: 8px; /* Espaciado interno de las celdas */
    text-align: left; /* Alineación del texto a la izquierda */
}

#myModalContent th {
    background-color: #f2f2f2; /* Fondo de las celdas de encabezado */
}
        
/* Estilo para la ventana modal */
/* Estilo para la ventana modal */
.modal {
    display: none;
    position: fixed;
    top: 50%; /* Posiciona la ventana modal en el centro verticalmente */
    left: 50%; /* Posiciona la ventana modal en el centro horizontalmente */
    transform: translate(-50%, -50%); /* Centra la ventana modal correctamente */
    width: 80%; /* Ancho de la ventana modal */
    max-width: 600px; /* Ancho máximo de la ventana modal */
    height: auto; /* Altura automática según el contenido */
    background-color: #fefefe;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.modal-content {
    background-color: #fefefe;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
        .acciones a {
            color: #0066cc;
            text-decoration: none;
            margin-right: 10px;
            transition: color 0.3s ease-in-out;
        }
        .semana-info{
            font-weight: bold;
        }

        .acciones a:hover {
            color: #004080;
        }

        .semana-info {
            text-align: center;
            color: #555;
        }

        .btn-modificar{
            border: none;
            outline: none;
            cursor: pointer;
            color: #008000;
            text-decoration: none;
            font-weight: bold;
            margin-left: 5px;
        }

        .btn-eliminar {
    padding: 10px 20px;
    margin: 5px;
    font-size: 16px;
    cursor: pointer;
    background-color: #f44336; /* Color de fondo azul */
    color: white; /* Color de texto blanco */
    border: none;
    border-radius: 5px;
}

.btnCancelar {
    background-color: #f44336; /* Color de fondo rojo para el botón Cancelar */
}
</style>


    <h2>Modificar Comidas Asignadas</h2>

    <div class="semana-info">
        <p class="semana-info">Semana <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_inicio'])); ?> - <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_fin'])); ?></p>
    </div>

    <?php
    // Ordenar por día
    // Ordenar por día de manera secuencial
    $ordenDiasSecuencial = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

    usort($data['detalle_comida'], function ($a, $b) use ($ordenDiasSecuencial) {
        $diaA = array_search($a['dia'], $ordenDiasSecuencial);
        $diaB = array_search($b['dia'], $ordenDiasSecuencial);

        return $diaA - $diaB;
    });

    $dias = [];
    foreach ($data['detalle_comida'] as $dato) {
        $dia = $dato['dia'];
        $tipoComida = $dato['tipo_comida'];

        if (!isset($dias[$dia])) {
            $dias[$dia] = [];
        }

        if (!isset($dias[$dia][$tipoComida])) {
            $dias[$dia][$tipoComida] = [];
        }

        $dias[$dia][$tipoComida][] = $dato;
    }

    //var_dump($dias);

    foreach ($dias as $dia => $comidasPorTipo) :
    ?>
        <div class="dia-columna">
            <h3 style="color: #004080;"><?php echo $dia; ?></h3>
            <?php
            $tiposDeComida = ["Desayuno", "Almuerzo", "Cena"];
            foreach ($tiposDeComida as $tipoComida) :
            ?>
                <div class="tipo-comida">
                    <h4 style="color: #0066cc;"><?php echo $tipoComida; ?></h4>
                    <?php foreach ($comidasPorTipo[$tipoComida] as $comida) : ?>
                        <div class="modulo">
                            <!-- <p><strong>ID Comida:</strong> <?php echo $comida['id_comida']; ?></p> -->
                            
                            <p id="id-tipo-comida-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>ID Comida:</strong> <?php echo $comida['id_comida']; ?></p>
                            <p id="comida-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>Comida:</strong> <?php echo $comida['comida']; ?></p>
                            <p id="proteina-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>Proteína:</strong> <?php echo $comida['cantidad_proteina']; ?></p>
                            <p id="carbohidratos-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>Carbohidratos:</strong> <?php echo $comida['cantidad_carbohidratos']; ?></p>
                            <p id="grasas-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>Grasas Saludables:</strong> <?php echo $comida['cantidad_grasas_saludables']; ?></p>

                            <div class="acciones">
                                <!--Tipocomida /id-comida- /comida-->  
                                <center><button class="btn-modificar" onclick="mostrarModal('<?php echo $tipoComida; ?>', 'id-tipo-comida-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>', 'comida-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>', '<?php echo $comida['descripcion'];?>')")">Descripción</button></center>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>

    <!-- Ventana Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h3 class="titulo-modal" id="titulo-modal" style="color: #004080;">Comidas - </h3>
            <!-- Modifica el div para mostrar la tabla de comidas en la ventana modal -->
            <div id="myModalContent">
                
            </div>
        </div>
    </div>

<?php include("./src/View/templates/footer_usuario.php")?>
