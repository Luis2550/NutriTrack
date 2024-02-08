function confirmarEliminarPlanNutricional(idPlanNutricional) {
    Swal.fire({
        title: "¿Está seguro/a de que desea eliminar este plan nutricional?",
        text: "¡No podrá revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminarlo"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Eliminado",
                text: "El plan nutricional ha sido eliminado.",
                icon: "success"
            }).then(() => {
                // Aquí puedes agregar lógica adicional antes de redirigir o realizar otras acciones
                window.location.href = 'index.php?c=planNutricional&a=eliminarPlanNutricional&id=' + idPlanNutricional;
            });
        }
    });

    // Cancelar el evento de clic por defecto del enlace
    return false;
}
