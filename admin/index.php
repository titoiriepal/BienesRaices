<?php 
     
    require '../includes/app.php';

    use App\Propiedad;

    estaAutorizado();

    //Implementamos un método para obtener todas las propiedades
    $propiedades = Propiedad::all();
    

    //Mostrar el mensaje condicional
    $message = $_GET['message'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $id = $_POST['id'];
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

    //Incluir el template de cabecera
    incluirTemplate('header');
     
?>


     <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        

        <div class="errores">
        <?php switch(intval($message)) { 
            case 1: ?>
            <p class="alerta exito">Registro insertado correctamente</p>
        <?php break; 
            case 2 :?>
            <p class="alerta error">No se ha proporcionado un id para la actualización</p>

        <?php break; 
            case 3 :?>
            <p class="alerta error">El id proporcionado para la actualización no corresponde con ninguna propiedad</p>

        <?php break; 
            case 4 :?>
            <p class="alerta exito">Registro actualizado correctamente</p>

        <?php break; 
            case 5 :?>
            <p class="alerta exito">Registro borrado correctamente</p>

        <?php break; }?>
        </div>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

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
                                <input type="hidden" name="id" value="<?php echo $propiedad->id?>">
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