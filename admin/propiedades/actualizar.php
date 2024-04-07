<?php 
    require '../../includes/app.php';
    

    $auth = estaAutorizado();
    if (!$auth) {
        header("Location:/");
    }

    //Si no hay Id volvemos al index de administración

    if(!$_GET['id']){
        header('location: /admin?message=2');
    }

    //identificamos la propiedad

    $idPropiedad = filter_var($_GET['id'],FILTER_VALIDATE_INT) ;
     

    //Consultar la BD para obtener la propiedad

    $db=conectarDB(); 
    $query= "SELECT * FROM propiedades WHERE id = '" . $idPropiedad . "'";
    $resultado = mysqli_query($db, $query);

    //Si no hay una propiedad con el id especificado, volvemos a la principal de administración
    if ($resultado->num_rows == 0){
            header('location: /admin?message=3');
        
    }

    //Cargamos los datos de la propiedad
    $propiedad = mysqli_fetch_assoc($resultado); 

    $id=$propiedad['id'] ;
    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedores_id = $propiedad['vendedores_id'];

    //Almacenamos el nombre de la imagen para comprobar si hay imagen en el registro
    $nombreImagen = $propiedad['imagen'];

    //Consulta para obtener los vendedores de BD

    $query= "SELECT * FROM vendedores;";
    $vendedores = mysqli_query($db, $query);

    $errores=[];

    if($_SERVER['REQUEST_METHOD']==='POST'){

        // echo '<pre>'; 
        // var_dump($_FILES); 
        // echo '</pre>'; 
         

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']);
        $precio = mysqli_real_escape_string( $db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string( $db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string( $db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string( $db, $_POST['estacionamiento']);
        $vendedores_id = mysqli_real_escape_string( $db, $_POST['vendedores_id']);

        //Asignar files hacia una variable

        $imagen = $_FILES[ 'imagen' ];

         
        if(!$titulo){
            $errores[] = 'Debes añadir un título';
        }else if( strlen($titulo) > 45){
            $errores[] = 'El título no debe superar los 45 caracteres';
        }

        if(!$precio){
            $errores[] = 'Debes añadir un precio';
        }else if( $precio < 1){
            $errores[] = 'Introduce un precio mayor que 0';
        }

        if(!$descripcion){
            $errores[] = 'Debes añadir una descripción';
        }else if( strlen($descripcion) < 50){
            $errores[] = 'La descripción ha de contener, al menos, 50 caracteres';
        }

        if(!$habitaciones){
            $errores[] = 'Debes añadir un número de habitaciones';
        }else if( $habitaciones < 1){
            $errores[] = 'Introduce un número de habitaciones mayor que 0';
        }

        if(!$wc){
            $errores[] = 'Debes añadir un número de baños';
        }else if( $wc < 1){
            $errores[] = 'Introduce un número de baños mayor que 0';
        }

        if(!$estacionamiento){
            $errores[] = 'Debes añadir un número de estacionamientos';
        }else if( $estacionamiento < 0){
            $errores[] = 'No puedes introducir un número negativo de estacionamientos';
        }

        if(!$vendedores_id){
            $errores[] = 'Debes elegir un vendedor';
        }

        //Comprobar que existe la imagen y que pesa menos de 200KB
         

        $limiteKB=2000000; //Limite de 2MB para las imagenes
        if(!$imagen['name'] && !$nombreImagen){
            $errores[] = 'La imagen es obligatoria';
        }else if($imagen['name'] && $imagen['error']){
            $errores[] = 'Ha ocurrido un error en el envío del archivo: '. $imagen['error'];
        
        }else if($imagen['name'] && $imagen['size'] > $limiteKB){
            $errores[] = "El archivo es demasiado grande. El tamaño máximo permitido son " . $limiteKB / 1000 . "KB";
        }


        if(empty($errores)){


            if($imagen['name']){ //Si se ha elegido una imagen, cambiamos la imagen elegida

                $carpetaImagenes = '../../imagenes';

                if(!is_dir($carpetaImagenes)){
                    mkdir($carpetaImagenes);
                }
    
                //Borramos la imagen anterior si esta existe
    
                if ($nombreImagen){
                    if(file_exists($carpetaImagenes . '/'. $nombreImagen)){
                        unlink($carpetaImagenes . '/'. $nombreImagen);
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
    
                move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . "/" . $nombreImagen);

            }

             //Crear Carpeta


            $query= "UPDATE propiedades SET titulo = '$titulo', precio = '$precio', imagen ='$nombreImagen', descripcion = '$descripcion', habitaciones = '$habitaciones', wc = '$wc', estacionamiento = '$estacionamiento', vendedores_id = '$vendedores_id' WHERE id = '$id'";
        
             

            $resultado = mysqli_query($db, $query);

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

     <form class="formulario" method="POST" action="/admin/propiedades/actualizar.php?id=<?php echo $id ?>" enctype="multipart/form-data">

        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo $titulo ?>" >

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" min="1" value="<?php echo $precio ?>">

            <label for="imagen">Imágen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png, image/webp" name="imagen">

            <img src="/imagenes/<?php echo $nombreImagen;?>" alt="" height="100px" width="150px" class="imagen-actualizar">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion ?></textarea>

            <fieldset>
                <legend>Información de la propiedad</legend>

                <label for="habitaciones">Número de Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Número de habitaciones" min="1" max="9" value="<?php echo $habitaciones ?>">

                <label for="wc">Número de baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Número de baños" min="1" max="9" value="<?php echo $wc ?>">

                <label for="estacionamiento">Número de plazas de parking:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Número de plazas de parking" min="0" max="9" value="<?php echo $estacionamiento ?>">
            </fieldset>

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedores_id" id="vendedores_id">

                <option value="" disabled selected>--Selecciona un vendedor--</option>
                <?php  while ($vendedor = mysqli_fetch_assoc($vendedores))  : ?>
                    <option value="<?php echo $vendedor['id']?>"<?php echo $vendedores_id == $vendedor['id'] ? 'selected' : '';?>><?php echo $vendedor['nombre'] . " " . $vendedor['apellidos']; ?></option> <!--Traemos el valor del id para el valor del option. Luego lo comparamos con el id anterior para ver si estaba seleccionado anteriormete. Finalmente cargamos el nombre y el apellido en la lista del option para poder seleccionarlo-->
                <?php endwhile; ?>
                <!-- <option value="1" <?php echo $vendedores_id == 1 ? 'selected' : ''?>>Antonio López</option>
                <option value="2" <?php echo $vendedores_id == 2 ? 'selected': ''?>>María Perez</option> -->
            </select>
            


        </fieldset>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">


    </form>

</main>
     

<?php 
    incluirTemplate('footer');
?>