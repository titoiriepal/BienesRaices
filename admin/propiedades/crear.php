<?php 

    

    //Base de datos

    require '../../includes/config/database.php';
    $db=conectarDB(); 

        //Arrego con mensajes de errores

        $errores=[];

        $titulo = '';
        $precio = '';
        $descripcion = '';
        $habitaciones = '';
        $wc = '';
        $estacionamiento = '';
        $vendedores_id = '';



        //Insertar en la base de datos

    if($_SERVER['REQUEST_METHOD']==='POST'){

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedores_id = $_POST['vendedores_id'];

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


        // echo '<pre>'; 
        // var_dump($errores); 
        // echo '</pre>'; 
    
        //Revisar  que el arreglo de errores esté vacío para  poder insertar los datos en la BD.
        if(empty($errores)){

            $query= "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedores_id) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedores_id')";    

            //echo $query;

            $resultado = mysqli_query($db, $query);
            
            if($resultado){
                echo "insertado correctamente";
            }else{
                echo "error en la creación del registro";
            };

        }

} 
    require '../../includes/funciones.php';
    incluirTemplate('header');  

?>


     <main class="contenedor seccion">
        <h1>Crer Propiedad</h1>

        <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

        <div class="errores">

        <?php foreach($errores as $error) :?>

            <p class="alerta error"><?php echo $error;?></p>

        <?php endforeach; ?>

        <?php if($resultado) { ?>
            <p class="alerta exito">Registro insertado correctamente</p>

        <?php }; ?>

        </div>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo $titulo ?>" >

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" min="1" value="<?php echo $precio ?>">

                <label for="imagen">Imágen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png, image/webp">

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

                    <option disabled selected>--Selecciona un vendedor--</option>
                    <option value="1" <?php echo $vendedores_id == 1 ? 'selected' : ''?>>Antonio López</option>
                    <option value="2" <?php echo $vendedores_id == 2 ? 'selected': ''?>>María Perez</option>
                </select>
                
            

            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">


        </form>
     </main>

<?php 
    incluirTemplate('footer');
?>