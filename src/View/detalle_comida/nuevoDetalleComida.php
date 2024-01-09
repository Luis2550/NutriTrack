<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        .plan-nutricional {
            margin-top: 20px;
        }

        .dia-columna {
            display: inline-block;
            vertical-align: top;
            margin-right: 20px;
        }

        .modulo {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .tipo-comida {
            margin-top: 10px;
        }

        .acciones {
            margin-top: 10px;
        }

        .semana-info{
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Detalle Comida</h2>

    <div class="semana-info">
        <p>Semana <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_inicio'])); ?> - <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_fin'])); ?></p>
    </div>

    <div class="plan-nutricional">
        <?php
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

        foreach ($dias as $dia => $comidasPorTipo) :
            ?>
            <div class="dia-columna">
                <h3><?php echo $dia; ?></h3>
                <?php
                foreach ($comidasPorTipo as $tipoComida => $comidas) :
                    ?>
                    <div class="tipo-comida">
                        <h4><?php echo $tipoComida; ?></h4>
                        <?php foreach ($comidas as $comida) : ?>
                            <div class="modulo">
                                <p>ID Comida: <?php echo $comida['id_comida']; ?></p>
                                <p>Comida: <?php echo $comida['comida']; ?></p>
                                <p>ID Plan Nutricional: <?php echo $comida['id_plan_nutricional']; ?></p>
                                <p>Cédula Nutrióloga: <?php echo $comida['ci_nutriologa']; ?></p>
                                <p>Cédula Paciente: <?php echo $comida['ci_paciente']; ?></p>

                                <div class="acciones">
                                    <a href='index.php?c=DetalleComida&a=modificarDetalleComida&id=<?php echo $comida["id_comida"]; ?>'>Modificar</a>
                                    <a href='index.php?c=DetalleComida&a=eliminarDetalleComida&id=<?php echo $comida["id_comida"]; ?>'>Eliminar</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>