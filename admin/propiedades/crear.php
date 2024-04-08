<?php 
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;

    estaAutorizado();

    $db=conectarDB(); 

    //Consultar la BD para obtener los vendedores

    $query= "SELECT * FROM vendedores;";
    $vendedores = mysqli_query($db, $query); 


    $propiedad = new Propiedad();



        //Arrego con mensajes de errores

        $errores= Propiedad::getErrores();

        //Insertar en la base de datos


    if($_SERVER['REQUEST_METHOD']==='POST'){

        $propiedad = new Propiedad($_POST);

         //Generar un nombre único
        
        if($_FILES['imagen']['tmp_name']){

            $typeImagen = $_FILES['imagen']['type'];

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
            $nombreImagen = md5(uniqid(rand(), true)) . $extension;

            //creamos la imagen con Imagemin
            $manager = new Image(Driver::class);
            //Transformamos la imagen y la cambiamos el tamaño
            $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800,600);  

            //añadimos el nombre de la imagen a los atributos de Propiedad, siempre y cuando haya una imagen
            $propiedad->setImagen($nombreImagen);
         
           }

           $errores = $propiedad->validar();
           if($_FILES['imagen']['error']){
                $errores[] = 'Ha ocurrido un error en el envío del archivo: '. $_FILES['imagen']['error'];
            }
        

        //Revisar  que el arreglo de errores esté vacío para  poder insertar los datos en la BD.
        if(empty($errores)){


            //Crear Carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //Subir la imagen
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            /**Subida de archivos*/
            $resultado = $propiedad->guardar();             

            if($resultado){
                header('location: /admin?message=1');
            }

        }

    } 
    
    incluirTemplate('header');  

?>


     <main class="contenedor seccion">
        <h1>Crear Propiedad</h1>

        <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

        <div class="errores">

        <?php foreach($errores as $error) :?>

            <p class="alerta error"><?php echo $error;?></p>

        <?php endforeach; ?>

        </div>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php 
                include TEMPLATES_URL."/formulario_propiedades.php";
            ?>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">


        </form>
     </main>

<?php 
    incluirTemplate('footer');
?>