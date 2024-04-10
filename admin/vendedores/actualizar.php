<?php

    use App\Vendedor;

    require '../../includes/app.php';

    estaAutorizado();

    

    //Si no hay Id volvemos al index de administración
    if(!$_GET['id']){
        header('location: /admin?message=2');
    }

    //identificamos la propiedad

    $idVendedor = filter_var($_GET['id'],FILTER_VALIDATE_INT) ;
    $vendedor = Vendedor::find( $idVendedor );

    

        //Si no hay una propiedad con el id especificado, volvemos a la principal de administración
    if (!$vendedor){
        header('location: /admin?message=3');
        
    }

    $errores = Vendedor::getErrores();

    if($_SERVER['REQUEST_METHOD']==='POST'){
         
        $vendedor->sincronizar($_POST);

        $errores = $vendedor->validar();

        if(empty($errores)){

            $resultado = $vendedor->guardar();

            if($resultado){
                header('location:/admin?message=8');
            }
        }
    }

    incluirTemplate('header');
?>


     <main class="contenedor seccion">
        <h1>Crear Vendedor</h1>

        <a href="/admin/index.php" class="boton boton-verde">Página de Administración</a>
        <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

        <div class="errores">

        <?php foreach($errores as $error) :?>

            <p class="alerta error"><?php echo $error;?></p>

        <?php endforeach; ?>

        </div>

        <form class="formulario" method="POST">
            <?php 
                include TEMPLATES_URL."/formulario_vendedores.php";
            ?>

            <input type="submit" value="Actualizar Vendedor" class="boton boton-verde">


        </form>
     </main>

<?php 
    incluirTemplate('footer');
?>