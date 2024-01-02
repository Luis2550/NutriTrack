// nuevoPlanNutricional.js
// nuevoPlanNutricional.js

function calcularFechas() {
    document.getElementById("error-message").innerHTML = "";

    var fechaInicioInput = document.getElementById("fecha_ini");
    var fechaFinInput = document.getElementById("fecha_fin");
    var duracionDiasInput = document.getElementById("duracionDias");

    // Obtener la fecha de inicio
    var fechaInicioLocal = new Date(fechaInicioInput.value + "T00:00:00");
    var fechaInicio = new Date(fechaInicioLocal.toLocaleString("en-US", { timeZone: "America/Guayaquil" }));
    

    // Verificar que la fecha de inicio sea mayor o igual a la fecha actual
    var fechaActual = new Date();
    var fechaActualEcuador = new Date(fechaActual.toLocaleString("en-US", { timeZone: "America/Guayaquil" }));
    fechaActual.setHours(0, 0, 0, 0); 
    
    //alert("fecha inicio: "+fechaActual);

    if (fechaInicio < fechaActual) {
        alert("La fecha de inicio debe ser igual o posterior a la fecha actual.");
        fechaInicioInput.value = "";   // Limpiar la fecha inicio
        fechaFinInput.value = "";
        duracionDiasInput.value = "";
    }else{
        // Calcular la fecha de fin sumando 7 días a la fecha de inicio
        var fechaFin = new Date(fechaInicio);
        fechaFin.setDate(fechaInicio.getDate() + 7);

        // Calcular la duración en días
        var duracionDias = Math.ceil((fechaFin - fechaInicio) / (1000 * 60 * 60 * 24));

        // Actualizar los campos en el formulario
        fechaFinInput.valueAsDate = fechaFin;
        duracionDiasInput.value = duracionDias;
        
    }
}




document.getElementById("fecha_ini").addEventListener("change", function() {
    calcularFechas();
});

calcularFechas();

function actualizarDatos() {
    document.getElementById("error-message").innerHTML = "";

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

function cambiarCINutriologa(){
    document.getElementById("error-message").innerHTML = "";
}

function confirmarCancelar() {
    var confirmacion = confirm("¿Desea salir sin guardar cambios?");
    if (confirmacion) {
        var fechaInicioInput = document.getElementById("fecha_ini");
        fechaInicioInput.value = "";
        document.getElementById("error-message").innerHTML = "";
        window.location.href = 'http://localhost/nutritrack/index.php?c=PlanNutricional&a=verPlanNutricional';
    }
}