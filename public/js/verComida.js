function confirmarEliminarComida(idPlanNutricional) {
    Swal.fire({
        title: "¿Está seguro/a de que desea eliminar esta comida?",
        text: "¡No podrá revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarla"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Eliminado",
                text: "La comida ha sido eliminado.",
                icon: "success"
            }).then(() => {
                // Aquí puedes agregar lógica adicional antes de redirigir o realizar otras acciones
                window.location.href = 'index.php?c=Comida&a=eliminarComida&id=' + idPlanNutricional;
            });
        }
    });

    // Cancelar el evento de clic por defecto del enlace
    return false;
}

function confirmarEliminarComida(idComida) {
    Swal.fire({
        title: "¿Está seguro/a de que desea eliminar esta comida?",
        text: "¡No podrá revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarla"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Eliminado",
                text: "La comida ha sido eliminada.",
                icon: "success"
            }).then(() => {
                // Aquí puedes agregar lógica adicional antes de redirigir o realizar otras acciones
                window.location.href = 'index.php?c=Comida&a=eliminarComida&id=' + idComida;
            });
        }
    });

    // Cancelar el evento de clic por defecto del enlace
    return false;
}



