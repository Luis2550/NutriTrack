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
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "La fecha de inicio debe ser igual o posterior a la fecha actual."
        });
        fechaInicioInput.value = "";   // Limpiar la fecha inicio
        fechaFinInput.value = "";
        duracionDiasInput.value = "";
    }else if(fechaInicio > fechaFinSus){
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "La fecha de inicio debe ser menor o igual a la fecha final de la suscripción menos 7 días."
        });
        fechaInicioInput.value = "";   // Limpiar la fecha inicio
        fechaFinInput.value = "";
        duracionDiasInput.value = "";
    }
    else{
        // Calcular la fecha de fin sumando 7 días a la fecha de inicio
        var fechaFin = new Date(fechaInicio);
        fechaFin.setDate(fechaInicio.getDate() + 6);  // Sumar 6 días en lugar de 7

        // Calcular la duración en días
        var duracionDias = Math.ceil((fechaFin - fechaInicio) / (1000 * 60 * 60 * 24)) + 1;  // Sumar 1 para incluir el día de inicio

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

function cancelar() {
    Swal.fire({
        title: "¿Está seguro/a que quiere salir?",
        text: "¡No podrá revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "¡Cancelado!",
                text: "Ha cancelado el registro de un nuevo plan nutricional.",
                icon: "success"
            }).then(() => {
                var fechaInicioInput = document.getElementById("fecha_ini");
                fechaInicioInput.value = "";
                document.getElementById("error-message").innerHTML = "";
                window.location.href = 'http://localhost/nutritrack/index.php?c=PlanNutricional&a=verPlanNutricional';
            });
        }
    });
}

function mostrarMensajeExito() {
    Swal.fire({
        position: "center",
        icon: "success",
        title: "Registro Éxitoso",
        showConfirmButton: false,
        timer: 1500
    });
}

function onSubmitForm(clickedButton) {
    if (clickedButton === 'guardar') {
        mostrarMensajeExito();  // Muestra el mensaje de éxito
        // Simula un retraso antes de enviar el formulario (ajusta según tus necesidades)
        setTimeout(function() {
            // Aquí puedes agregar más lógica antes de enviar el formulario, si es necesario
            document.getElementById("modificar").submit();  // Envía el formulario manualmente
        }, 2000);  // Ejemplo: espera 2 segundos antes de enviar el formulario
    } else if (clickedButton === 'cancelar') {
        // Acciones específicas para el botón Cancelar
        Swal.fire({
            title: "¿Está seguro/a que quiere salir?",
            text: "¡No podrá revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "¡Cancelado!",
                    text: "Ha cancelado la actualización del plan nutricional.",
                    icon: "success"
                }).then(() => {
                    var fechaInicioInput = document.getElementById("fecha_ini");
                    fechaInicioInput.value = "";
                    document.getElementById("error-message").innerHTML = "";
                    window.location.href = 'http://localhost/nutritrack/index.php?c=PlanNutricional&a=verPlanNutricional';
                });
            }
        });
    }

    return false;  // Evita el envío automático del formulario
}
