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
    console.log(diasPermitidos);

    // Función para deshabilitar fechas no permitidas
    document.getElementById('fecha2').addEventListener('input', function() {
        var seleccionada = new Date(this.value);
        var diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado','Domingo'];
        var diaSeleccionado = diasSemana[seleccionada.getDay()];

        if (!diasPermitidos.includes(diaSeleccionado)) {
            alert('Este día no es laboral');
            this.value = ''; // Limpiar el valor
        }
    });
</script>


    </body>
    </html>