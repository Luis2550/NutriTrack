<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Comidas Asignadas</title>
    <script>var comidaSeleccionada; // Variable para almacenar la comida seleccionada

    // Agrega una variable para almacenar la información de las comidas
    var comidasData = <?php echo json_encode($data_comida['comidas']); ?>;
    //alert(JSON.stringify(comidasData, null, 2));

    function eliminarDetalleComida() {
        // Muestra una ventana de confirmación
        var confirmacion = confirm("¿Está seguro que desea eliminar las comidas asignadas?");


        // Verifica la respuesta del usuario
        if (confirmacion) {
            // Si el usuario confirma, redirige a la URL deseada
            alert();
            window.location.href = 'index.php?c=DetalleComida&a=eliminarDetalleComida&id=' + <?php echo $id;?>;
        } else {
            // Si el usuario cancela, no hace nada o puedes mostrar un mensaje adicional
            // alert("Eliminación cancelada");
        }
    }
    // Ajusta la función para filtrar las comidas por tipo utilizando comidasData
    function filtrarComidasPorTipo(tipoComida) {
        var uniqueComidas = [];
        var seenIds = {};

        for (var i = 0; i < comidasData.length; i++) {
            var comida = comidasData[i];

            if (comida.tipo_comida === tipoComida) {
                var idComida = comida.id_comida;

                if (!seenIds[idComida]) {
                    seenIds[idComida] = true;
                    uniqueComidas.push(comida);
                }
            }
        }

        return uniqueComidas;
    }

    // Agrega esta función para construir la tabla de comidas
    function construirTablaComidas(comidas, tipoComida, idTipoComida, idComida) {
        var tablaComidas = '<table border="1"><tr><th>ID Comida</th><th>Comida</th><th>Descripción</th><th>Cantidad Proteína</th><th>Cantidad Carbohidratos</th><th>Cantidad Grasas Saludables</th><th>Acciones</th></tr>';

        for (var i = 0; i < comidas.length; i++) {
            tablaComidas += '<tr>';
            tablaComidas += '<td>' + (comidas[i].id_comida !== undefined ? comidas[i].id_comida : 'N/A') + '</td>';
            tablaComidas += '<td>' + (comidas[i].comida !== undefined ? comidas[i].comida : 'N/A') + '</td>';
            tablaComidas += '<td>' + (comidas[i].descripcion !== undefined ? comidas[i].descripcion : 'N/A') + '</td>';
            tablaComidas += '<td>' + (comidas[i].cantidad_proteina !== undefined ? comidas[i].cantidad_proteina : 'N/A') + '</td>';
            tablaComidas += '<td>' + (comidas[i].cantidad_carbohidratos !== undefined ? comidas[i].cantidad_carbohidratos : 'N/A') + '</td>';
            tablaComidas += '<td>' + (comidas[i].cantidad_grasas_saludables !== undefined ? comidas[i].cantidad_grasas_saludables : 'N/A') + '</td>';
            // Agrega el botón "Seleccionar" con un evento onclick para manejar la selección

            // Seleccionar el id y la comida y pasarlos como parámetros adicionales
            tablaComidas += '<td><button class="btnSeleccionarComida" onclick="seleccionarComida(' + i + ', \'' + tipoComida + '\', \'' + idTipoComida + '\', \'' + idComida + '\', \'' + comidas[i].id_comida + '\', \'' + comidas[i].comida + '\', \'' + comidas[i].cantidad_proteina + '\', \'' + comidas[i].cantidad_carbohidratos + '\', \'' + comidas[i].cantidad_grasas_saludables + '\')">Actualizar</button></td>';

            tablaComidas += '</tr>';
        }

        tablaComidas += '</table>';

        // Insertar la tabla en el contenido de la ventana modal
        document.getElementById('myModalContent').innerHTML = tablaComidas;
    }

    function mostrarModal(tipoComida, idTipoComida, idComida) {
        /*alert(tipoComida);
        alert(idTipoComida);
        alert(idComida);*/
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';

        // Filtrar las comidas según el tipoComida
        var comidasFiltradas = filtrarComidasPorTipo(tipoComida);
        //alert(JSON.stringify(comidasFiltradas, null, 2));

        document.getElementById('titulo-modal').innerHTML = 'Comidas - ' + tipoComida;

        // Cargar la tabla de comidas en la ventana modal
        construirTablaComidas(comidasFiltradas, tipoComida, idTipoComida, idComida);

        // Limpiar la información de la comida seleccionada
        //document.getElementById(idTipoComida).innerHTML = '';
        //document.getElementById(idComida).innerHTML = '';
    }

    function cerrarModal() {
        // Limpiar la variable de comida seleccionada al cerrar el modal
        comidaSeleccionada = null;

        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    }

    function guardarComida(id_plan_nutri, id_comida_act, id_comida_nuev, dia) {
        /*alert(id_plan_nutri);
        alert(id_comida_act);
        alert(id_comida_nuev);
        alert(dia);*/
        // Aquí puedes realizar acciones con la comida seleccionada (guardar en la tabla, etc.)
        // ...
        //Guardar detalle comidas
        //alert("Toca definir el guardado jajaaj");
        // Crear un objeto para almacenar las comidas por día y tipo
        //var datosComidas = {};

        //    // Obtener el id_plan_nutricional

        //    //alert(idPlanNutricional);

        //alert(datosComidas);alert(JSON.stringify(datosComidas, null, 2));

        // Crear un formulario dinámicamente
        var form = document.createElement('form');
        form.action = 'index.php?c=DetalleComida&a=modificarDetalleComidaPlanNutricional'; // Cambiar la acción según la estructura de tus archivos
        form.method = 'POST';

        // Crear un campo oculto para enviar los datos
        //id_plan_nutricional
        var input1 = document.createElement('input');
        input1.type = 'hidden';
        input1.name = 'id_plan_nutricional';
        input1.value = id_plan_nutri;

        //id_comida_act
        var input2 = document.createElement('input');
        input2.type = 'hidden';
        input2.name = 'id_comida_act';
        input2.value = id_comida_act;

        //id_comida_nuev
        var input3 = document.createElement('input');
        input3.type = 'hidden';
        input3.name = 'id_comida_nuev';
        input3.value = id_comida_nuev;
 
        //dia
        var input4 = document.createElement('input');
        input4.type = 'hidden';
        input4.name = 'dia';
        input4.value = dia;
 
        // Agregar el campo oculto al formulario
        form.appendChild(input1);
        form.appendChild(input2);
        form.appendChild(input3);
        form.appendChild(input4);

        // Agregar el formulario al cuerpo del documento
        document.body.appendChild(form);

        // Enviar el formulario
        form.submit();

        // Eliminar el formulario después de enviarlo
        document.body.removeChild(form);
        // Luego, cierra el modal
        cerrarModal();
    }

    function seleccionarComida(index, tipoComida, idTipoComida, idComida, contenidoIdComida, contenidoComida, proteina, carbohidratos, grasas) {
        //comidaSeleccionada = comidasData[index];

        // Muestra la información de la comida seleccionada en las etiquetas correspondientes
        //document.getElementById(idTipoComida).innerHTML = 'ID: ' + (comidaSeleccionada.id_comida !== undefined ? comidaSeleccionada.id_comida : 'N/A');
        //document.getElementById(idComida).innerHTML = 'Comida: ' + (comidaSeleccionada.comida !== undefined ? comidaSeleccionada.comida : 'N/A');

        // También, muestra la información de la comida seleccionada en los div del módulo correspondiente
        //document.getElementById('id-tipo-comida').innerHTML = 'ID: ' + (comidaSeleccionada.id_comida !== undefined ? comidaSeleccionada.id_comida : 'N/A');
        //document.getElementById('comida').innerHTML = 'Comida: ' + (comidaSeleccionada.comida !== undefined ? comidaSeleccionada.comida : 'N/A');
        var palabra = idComida;
        var partes = palabra.split('-');

        // Obtiene la palabra que está en la mitad (en este caso, la segunda)
        var dia = partes[1];

        //alert(dia);  // Esto imprimirá "lunes"
        
        /*alert(index); //0
        alert(tipoComida); //Almuerzo
        alert(idTipoComida); //id-div
        alert(idComida); //id-div-comida
        alert(contenidoIdComida); //1
        alert(contenidoComida); //pollo*/

        var id_plan_nutri = <?php echo $id;?>;
        //alert(id_plan_nutri);
        //idComida
        var diaMayuscula = dia.toUpperCase();
        //alert(diaMayuscula);

        // Muestra un cuadro de diálogo de confirmación
        var id_comida_actual = document.getElementById(idTipoComida).textContent;
        id_comida_actual = id_comida_actual.replace('ID Comida: ', '');
        //alert(id_comida_actual);

        if(id_comida_actual == contenidoIdComida){
            alert("¡Está comida ya está asignada!");
        }
        // Verifica la respuesta del usuario
        else if (confirm("¿Desea actualizar la comida en este día?")) {
            document.getElementById(idTipoComida).innerHTML = '<span style="font-weight: bold;">ID:</span> ' + contenidoIdComida;
            document.getElementById(idComida).innerHTML = '<span style="font-weight: bold;">Comida:</span> ' + contenidoComida;
            document.getElementById('proteina-' + dia + '-' + tipoComida.toLowerCase()).innerHTML = '<strong>Proteína:</strong>' + proteina;
            document.getElementById('carbohidratos-' + dia + '-' + tipoComida.toLowerCase()).innerHTML = '<strong>Carbohidratos:</strong>' + carbohidratos;
            document.getElementById('grasas-' + dia + '-' + tipoComida.toLowerCase()).innerHTML = '<strong>Grasas Saludables:</strong>' + grasas;

            guardarComida(id_plan_nutri, id_comida_actual, contenidoIdComida, diaMayuscula);
            
            // El usuario ha hecho clic en "Aceptar"
            alert("Comida actualizada");
            // Aquí puedes agregar la lógica para actualizar la comida
        } else {
            // El usuario ha hecho clic en "Cancelar" o ha cerrado el cuadro de diálogo
           alert("No se ha actualizado la comida");
            // Aquí puedes agregar la lógica que desees en caso de cancelación
        }
        
        //document.getElementById(idTipoComida).innerHTML = "Si modificarComida";
        
        // Cierra la ventana modal
        cerrarModal();
    }

    // Función para actualizar la información de la comida seleccionada en todos los días

    function verificarComidasIngresadas() {
        // Variable para indicar si hay algún div vacío
        var hayDivVacio = false;

        // Obtén todos los divs del mismo tipo de comida de todos los días
        var tipoComidaElements = document.querySelectorAll('[id^="id-tipo-comida-"]');
        
        tipoComidaElements.forEach(function (element) {
            // Extraer el tipo de comida del id del elemento actual
            var tipoComidaDelElemento = element.id.split('-').slice(-1)[0];

            // Obtener los IDs correspondientes
            var idTipoComida = element.id;
            var idComida = 'comida-' + idTipoComida.split('-').slice(3).join('-');

            // Verificar si la comida en el elemento actual está vacía
            var contenidoTipoComida = document.getElementById(idTipoComida).innerText.trim();
            var contenidoComidaActual = document.getElementById(idComida).innerText.trim();

            // Verificar si alguno de los divs está vacío
            if (contenidoTipoComida === '' || contenidoComidaActual === '') {
                hayDivVacio = true;
            }
        });

        // Devolver true si hay algún div vacío, de lo contrario, devolver false
        return hayDivVacio;
    }




    function modificarComida() {
        // Implementa la lógica para modificar la comida seleccionada
        // ...

        // Después de modificar, actualiza la fila en la página principal
        actualizarFilaComidaSeleccionada();
    }

    function eliminarComida() {
        // Implementa la lógica para eliminar la comida seleccionada
        // ...

        // Después de eliminar, limpia la fila en la página principal
        document.getElementById('filaComidaSeleccionada').innerHTML = `
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <!-- Añade más columnas según tus necesidades -->
            <td>
                <button onclick="modificarComida()">Modificar</button>
                <button onclick="eliminarComida()">Eliminar</button>
            </td>
        `;
    }

    function cancelar() {
        // Pregunta al usuario si desea salir sin asignar comidas al plan nutricional
        var confirmacion = confirm("¿Desea salir sin asignar comidas al plan nutricional?");

        // Si el usuario confirma, limpia la variable de comida seleccionada y redirige
        if (confirmacion) {
            comidaSeleccionada = null;

            // Redirige a la URL deseada (reemplaza 'tu_url' con la URL real)
            window.location.href = 'index.php?c=PlanNutricional&a=verPlanNutricional';
        } else {
            // Si el usuario cancela, no realiza ninguna acción
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }
    }

    window.onclick = function (event) {
        var modal = document.getElementById('myModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
    </script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

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
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    justify-content: center;
    align-items: center;
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
            background-color: rgba(90, 98, 104); /* Color de fondo azul */
            color: white; /* Color de texto blanco */
            border: none;
            border-radius: 5px;
        }

        .btn-eliminar:hover {
            background-color: rgba(90, 98, 104, 0.1); /* Color de fondo azul */
            color: black; /* Color de texto blanco */
        }

        .btn-cancelar {
            background-color: #f44336; /* Color de fondo rojo para el botón Cancelar */
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            color: white; /* Color de texto blanco */
            border: none;
            border-radius: 5px;
        }

        .btn-cancelar:hover {
            background-color: #d33338; /* Color de fondo azul */
            color: white; /* Color de texto blanco */
        }
    </style>
</head>

<body>
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
                            <p><strong><center>Datos Comida</center></strong></p>
                            
                            <p id="id-tipo-comida-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>ID Comida:</strong> <?php echo $comida['id_comida']; ?></p>
                            <p id="comida-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>Comida:</strong> <?php echo $comida['comida']; ?></p>
                            <p id="proteina-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>Proteína:</strong> <?php echo $comida['cantidad_proteina']; ?></p>
                            <p id="carbohidratos-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>Carbohidratos:</strong> <?php echo $comida['cantidad_carbohidratos']; ?></p>
                            <p id="grasas-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>"><strong>Grasas Saludables:</strong> <?php echo $comida['cantidad_grasas_saludables']; ?></p>


                            <!-- <p><strong>ID Plan Nutricional:</strong> <?php echo $comida['id_plan_nutricional']; ?></p>-->
                            <p><strong><center>Datos Paciente</center></strong></p>
                            <p><strong>Nombres:</strong> <?php echo $comida['nombres']; ?></p>
                            <p><strong>Apellidos:</strong> <?php echo $comida['apellidos']; ?></p>
                            <p><strong>Edad:</strong> <?php echo $comida['edad']; ?></p>

                            <div class="acciones">
                                <!--Tipocomida /id-comida- /comida-->  
                                <center><button class="btn-modificar" onclick="mostrarModal('<?php echo $tipoComida; ?>', 'id-tipo-comida-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>', 'comida-<?php echo strtolower($dia) . '-' . strtolower($tipoComida); ?>')")">Modificar</button></center>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    <button class="btn-eliminar" onclick="eliminarDetalleComida()">Eliminar Comidas Asignadas</button>
    <button id="btnCancelar" class="btn-cancelar" onclick="cancelar()">Cancelar</button>
    
    <!-- Ventana Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h3 class="titulo-modal" id="titulo-modal" style="color: #004080;">Comidas - </h3>
            <!-- Modifica el div para mostrar la tabla de comidas en la ventana modal -->
            <div id="myModalContent">
                <!-- Agrega una tabla con un botón "Seleccionar" en cada fila -->
                <table border="1">
                    <tr>
                        <th>ID Comida</th>
                        <th>Comida</th>
                        <th>Descripción</th>
                        <th>Cantidad Proteína</th>
                        <th>Cantidad Carbohidratos</th>
                        <th>Cantidad Grasas Saludables</th>
                        <th>Acciones</th>
                    </tr>
                    <!-- Los datos de la tabla se llenarán dinámicamente aquí -->
                </table>
            </div>
        </div>
    </div>
</body>

</html>