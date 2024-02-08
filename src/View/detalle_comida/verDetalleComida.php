<?php
    #Verificar el inicio de sesión
    session_start();

    // Verifica si hay una sesión activa
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
        header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
        exit();
    }

?>

<script>
            var comidaSeleccionada; // Variable para almacenar la comida seleccionada
            // Agrega una variable para almacenar la información de las comidas
            var comidasData = <?php echo json_encode($data_comida['comidas']); ?>;
            //alert(JSON.stringify(comidasData, null, 2));

            function eliminarDetalleComida() {
                // Muestra una ventana de confirmación
                Swal.fire({
                    title: "¿Está seguro/a que desea eliminar las comidas asignadas?",
                    text: "¡No podrá revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, redirige a la URL deseada
                        // Si el usuario confirma, ejecuta la siguiente lógica
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Las comidas asignadas han sido eliminadas.",
                            showConfirmButton: false,
                            timer: 1500,
                            didClose: () => {
                                // Redirige a la URL deseada después de que se cierra el cuadro de diálogo
                                window.location.href = 'index.php?c=DetalleComida&a=eliminarDetalleComida&id=' + <?php echo $id; ?>;
                            }
                        });
                    } else {
                        // Si el usuario cancela, no hace nada o puedes mostrar un mensaje adicional
                        // alert("Eliminación cancelada");
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Eliminación cancelada",
                            showConfirmButton: false,
                            timer: 1500
                            });
                    }
                });
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
                    tablaComidas += '<td><button class="btn btn-outline-success seleccionar-comida" onclick="seleccionarComida(' + i + ', \'' + tipoComida + '\', \'' + idTipoComida + '\', \'' + idComida + '\', \'' + comidas[i].id_comida + '\', \'' + comidas[i].comida + '\', \'' + comidas[i].cantidad_proteina + '\', \'' + comidas[i].cantidad_carbohidratos + '\', \'' + comidas[i].cantidad_grasas_saludables + '\')">Actualizar</button></td>';

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
                document.body.classList.add('modal-background');

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
                document.body.classList.remove('modal-background');
            }

            function guardarComida(id_plan_nutri, id_comida_act, id_comida_nuev, dia) {
                // Mostrar SweetAlert
                Swal.fire({
                    title: "¡Actualizado!",
                    text: "La comida ha sido actualizada exitosamente.",
                    icon: "success",
                    showConfirmButton: false
                });

                // Esperar brevemente antes de enviar el formulario
                setTimeout(function () {
                    // Crear un formulario dinámicamente
                    var form = document.createElement('form');
                    form.action = 'index.php?c=DetalleComida&a=modificarDetalleComidaPlanNutricional'; // Cambiar la acción según la estructura de tus archivos
                    form.method = 'POST';

                    // Crear campos ocultos para enviar los datos
                    var input1 = document.createElement('input');
                    input1.type = 'hidden';
                    input1.name = 'id_plan_nutricional';
                    input1.value = id_plan_nutri;

                    var input2 = document.createElement('input');
                    input2.type = 'hidden';
                    input2.name = 'id_comida_act';
                    input2.value = id_comida_act;

                    var input3 = document.createElement('input');
                    input3.type = 'hidden';
                    input3.name = 'id_comida_nuev';
                    input3.value = id_comida_nuev;

                    var input4 = document.createElement('input');
                    input4.type = 'hidden';
                    input4.name = 'dia';
                    input4.value = dia;

                    // Agregar campos ocultos al formulario
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
                }, 2000); // Ajusta el tiempo de espera según sea necesario
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
                Swal.fire({
                    icon: "warning",
                    title: "Oops...",
                    text: "¡Esta comida ya está asignada!",
                    footer: '<a href="#">Why do I have this issue?</a>'
                });
            }
            // Verifica la respuesta del usuario
            else if (Swal.fire({
                title: "¿Está seguro que desea actualizar la comida en este día?",
                text: "¡No podrá revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, actualizar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(idTipoComida).innerHTML = '<span style="font-weight: bold;">ID:</span> ' + contenidoIdComida;
                    document.getElementById(idComida).innerHTML = '<span style="font-weight: bold;">Comida:</span> ' + contenidoComida;
                    document.getElementById('proteina-' + dia + '-' + tipoComida.toLowerCase()).innerHTML = '<strong>Proteína:</strong>' + proteina;
                    document.getElementById('carbohidratos-' + dia + '-' + tipoComida.toLowerCase()).innerHTML = '<strong>Carbohidratos:</strong>' + carbohidratos;
                    document.getElementById('grasas-' + dia + '-' + tipoComida.toLowerCase()).innerHTML = '<strong>Grasas Saludables:</strong>' + grasas;

                    guardarComida(id_plan_nutri, id_comida_actual, contenidoIdComida, diaMayuscula);

                    // El usuario ha hecho clic en "Sí"
                    
                    // Aquí puedes agregar la lógica para actualizar la comida
                }
            })); else {
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
                // Después de modificar, actualiza la fila en la página principal
                actualizarFilaComidaSeleccionada();
            }

            function cancelar() {
                

                Swal.fire({
                    title: "¿Desea salir sin modificar las comidas del plan nutricional?",
                    text: "¿Desea salir sin modificar las comidas del plan nutricional?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, cancelar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "¡Cancelado!",
                            text: "Ha cancelado la modificación de las comidas del plan nutricional.",
                            icon: "success",
                            didClose: () => {
                                // Si el usuario confirma, ejecuta la redirección
                                window.location.href = 'index.php?c=PlanNutricional&a=verPlanNutricional';
                            }
                        });
                    } else {
                        // Si el usuario cancela, no realiza ninguna acción
                        var modal = document.getElementById('myModal');
                        modal.style.display = 'none';
                    }
                });
            }

            window.onclick = function (event) {
                var modal = document.getElementById('myModal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                    document.body.classList.remove('modal-background');
                }
            };
        </script>


        <?php include("./src/View/templates/header_administrador.php")?>
        <!-- Contenido principal -->

            <div class="container">
                <div class="row">
                <div class="col-12 text-center">
                    <h2 class="titulo mt-4 mb-4 font-weight-bold">Modificar Comidas Asignadas</h2>
                </div>

                <div class="semana-info mb-4">
                    <div class="col-12 text-center">
                        <p class="rango-semana mt-4 mb-4 font-weight-bold" style="color: #444;">
                            Semana <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_inicio'])); ?> - <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_fin'])); ?>
                        </p>
                    </div>
                </div>

                <div class="plan-nutricional row">
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

                    $fechaMostrar = date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_inicio']));

                    foreach ($dias as $dia => $comidasPorTipo) :
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card dia-columna mb-4">
                                <div class="card-header" style="background-color: #004080; color: #fff;">
                                    <h3><?php echo $dia; ?> - <?php echo $fechaMostrar; ?></h3>
                                    <?php
                                        // Incrementa la fecha en un día
                                        $fechaMostrarObj = DateTime::createFromFormat('d/m/Y', $fechaMostrar);
                                        $fechaMostrarObj->add(new DateInterval('P1D')); // Agrega un día
                                        $fechaMostrar = $fechaMostrarObj->format('d/m/Y');
                                    ?>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Tipos de comida en el orden deseado
                                    $tiposDeComidaOrdenados = ["Desayuno", "Almuerzo", "Cena"];

                                    foreach ($tiposDeComidaOrdenados as $tipoComidaOrdenado) {
                                        if (isset($comidasPorTipo[$tipoComidaOrdenado])) {
                                            echo "<div class='tipo-comida mb-3'>";
                                            echo "<h4 style='color: #0066cc;'>{$tipoComidaOrdenado}</h4>";

                                            foreach ($comidasPorTipo[$tipoComidaOrdenado] as $comida) {
                                                echo "<div class='modulo'>";
                                                echo "<p><strong><center>Datos Comida</center></strong></p>";
                                                // Agrega IDs
                                                $idPrefix = strtolower($dia) . '-' . strtolower($tipoComidaOrdenado);
                                                echo "<p id='id-tipo-comida-{$idPrefix}'><strong>ID Comida:</strong> {$comida['id_comida']}</p>";
                                                echo "<p id='comida-{$idPrefix}'><strong>Comida:</strong> {$comida['comida']}</p>";
                                                echo "<p id='proteina-{$idPrefix}'><strong>Proteína:</strong> {$comida['cantidad_proteina']}</p>";
                                                echo "<p id='carbohidratos-{$idPrefix}'><strong>Carbohidratos:</strong> {$comida['cantidad_carbohidratos']}</p>";
                                                echo "<p id='grasas-{$idPrefix}'><strong>Grasas Saludables:</strong> {$comida['cantidad_grasas_saludables']}</p>";
                                                echo "<p id='descripcion-{$idPrefix}'><strong>Descripción:</strong> {$comida['descripcion']}</p>";
                                                

                                                echo "<div class='acciones'>";
                                                echo "<center><button class='btn btn-outline-primary actualizar-comida' onclick=\"mostrarModal('{$tipoComidaOrdenado}', 'id-tipo-comida-" . strtolower($dia) . '-' . strtolower($tipoComidaOrdenado) . "', 'comida-" . strtolower($dia) . '-' . strtolower($tipoComidaOrdenado) . "')\">Modificar</button></center>";
                                                echo "</div>";

                                                echo "</div>";
                                            }

                                            echo "</div>";
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Ventana Modal -->
                <div id="myModal" class="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="titulo-modal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="col-12 text-center">
                                    <h3 class="modal-title titulo-modal" id="titulo-modal" style="color: #004080;">Comidas - </h3>
                                </div>
                            </div>
                            <!-- Modifica el div para mostrar la tabla de comidas en la ventana modal -->
                            <div class="modal-body">
                                <div id="myModalContent">                                
                                    <table class="table table-bordered dataTable" id="tabla_id" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID Comida</th>
                                                <th>Comida</th>
                                                <th>Descripción</th>
                                                <th>Cantidad Proteína</th>
                                                <th>Cantidad Carbohidratos</th>
                                                <th>Cantidad Grasas Saludables</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <!-- Los datos de la tabla se llenarán dinámicamente aquí -->
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="cerrar_modal" class="btn btn-secondary" onclick="cerrarModal()" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .modal-content {
                        background-color: #fefefe;
                        padding: 15px;
                        border-radius: 40px;
                        box-shadow: 50px 50px 100px rgba(0, 0, 0, 0.8);
                    }

                    .modal-background::before {
                        content: "";
                        display: block;
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(0, 0, 0, 0.7);
                        z-index: 1040;
                    }
                </style>
            </div>
            <!-- Añade botones para guardar o cancelar -->
            
            
            </div>

            <div class="btn-container mt-4 text-center">
                <button class="btn btn-primary" onclick="eliminarDetalleComida()">Eliminar Comidas Asignadas</button>
                <button class="btn btn-secondary" class="btn-cancelar" onclick="cancelar()">Cancelar</button>
            </div>
            <br><br>
                
        </main>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
        
    </body>

<?php include("./src/View/templates/footer_administrador.php")?>