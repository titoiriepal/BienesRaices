
<?php

use App\Propiedad;

        if($_SERVER['SCRIPT_NAME'] === '/index.php'){
            $propiedades= Propiedad::get(3);
        }else if($_SERVER['SCRIPT_NAME'] === '/anuncios.php'){
            $propiedades= Propiedad::get(9);
        }
    
    
          
?>

<div class="contenedor-anuncios">

<?php  foreach ($propiedades as $propiedad)  : ?>

    
    <div class="anuncio">
            <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen;?>" alt="Casa en venta">
        

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo;?></h3>
            <p><?php echo $propiedad->descripcion;?></p>
            <p class="precio"><?php echo $propiedad->precio;?>€</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img//icono_wc.svg" alt="Icono wc" height="100%" width="100%">
                    <p><?php echo $propiedad->wc;?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img//icono_estacionamiento.svg" alt="Icono estacionamiento" height="100%" width="100%">
                    <p><?php echo $propiedad->estacionamiento;?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img//icono_dormitorio.svg" alt="Icono dormitorios" height="100%" width="100%">
                    <p><?php echo $propiedad->habitaciones;?></p>
                </li>
            </ul>

            <a href="anuncio.php?id=<?php echo $propiedad->id;?>" class="boton boton-amarillo-block">Ver Propiedad</a>
        </div><!-- .Contenido Anuncio -->
    </div><!--.anuncio-->
<?php endforeach; ?>

</div><!--.contenedor-anuncios-->
