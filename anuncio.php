<?php 
    require 'includes/funciones.php';
    require 'includes/config/database.php';

     //Si no hay Id volvemos al index de administración

     if(!$_GET['id']){
        header('location: /admin?message=2');
    }

    //identificamos la propiedad

    $idPropiedad = (filter_var($_GET['id'],FILTER_VALIDATE_INT));
      

    if(!$idPropiedad){

        header('location:/');

    }else{

        $db=conectarDB(); 

        $query= "SELECT * FROM propiedades WHERE id = '$idPropiedad';";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        if(!$propiedad){
            header('location:/');
        }
    }
     
    

    incluirTemplate('header');
?>


     <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo'];?></h1>

                <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen'];?>" alt="Casa en venta" height="100%" width="100%">
            

            <div class="resumen-propiedad">
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
                
                <p><?php echo $propiedad['descripcion'];?></p>

                
            </div><!-- .Contenido Anuncio -->
        </div><!--.anuncio-->


     </main>

<?php 
    incluirTemplate('footer');
    mysqli_close($db);
?>