function confirmarCancelar() {
    var confirmacion = confirm("¿Desea salir sin guardar cambios?");
    if (confirmacion) {
        window.location.href = 'http://localhost/nutritrack/index.php?c=Comida&a=verComida';
    }
}