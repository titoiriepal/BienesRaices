<?php 
    require '../includes/funciones.php';
    incluirTemplate('header');
     
?>


     <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <div class="errores">
        <?php if($_GET['message'] === '1') { ?>
            <p class="alerta exito">Registro insertado correctamente</p>

        <?php }; ?>
        </div>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        

        
     </main>

<?php 
    incluirTemplate('footer');
?>