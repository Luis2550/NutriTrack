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