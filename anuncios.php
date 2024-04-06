<?php 
    require 'includes/funciones.php';

    incluirTemplate('header');
?>


     <main class="seccion contenedor">
        <h2>Casas y apartamentos en venta</h2>
        <?php 
            incluirTemplate('anuncios');
        ?>

    </main>

<?php 
    incluirTemplate('footer');
?>