<?php include("./src/View/templates/header.php")?>

<style>

        /* Ajustes para la imagen en la parte derecha */
        .img-fluid {
            max-height: 400px; /* Ajusta el tamaño vertical de la imagen */
            margin-top: 20px; /* Espacio superior */
        }

        /* Centra horizontalmente el contenido del contenedor */
        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .contenedor {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

    </style>
    
<!-- Contenido principal -->
<main class="container center-container">
    <div class="row">
        <!-- Contenido en la parte izquierda -->
        <div class="col-md-8 contenedor">
            <h2>Tu Viaje Personalizado hacia la Salud Óptima</h2>
            <p>Bienvenido a NutriTrack, tu compañero en el viaje hacia una vida más saludable. Con nuestro seguimiento nutricional personalizado, te ofrecemos herramientas y asesoramiento para alcanzar tus metas de bienestar. Descubre una nueva forma de cuidar tu salud a través de la nutrición consciente y el seguimiento detallado de tus hábitos alimenticios. ¡Empieza hoy mismo tu camino hacia una vida más saludable y equilibrada con NutriVida!</p>
        </div>
        <!-- Imagen en la parte derecha -->
        <div class="col-md-4">
            <img src="./public/assets/images/main__img.jpg" alt="Imagen" class="img-fluid">
        </div>
    </div>
</main>


<?php include("./src/View/templates/footer.php")?>

