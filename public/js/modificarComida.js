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
            document.getElementById("modificarComida").submit();  // Envía el formulario manualmente
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
                    text: "Ha cancelado la actualización de la comida.",
                    icon: "success"
                }).then(() => {
                    
                    window.location.href = 'http://localhost/nutritrack/index.php?c=Comida&a=verComida';
                });
            }
        });
    }

    return false;  // Evita el envío automático del formulario
}