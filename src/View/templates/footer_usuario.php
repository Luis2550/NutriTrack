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

<!-- Incluye Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
<script>
  flatpickr("#fecha2", {
    enableTime: false,
    dateFormat: "Y-m-d",
    defaultDate: "today",
    altInput: true,
    altFormat: "F j, Y",
    inline: true,
    locale: "es", // Configura el idioma a español
  });
</script>

    </body>
    </html>