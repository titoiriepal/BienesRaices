<?php 
     
    require '../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;

    estaAutorizado();

    //Implementamos un método para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();
    

    //Mostrar el mensaje condicional
    $message = $_GET['message'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        

        if($_POST['idPropiedad']){

            $id = $_POST['idPropiedad'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
    
                $propiedad = Propiedad::find($id);
                $resultado = $propiedad->eliminar();
                //Eliminar la imagen del servidor
    
                if($resultado){
                    $nombreImagen = $propiedad->imagen; 
    
                    if(file_exists(CARPETA_IMAGENES. $nombreImagen)){
                        unlink(CARPETA_IMAGENES . $nombreImagen);
                    }
                
                    header('location: /admin?message=5');
                }
            }
        }

        if($_POST['idVendedor']){
            
            $id = $_POST['idVendedor'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $vendedor = Vendedor::find($id);
                $resultado = $vendedor->eliminar();

                if($resultado){
                    header('location: /admin?message=6');
                }
            }
        }



    }

    //Incluir el template de cabecera
    incluirTemplate('header');
     
?>


     <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        

        <div class="errores">
        <?php switch(intval($message)) { 
            case 1: ?>
            <p class="alerta exito">Propiedad insertada correctamente</p>
        <?php break; 
            case 2 :?>
            <p class="alerta error">No se ha proporcionado un id para la actualización</p>

        <?php break; 
            case 3 :?>
            <p class="alerta error">El id proporcionado para la actualización no corresponde con ningun registro</p>

        <?php break; 
            case 4 :?>
            <p class="alerta exito">Propiedad actualizada correctamente</p>

        <?php break; 
            case 5 :?>
            <p class="alerta exito">Propiedad borrada correctamente</p>

        <?php break;  
            case 6 :?>
            <p class="alerta exito">Vendedor borrado correctamente</p>

        <?php break;}?>
        </div>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <h2>Propiedades</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php  foreach ($propiedades as $propiedad): ?>

                    <tr>
                        <td><?php echo $propiedad->id?></td>
                        <td><?php echo $propiedad->titulo?></td>
                        <td class="centrar">
                            <img class= "imagen-tabla" src="../imagenes/<?php echo $propiedad->imagen?>" alt="Imagen Propiedad" width="200px" height="160px">  
                        </td>
                        <td><?php echo $propiedad->precio?> €</td>
                        <td class= "acciones">
                            <a class="boton boton-amarillo-block" href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id?>">Actualizar</a>
                            <form action="" method="POST" class="w-100">
                                <input type="hidden" name="idPropiedad" value="<?php echo $propiedad->id?>">
                                <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                            </form>
                            

                        </td>
                    </tr>
                <?php endforeach; ?>

                
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Acciones</th>

                </tr>
            </thead>

            <tbody>
                <?php  foreach ($vendedores as $vendedor): ?>

                    <tr>
                        <td><?php echo $vendedor->id?></td>
                        <td><?php echo $vendedor->nombre?></td>
                        <td><?php echo $vendedor->apellidos?></td>
                        <td><?php echo $vendedor->telefono?></td>
                        <td class= "acciones">
                            <a class="boton boton-amarillo-block" href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id?>">Actualizar</a>
                            <form action="" method="POST" class="w-100">
                                <input type="hidden" name="idVendedor" value="<?php echo $vendedor->id?>">
                                <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                            </form>
                            

                        </td>
                    </tr>
                <?php endforeach; ?>
               
                
            </tbody>
        </table>


        
     </main>

<?php 

    //Cerrar conexión
    incluirTemplate('footer');
?>