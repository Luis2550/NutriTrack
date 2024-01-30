<footer>
  <!-- place footer here -->
</footer>


<!-- Scripts de Bootstrap y otros aquí -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</main>
    </div>
</div>

<script>
    function borrar(id){
        Swal.fire({
            title: "Desea borrar el registro?",
            showCancelButton: true,
            confirmButtonText: "Si, borrar",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location="index.php?txtID="+id;
            }
        });

    }
</script>

</body>
</html>
