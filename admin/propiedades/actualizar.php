<?php

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;

    require '../../includes/app.php';
    

    estaAutorizado();


    //Si no hay Id volvemos al index de administración

    if(!$_GET['id']){
        header('location: /admin?message=2');
    }

    //identificamos la propiedad

    $idPropiedad = filter_var($_GET['id'],FILTER_VALIDATE_INT) ;
     

    //Consultar la BD para obtener la propiedad

    $propiedad = Propiedad::find( $idPropiedad );

    //Si no hay una propiedad con el id especificado, volvemos a la principal de administración
    if (!$propiedad){
            header('location: /admin?message=3');
        
    }

    //Almacenamos el nombre de la imagen para comprobar si hay imagen en el registro
    $nombreImagen = $propiedad->imagen;

    //Consulta para obtener los vendedores de BD

    $vendedores = Vendedor::all();

    $errores=[];

    if($_SERVER['REQUEST_METHOD']==='POST'){
         
        $propiedad->sincronizar($_POST);

        //Asignar files hacia una variable

        $imagen = $_FILES[ 'imagen' ] ?? '';

         
        $errores = $propiedad->validar();
        //Comprobar que existe la imagen y que pesa menos de 200KB
         

        $limiteKB=2000000; //Limite de 2MB para las imagenes
        if(!$imagen['name'] && !$propiedad->imagen){
            $errores[] = 'La imagen es obligatoria';
        }else if($imagen['name'] && $imagen['error']){
            $errores[] = 'Ha ocurrido un error en el envío del archivo: '. $imagen['error'];
        
        }else if($imagen['name'] && $imagen['size'] > $limiteKB){
            $errores[] = "El archivo es demasiado grande. El tamaño máximo permitido son " . $limiteKB / 1000 . "KB";
        }


        if(empty($errores)){


            if($imagen['name']){ //Si se ha elegido una imagen, cambiamos la imagen elegida

                //Crear Carpeta

                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
    
                //Borramos la imagen anterior si esta existe
    
                if ($propiedad->imagen){
                    if(file_exists(CARPETA_IMAGENES. $propiedad->imagen)){
                        unlink(CARPETA_IMAGENES. $propiedad->imagen);
                    }
                }
    
    
                /**Subida de archivos*/
    
                //Subir la imagen
                //Identificamos el tipo de imagen para poner la extensión en la bd
                $typeImagen = $imagen['type'];
    
                switch ($typeImagen) {
                    case 'image/png':
                        $extension = '.png';
                        break;
                    
                    case 'image/webp':
                        $extension = '.webp';
                        break;
                    
                    default:
                        $extension = '.jpg';
                        break;
                }
    
                //Generar un nombre único
                $nombreImagen = md5(uniqid(rand(), true)) . $extension;
    
                            //creamos la imagen con Imagemin
                $manager = new Image(Driver::class);
                //Transformamos la imagen y la cambiamos el tamaño
                $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800,600); 

                //Guardamos la imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //añadimos el nombre de la imagen a los atributos de Propiedad, siempre y cuando haya una imagen
                $propiedad->setImagen($nombreImagen);

            }

            /**Subida de archivos*/
            $resultado = $propiedad->guardar();  

            if($resultado){
                header('location: /admin?message=4');
            }

        }
    
    }    

    incluirTemplate('header');
?>


     <main class="contenedor seccion">
        <h1>Actualizar propiedad</h1>
        <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

        <div class="errores">

        <?php foreach($errores as $error) :?>

            <p class="alerta error"><?php echo $error;?></p>

        <?php endforeach; ?>

        </div>

     <form class="formulario" method="POST" action="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id ?>" enctype="multipart/form-data">

            <?php 
                include TEMPLATES_URL."/formulario_propiedades.php";
            ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">


    </form>

</main>
     

<?php 
    incluirTemplate('footer');
?>