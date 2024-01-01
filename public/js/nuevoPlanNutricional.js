// nuevoPlanNutricional.js
// nuevoPlanNutricional.js

function calcularFechas() {
    var fechaInicioInput = document.getElementById("fecha_ini");
    var fechaFinInput = document.getElementById("fecha_fin");
    var duracionDiasInput = document.getElementById("duracionDias");

    // Obtener la fecha de inicio
    var fechaInicio = new Date(fechaInicioInput.value);

    // Verificar que la fecha de inicio sea mayor o igual a la fecha actual
    var fechaActual = new Date();
    if (fechaInicio < fechaActual) {
        alert("La fecha de inicio debe ser igual o posterior a la fecha actual.");
        fechaInicioInput.valueAsDate = fechaActual;  // Establecer la fecha actual
        fechaInicio = new Date(fechaActual);
    }

    // Calcular la fecha de fin sumando 7 días a la fecha de inicio
    var fechaFin = new Date(fechaInicio);
    fechaFin.setDate(fechaInicio.getDate() + 7);

    // Calcular la duración en días
    var duracionDias = Math.ceil((fechaFin - fechaInicio) / (1000 * 60 * 60 * 24));

    // Actualizar los campos en el formulario
    fechaFinInput.valueAsDate = fechaFin;
    duracionDiasInput.value = duracionDias;
}

document.getElementById("fecha_ini").addEventListener("change", function() {
    calcularFechas();
});

calcularFechas();

function actualizarDatos() {
    var selector = document.getElementById("ci_paciente");
    var nombresInput = document.getElementById("nombres");
    var apellidosInput = document.getElementById("apellidos");
    var selectedOption = selector.options[selector.selectedIndex];
    var nombres = selectedOption.getAttribute("data-nombres");
    var apellidos = selectedOption.getAttribute("data-apellidos");
    nombresInput.value = nombres;
    apellidosInput.value = apellidos;

    //calcularFechas();
}
