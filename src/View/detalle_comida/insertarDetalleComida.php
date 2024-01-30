<?php
    #Verificar el inicio de sesión
    session_start();

    // Verifica si hay una sesión activa
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'Nutriologa') {
        header('Location: http://localhost/Nutritrack/index.php?c=Inicio&a=inicio_sesion'); // Redirige si no hay sesión o el rol no es correcto
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Asignar Comidas</title>

        <!-- Agrega los enlaces a Bootstrap y jQuery -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!--<link rel="stylesheet" href="./public/css/insertar_detalle_comida.css">-->

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
                    tablaComidas += '<td><button id="btnSeleccionarComida" class="btn btn-outline-success seleccionar-comida" onclick="seleccionarComida(' + i + ', \'' + tipoComida + '\', \'' + idTipoComida + '\', \'' + idComida + '\', \'' + comidas[i].id_comida + '\', \'' + comidas[i].comida + '\')">Seleccionar</button></td>';

                    tablaComidas += '</tr>';
                }

                tablaComidas += '</table>';

                // Insertar la tabla en el contenido de la ventana modal
                document.getElementById('myModalContent').innerHTML = tablaComidas;
            }

            function mostrarModal(tipoComida, idTipoComida, idComida) {
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
                document.getElementById(idTipoComida).innerHTML = '';
                document.getElementById(idComida).innerHTML = '';            
            }

            function cerrarModal() {
                // Limpiar la variable de comida seleccionada al cerrar el modal
                comidaSeleccionada = null;

                var modal = document.getElementById('myModal');
                modal.style.display = 'none';
                document.body.classList.remove('modal-background');
            }

            function guardarComida() {
                // Insertar las comidas al plan nutricional semanal
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
                //Seleccionar comidas
                //document.body.classList.remove('modal-background');
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
                    document.body.classList.remove('modal-background');
                }
            };
        </script>
    </head>

    <body class="bg-light" id="body">
        
        <?php include("./src/View/templates/header_admin.php")?>
        
        <!-- Contenido principal -->
        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-md-4 main-content">
            <div class="container">
                <div class="col-12 text-center"> <!-- Agregamos una columna que ocupa todo el ancho y centraremos su contenido -->
                    <h2 class="titulo mt-4 mb-4 font-weight-bold">Plan Nutricional Semanal</h2>
                </div>

                <div class="semana-info mb-4">
                    <div class="col-12 text-center"> <!-- Agregamos una columna que ocupa todo el ancho y centraremos su contenido -->
                        <p class="rango-semana mt-4 mb-4 font-weight-bold" style="color: #444;">Semana <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_inicio'])); ?> - <?php echo date('d/m/Y', strtotime($data['detalle_comida'][0]['fecha_fin'])); ?></p>
                    </div>         
                </div>

                <div class="plan-nutricional row">
                    <?php
                    $fechaInicio = new DateTime($data['detalle_comida'][0]['fecha_inicio']);
                    $fechaFin = new DateTime($data['detalle_comida'][0]['fecha_fin']);
                    
                    // Asegurémonos de que se muestre el último día
                    $intervaloDias = new DateInterval('P1D');
                    $fechaFin->add($intervaloDias); // Agregamos 1 día al final para incluirlo
                    $periodo = new DatePeriod($fechaInicio, $intervaloDias, $fechaFin);
                    $tiposComida = ['Desayuno', 'Almuerzo', 'Cena'];
                    
                    function obtenerDia($fecha) {
                        // Convierte la fecha en DateTime
                        $dateTime = DateTime::createFromFormat('d/m/Y', $fecha);
                    
                        // Mapeo de nombres de días en español
                        $diasSemana = [
                            'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'
                        ];
                    
                        // Obtiene el nombre del día en español
                        $nombreDia = $diasSemana[$dateTime->format('w')];
                    
                        return $nombreDia;
                    }

                    foreach ($periodo as $dia) {
                        // Obtener el nombre del día usando la función
                        $nombreDia = obtenerDia($dia->format('d/m/Y'));
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card dia-columna mb-4">
                                <div class="card-header" style="background-color: #004080; color: #fff;">
                                    <h3><?php echo $nombreDia . " - " . $dia->format('d/m/Y'); ?></h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    foreach ($tiposComida as $tipo) {
                                        $idTipoComida = 'id-tipo-comida-' . strtolower($nombreDia) . '-' . strtolower($tipo);
                                        $idComida = 'comida-' . strtolower($nombreDia) . '-' . strtolower($tipo);
                                    ?>
                                        <div class="tipo-comida mb-3">
                                            <h4><?php echo $tipo; ?></h4>
                                            <div class="modulo">
                                                <!-- Detalles del tipo de comida -->
                                                <div id="<?php echo $idTipoComida; ?>"></div>
                                                <div id="<?php echo $idComida; ?>"></div>
                                                <div class="acciones mt-2">
                                                    <button class='btn btn-outline-primary elegir-comida' id="elegir-comida" onclick="mostrarModal('<?php echo $tipo; ?>', '<?php echo $idTipoComida; ?>', '<?php echo $idComida; ?>')">Elegir Comida</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
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

                
                <!-- Script y estilo para oscurecer el fondo -->
                
            
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

                

                <!-- Añade botones para guardar o cancelar -->
                <div class="btn-container mt-4 text-center">
                    <button id="btnGuardar" class="btn btn-primary" onclick="guardarComida()">Guardar</button>
                    <button id="btnCancelar" class="btn btn-secondary" onclick="cancelar()">Cancelar</button>
                </div>
            </div>
        </main>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
        <script>
            // Inicializar DataTable con opciones
            $(document).ready(function () {
                $('#tabla_id').DataTable({
                    searching: true, // Habilitar la barra de búsqueda
                    ordering: true,  // Habilitar la ordenación de columnas
                    // Puedes agregar más opciones según tus necesidades
                });
            });
        </script>
    </body>

<?php include("./src/View/templates/footer_admin.php")?>