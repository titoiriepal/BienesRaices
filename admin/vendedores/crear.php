<?php

    use App\Vendedor;

    require '../../includes/app.php';

    estaAutorizado();

    $vendedor = new Vendedor();

    $errores = Vendedor::getErrores();

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $vendedor = new Vendedor($_POST);

        $errores = $vendedor->validar();

        if (empty($errores)){
            $resultado = $vendedor->guardar();
        }

        if($resultado){
            header('location:/admin?message=7');
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

        <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
            <?php 
                include TEMPLATES_URL."/formulario_vendedores.php";
            ?>

            <input type="submit" value="Crear Vendedor" class="boton boton-verde">


        </form>
     </main>

<?php 
    incluirTemplate('footer');
?>