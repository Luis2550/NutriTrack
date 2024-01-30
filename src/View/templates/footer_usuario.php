<footer>
  <!-- place footer here -->
</footer>

<script>
  $(document).ready(function(){
    $("#tabla_id").DataTable({
      "pagelength":3,
      lengthMenu:[
        [5,10,25,50],
        [5,10,25,50]
      ],
      "language":{
        "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
      }
    });
  
  });
</script>


<script>
    // Arreglo de días permitidos
    var diasPermitidos = <?php echo json_encode($diasPermitidos); ?>;
    var diasFeriados = <?php echo json_encode($configuraciones[0]['dias_Feriados']); ?>;
    console.log(diasPermitidos);
    console.log(diasFeriados);

    // Función para verificar si es feriado o no laboral
    document.getElementById('fecha2').addEventListener('input', function() {
        var seleccionada = new Date(this.value);
        var diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        var diaSeleccionado = diasSemana[seleccionada.getDay()];

        // Formatear la fecha seleccionada al formato 'YYYY-MM-DD'
        var fechaFormateada = seleccionada.toISOString().split('T')[0];

        if (diasFeriados.includes(fechaFormateada)) {
            alert('Este día es feriado');
            this.value = ''; // Limpiar el valor
        } else if (!diasPermitidos.includes(diaSeleccionado)) {
            alert('Este día no es laboral');
            this.value = ''; // Limpiar el valor
        }
    });
</script>

<script>
    var comidaSeleccionada; // Variable para almacenar la comida seleccionada

    // Agrega una variable para almacenar la información de las comidas
    var comidasData = <?php echo json_encode($data_comida['comidas']); ?>;
    //alert(JSON.stringify(comidasData, null, 2));


    // Agrega esta función para construir la tabla de comidas
    function construirTablaComidas(descripcion, tipoComida, idTipoComida, idComida) {
        // Crear un div para mostrar la descripción
        var descripcionDiv = document.createElement('div');
        descripcionDiv.innerHTML = '<strong>Descripción:</strong> ' + (descripcion !== undefined ? descripcion : 'N/A');
    
        // Insertar el div de descripción en el contenido de la ventana modal
        document.getElementById('myModalContent').innerHTML = '';
        document.getElementById('myModalContent').appendChild(descripcionDiv);
    }

    function mostrarModal(tipoComida, idTipoComida, idComida, descripcion) {
        /*alert(tipoComida);
        alert(idTipoComida);
        alert(idComida);*/
        //alert(descripcion);
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';

        // Filtrar las comidas según el tipoComida
       // var comidasFiltradas = filtrarComidasPorTipo(tipoComida);
        //alert(JSON.stringify(comidasFiltradas, null, 2));

        document.getElementById('titulo-modal').innerHTML = 'Comidas - ' + tipoComida;

        // Cargar la tabla de comidas en la ventana modal
        construirTablaComidas(descripcion, tipoComida, idTipoComida, idComida);

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

    window.onclick = function (event) {
        var modal = document.getElementById('myModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    };
    </script>

<!-- Scripts de Bootstrap y otros aquí -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</main>
    </div>
</div>

</body>
</html>
