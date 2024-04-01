





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
</head>
<body>
     <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.php">
                    <img src="build/img/logo.svg" width="100%" height="100%" alt="Logotipo de la empresa Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="build/img/barras.svg" alt="Icono Menú Responsive" height="50%" width="50%">
                </div>

                <div class="derecha">

                    <img src="build/img/dark-mode.svg" alt="Botón para el dark mode" class="dark-mode-boton" width="50%" height="50%">
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">Contacto</a>
                    </nav>
                    

                </div>



            </div><!-- barra -->
            <?php if($inicio) {?> 
                <h1>Venta de Casas y apartamentos exclusivos de lujo</h1>
            <?php }; ?>

        </div>
     </header>