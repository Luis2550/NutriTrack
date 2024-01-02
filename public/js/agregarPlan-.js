function actualizarDatos() {
    var selector = document.getElementById("id_suscripcion");
    var duracion_diasInput = document.getElementById("duracion_dias");
    var selectedOption = selector.options[selector.selectedIndex];
    var duracion_dias = selectedOption.getAttribute("data-duracion_dias");
    duracion_diasInput.value = duracion_dias;


    //calcularFechas();
}

function calcularFechas(duracionDias) {
    var fechaInicioInput = document.getElementById("fecha_inicio");  // Corregido el ID aquí
    var fechaFinInput = document.getElementById("fecha_fin");
    var duracionDiasInput = document.getElementById("duracion_dias");

    // Obtener la fecha de inicio
    var fechaInicio = new Date(fechaInicioInput.value);

    // Verificar que la fecha de inicio sea mayor o igual a la fecha actual
    var fechaActual = new Date();
    if (fechaInicio < fechaActual) {
        alert("La fecha de inicio debe ser igual o posterior a la fecha actual.");
        fechaInicioInput.valueAsDate = fechaActual;  // Establecer la fecha actual
        fechaInicio = new Date(fechaActual);
    }

    // Calcular la fecha de fin sumando la duración en días a la fecha de inicio
    var fecha_fin = new Date(fechaInicio);
    fecha_fin.setDate(fechaInicio.getDate() + duracionDias);

    // Actualizar los campos en el formulario
    fechaFinInput.valueAsDate = fecha_fin;
    duracionDiasInput.value = duracionDias;
}


document.getElementById("fecha_inicio").addEventListener("change", function() {
    calcularFechas();
});
calcularFechas();