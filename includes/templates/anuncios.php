
<?php 
        require __DIR__ . '/../config/database.php';
    
        $db=conectarDB(); 

        if($inicio){
            $query= "SELECT * FROM propiedades LIMIT 3;";
        }else{
            $query= "SELECT * FROM propiedades;";
        }
    
        
        $resultado = mysqli_query($db, $query);
          
?>

<div class="contenedor-anuncios">

<?php  while ($propiedad = mysqli_fetch_assoc($resultado))  : ?>

    
    <div class="anuncio">
            <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen'];?>" alt="Casa en venta">
        

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo'];?></h3>
            <p><?php echo $propiedad['descripcion'];?></p>
            <p class="precio"><?php echo $propiedad['precio'];?>€</p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img//icono_wc.svg" alt="Icono wc" height="100%" width="100%">
                    <p><?php echo $propiedad['wc'];?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img//icono_estacionamiento.svg" alt="Icono estacionamiento" height="100%" width="100%">
                    <p><?php echo $propiedad['estacionamiento'];?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img//icono_dormitorio.svg" alt="Icono dormitorios" height="100%" width="100%">
                    <p><?php echo $propiedad['habitaciones'];?></p>
                </li>
            </ul>

            <a href="anuncio.php?id=<?php echo $propiedad['id'];?>" class="boton boton-amarillo-block">Ver Propiedad</a>
        </div><!-- .Contenido Anuncio -->
    </div><!--.anuncio-->
<?php endwhile; ?>

</div><!--.contenedor-anuncios-->

<?php 
    mysqli_close($db); 
?>