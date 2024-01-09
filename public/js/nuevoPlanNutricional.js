// nuevoPlanNutricional.js
// nuevoPlanNutricional.js

function calcularFechas() {
    //alert("llegamos");
    document.getElementById("error-message").innerHTML = "";

    var fechaInicioInput = document.getElementById("fecha_ini");
    var fechaFinInput = document.getElementById("fecha_fin");
    var fechaFinSuscripcionInput = document.getElementById("fechaFinSuscripcion");
    var duracionDiasInput = document.getElementById("duracionDias");
    //alert(fechaFinSuscripcionInput);

    // Obtener la fecha de inicio
    var fechaInicioLocal = new Date(fechaInicioInput.value + "T00:00:00");
    var fechaInicio = new Date(fechaInicioLocal.toLocaleString("en-US", { timeZone: "America/Guayaquil" }));
    var fechaFinSus = new Date(fechaFinSuscripcionInput.value + "T00:00:00");
    fechaFinSus.setDate(fechaFinSus.getDate() - 7);

    //alert(fechaFinSus);

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
    }else if(fechaInicio > fechaFinSus){
        alert("La fecha de inicio debe ser menor o igual a la fecha final de la suscripción menos 7 días.");
        fechaInicioInput.value = "";   // Limpiar la fecha inicio
        fechaFinInput.value = "";
        duracionDiasInput.value = "";
    }
    else{
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
    var fechaFinSuscripcionInput = document.getElementById("fechaFinSuscripcion");
    var estadoInput = document.getElementById("estado");

    var selectedOption = selector.options[selector.selectedIndex];

    nombresInput.value = selectedOption.getAttribute("data-nombres");
    apellidosInput.value = selectedOption.getAttribute("data-apellidos");
    fechaFinSuscripcionInput.value = selectedOption.getAttribute("data-fechafinsuscripcion");
    estadoInput.value = selectedOption.getAttribute("data-estado");
    calcularFechas();

    // calcularFechas();
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