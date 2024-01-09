<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo']; ?></title>
    <link rel="stylesheet" href="./public/css/insertar_detalle_comida.css">
    <style>
        /* Agrega estilos según tus necesidades */
        #comidaSeleccionada {
            margin-top: 20px;
        }
    </style>
    <script>
        
        var comidaSeleccionada; // Variable para almacenar la comida seleccionada

        // Agrega una variable para almacenar la información de las comidas
        var comidasData = <?php echo json_encode($data_comida['comidas']);?>;
        //alert(JSON.stringify(comidasData, null, 2));

        

        // Ajusta la función para filtrar las comidas por tipo utilizando comidasData
        function filtrarComidasPorTipo(tipoComida) {
            return comidasData.filter(function (comida) {
                return comida.tipo_comida === tipoComida;
            });
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
            tablaComidas += '<td><button class="btnSeleccionarComida" onclick="seleccionarComida(' + i + ', \'' + tipoComida + '\', \'' + idTipoComida + '\', \'' + idComida + '\', \'' + comidas[i].id_comida + '\', \'' + comidas[i].comida + '\')">Seleccionar</button></td>';

            tablaComidas += '</tr>';
        }

        tablaComidas += '</table>';

        // Insertar la tabla en el contenido de la ventana modal
        document.getElementById('myModalContent').innerHTML = tablaComidas;
    }

        function mostrarModal(tipoComida, idTipoComida, idComida) {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';

            // Filtrar las comidas según el tipoComida
            var comidasFiltradas = filtrarComidasPorTipo(tipoComida);

            //alert(JSON.stringify(comidasFiltradas, null, 2));

            document.getElementById('titulo-modal').innerHTML = 'Comidas - ' + tipoComida;

            // Cargar la tabla de comidas en la ventana modal
            construirTablaComidas(comidasFiltradas, tipoComida, idTipoComida, idComida);

            // Limpiar la información de la comida seleccionada
            document.getElementById(idTipoComida).innerHTML = '';
            document.getElementById(idComida).innerHTML = '';
        }

        function cerrarModal() {
            // Limpiar la variable de comida seleccionada al cerrar el modal
            comidaSeleccionada = null;

            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }

        function guardarComida() {
            // Aquí puedes realizar acciones con la comida seleccionada (guardar en la tabla, etc.)
            // ...
            if(verificarComidasIngresadas()){
                //hay divs vacios
                alert("¿Elija comidas para cada tipo de comida y para todos los dias?");
            }else{
                //Guardar detalle comidas
               // alert("Toca definir el guardado jajaaj");
                 // Crear un objeto para almacenar las comidas por día y tipo
                var datosComidas = {};

                // Obtener el id_plan_nutricional
                var idPlanNutricional = "<?php echo $id?>";

                //alert(idPlanNutricional);

                // Iterar sobre los días
                var dias = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
                for (var i = 0; i < dias.length; i++) {
                    // Obtener el día actual
                    var diaActual = dias[i];

                    // Iterar sobre los tipos de comida
                    var tiposComida = ['desayuno', 'almuerzo', 'cena'];
                    for (var j = 0; j < tiposComida.length; j++) {
                        // Obtener el tipo de comida actual
                        var tipoComidaActual = tiposComida[j];

                        // Obtener los IDs de los elementos correspondientes
                        var idTipoComida = 'id-tipo-comida-' + diaActual + '-' + tipoComidaActual;
                        var idComida = 'comida-' + diaActual + '-' + tipoComidaActual;

                        // Obtener el contenido de los elementos
                        var contenidoIdComida = document.getElementById(idTipoComida).innerText.trim().replace(/^ID: /, '');
                        var contenidoComida = document.getElementById(idComida).innerText.trim();

                        // Agregar los datos al objeto
                        if (!datosComidas[diaActual]) {
                            datosComidas[diaActual] = [];
                        }
                        datosComidas[diaActual].push({
                            id_comida: contenidoIdComida,
                            id_plan_nutricional: idPlanNutricional,
                            dia: diaActual
                        });
                    }
                }

                //alert(datosComidas);alert(JSON.stringify(datosComidas, null, 2));

                // Verificar los datos antes de enviar la solicitud
                console.log("Datos a enviar al servidor:", JSON.stringify(datosComidas));

                // Crear un formulario dinámicamente
                var form = document.createElement('form');
                form.action = 'index.php?c=DetalleComida&a=guardarComidaPlanNutricional'; // Cambiar la acción según la estructura de tus archivos
                form.method = 'POST';

                // Crear un campo oculto para enviar los datos
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'datosComidas';
                input.value = JSON.stringify(datosComidas);

                // Agregar el campo oculto al formulario
                form.appendChild(input);

                // Agregar el formulario al cuerpo del documento
                document.body.appendChild(form);

                // Enviar el formulario
                form.submit();

                // Eliminar el formulario después de enviarlo
                document.body.removeChild(form);
            }
            // Luego, cierra el modal
            cerrarModal();
        }

        function seleccionarComida(index, tipoComida, idTipoComida, idComida, contenidoIdComida, contenidoComida) {
            //comidaSeleccionada = comidasData[index];

            // Muestra la información de la comida seleccionada en las etiquetas correspondientes
            //document.getElementById(idTipoComida).innerHTML = 'ID: ' + (comidaSeleccionada.id_comida !== undefined ? comidaSeleccionada.id_comida : 'N/A');
            //document.getElementById(idComida).innerHTML = 'Comida: ' + (comidaSeleccionada.comida !== undefined ? comidaSeleccionada.comida : 'N/A');

            // También, muestra la información de la comida seleccionada en los div del módulo correspondiente
            //document.getElementById('id-tipo-comida').innerHTML = 'ID: ' + (comidaSeleccionada.id_comida !== undefined ? comidaSeleccionada.id_comida : 'N/A');
            //document.getElementById('comida').innerHTML = 'Comida: ' + (comidaSeleccionada.comida !== undefined ? comidaSeleccionada.comida : 'N/A');

            document.getElementById(idTipoComida).innerHTML = '<span style="font-weight: bold;">ID:</span> ' + contenidoIdComida;
            document.getElementById(idComida).innerHTML = '<span style="font-weight: bold;">Comida:</span> ' + contenidoComida;

            // Actualiza la información de la comida seleccionada en los div del mismo tipo de comida de todos los días
            actualizarComidaEnTodosLosDias(tipoComida, contenidoIdComida, contenidoComida);

            // Cierra la ventana modal
            cerrarModal();
        }

        // Función para actualizar la información de la comida seleccionada en todos los días
        function actualizarComidaEnTodosLosDias(tipoComida, contenidoIdComida, contenidoComida) {
            // Obtén todos los divs del mismo tipo de comida de todos los días
            var tipoComidaElements = document.querySelectorAll('[id^="id-tipo-comida-"]');
            
            tipoComidaElements.forEach(function (element) {
                // Extraer el tipo de comida del id del elemento actual
                var tipoComidaDelElemento = element.id.split('-').slice(-1)[0];

                // Verificar si el tipo de comida del elemento coincide con el tipo de comida proporcionado como parámetro
                if (tipoComidaDelElemento.toLowerCase() === tipoComida.toLowerCase()) {
                    var idTipoComida = element.id;
                    var idComida = 'comida-' + idTipoComida.split('-').slice(3).join('-');

                    // Verificar si la comida en el elemento actual está vacía
                    var comidaActual = document.getElementById(idComida).innerText.trim();
                    
                    // Actualizar la información en los divs correspondientes solo si la comida está vacía
                    if (comidaActual === '') {
                        document.getElementById(idTipoComida).innerHTML = '<span style="font-weight: bold;">ID:</span> ' + contenidoIdComida;
                        document.getElementById(idComida).innerHTML = '<span style="font-weight: bold;">Comida:</span> ' + contenidoComida;
                    }
                }
            });
        }

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

        // Función para actualizar la fila de la comida seleccionada en la página principal
        function actualizarFilaComidaSeleccionada() {
            // Implementa la lógica para actualizar la fila según la comida seleccionada
            // ...

            // Actualiza los valores de la filaComidaSeleccionada
            document.getElementById('filaComidaSeleccionada').innerHTML = `
                <td>${comidaSeleccionada.id_comida !== undefined ? comidaSeleccionada.id_comida : 'N/A'}</td>
                <td>${comidaSeleccionada.comida !== undefined ? comidaSeleccionada.comida : 'N/A'}</td>
                <td>${comidaSeleccionada.descripcion !== undefined ? comidaSeleccionada.descripcion : 'N/A'}</td>
                <td>${comidaSeleccionada.cantidad_proteina !== undefined ? comidaSeleccionada.cantidad_proteina : 'N/A'}</td>
                <td>${comidaSeleccionada.cantidad_carbohidratos !== undefined ? comidaSeleccionada.cantidad_carbohidratos : 'N/A'}</td>
                <td>${comidaSeleccionada.cantidad_grasas_saludables !== undefined ? comidaSeleccionada.cantidad_grasas_saludables : 'N/A'}</td>
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
</head>

<body>
    <h2 class="titulo">Detalle Comida</h2>

    <div class="semana-info">
        <p class="rango-semana" style="color: #444;">Semana <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_inicio'])); ?> - <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_fin'])); ?></p>
    </div>

    <div class="plan-nutricional">
        <?php
        // Obtén los días en el rango de fechas
        $fechaInicio = new DateTime($data['detalle_comida'][0]['fecha_inicio']);
        $fechaFin = new DateTime($data['detalle_comida'][0]['fecha_fin']);

        $intervaloDias = new DateInterval('P1D');
        $periodo = new DatePeriod($fechaInicio, $intervaloDias, $fechaFin);

        // Definir los tipos de comida
        $tiposComida = ['Desayuno', 'Almuerzo', 'Cena'];

        function obtenerNombreDia($timestamp) {
            $diasSemana = [
                'Domingo',
                'Lunes',
                'Martes',
                'Miércoles',
                'Jueves',
                'Viernes',
                'Sábado',
            ];
        
            $nombreDia = $diasSemana[date('w', $timestamp)];
            return $nombreDia;
        }

        // Iterar sobre los días y generar una columna por día
        foreach ($periodo as $dia) {
            $nombreDia = obtenerNombreDia($dia->getTimestamp());
        ?>
            <div class="dia-columna">
                <h3 style="color: #004080;"><?php echo $nombreDia; ?></h3>

                <?php
                // Iterar sobre los tipos de comida y generar un módulo por tipo de comida
                foreach ($tiposComida as $tipo) {
                    $idTipoComida = 'id-tipo-comida-' . strtolower($nombreDia) . '-' . strtolower($tipo);
                    $idComida = 'comida-' . strtolower($nombreDia) . '-' . strtolower($tipo);
                ?>
                    <div class="tipo-comida">
                        <h4><?php echo $tipo; ?></h4>
                        <div class="modulo">
                            <!-- Detalles del tipo de comida -->
                            <div id="<?php echo $idTipoComida; ?>"></div>
                            <div id="<?php echo $idComida; ?>"></div>
                            <div class="acciones">
                                <button class='elegir-comida' onclick="mostrarModal('<?php echo $tipo; ?>', '<?php echo $idTipoComida; ?>', '<?php echo $idComida; ?>')">Elegir Comida</button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php
        }
        ?>
    </div>

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

    <!-- Añade botones para guardar o cancelar -->
    <div class="btn-container">
        <button id="btnGuardar" class="btnGuardar" onclick="guardarComida()">Guardar</button>
        <button id="btnCancelar" class="btnCancelar" onclick="cancelar()">Cancelar</button>
    </div>
</body>

</html>
