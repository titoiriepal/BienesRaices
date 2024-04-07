<?php 
    require '../../includes/app.php';

    use App\Propiedad;
    use Intervention\Image\ImageManager as Image;
    use Intervention\Image\Drivers\Gd\Driver;

    estaAutorizado();

    //Base de datos

    
    $db=conectarDB(); 

        //Consultar la BD para obtener los vendedores

        $query= "SELECT * FROM vendedores;";
        $vendedores = mysqli_query($db, $query);

        //Arrego con mensajes de errores

        $errores= Propiedad::getErrores();

        $titulo = '';
        $precio = '';
        $descripcion = '';
        $habitaciones = '';
        $wc = '';
        $estacionamiento = '';
        $vendedores_id = '';



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
                $errores[] = 'Ha ocurrido un error en el envío del archivo: '. $imagen['error'];
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo $propiedad->titulo ?>" >

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" min="1" value="<?php echo $propiedad->precio ?>">

                <label for="imagen">Imágen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png, image/webp" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $propiedad->descripcion ?></textarea>

                <fieldset>
                    <legend>Información de la propiedad</legend>

                    <label for="habitaciones">Número de Habitaciones:</label>
                    <input type="number" id="habitaciones" name="habitaciones" placeholder="Número de habitaciones" min="1" max="9" value="<?php echo $propiedad->habitaciones ?>">

                    <label for="wc">Número de baños:</label>
                    <input type="number" id="wc" name="wc" placeholder="Número de baños" min="1" max="9" value="<?php echo $propiedad->wc ?>">

                    <label for="estacionamiento">Número de plazas de parking:</label>
                    <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Número de plazas de parking" min="0" max="9" value="<?php echo $propiedad->estacionamiento ?>">
                </fieldset>

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedores_id" id="vendedores_id">

                    <option value="" disabled selected>--Selecciona un vendedor--</option>
                    <?php  while ($vendedor = mysqli_fetch_assoc($vendedores))  : ?>
                        <option value="<?php echo $vendedor['id']?>"<?php echo $propiedad->vendedores_id == $vendedor['id'] ? 'selected' : '';?>><?php echo $vendedor['nombre'] . " " . $vendedor['apellidos']; ?></option> <!--Traemos el valor del id para el valor del option. Luego lo comparamos con el id anterior para ver si estaba seleccionado anteriormete. Finalmente cargamos el nombre y el apellido en la lista del option para poder seleccionarlo-->
                    <?php endwhile; ?>
                    <!-- <option value="1" <?php echo $vendedores_id == 1 ? 'selected' : ''?>>Antonio López</option>
                    <option value="2" <?php echo $vendedores_id == 2 ? 'selected': ''?>>María Perez</option> -->
                </select>
                
            

            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">


        </form>
     </main>

<?php 
    incluirTemplate('footer');
?>