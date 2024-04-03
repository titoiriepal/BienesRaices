<?php 
    require '../includes/funciones.php';
    require '../includes/config/database.php';


    $db=conectarDB(); 

    $query= "SELECT id,titulo,precio,imagen FROM propiedades;";
    $resultado = mysqli_query($db, $query);
     
    

    //Mostrar el mensaje condicional
    $message = $_GET['message'] ?? null;

    //Incluir el template de cabecera
    incluirTemplate('header');
     
?>


     <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        

        <div class="errores">
        <?php if(intval($message) === 1) { ?>
            <p class="alerta exito">Registro insertado correctamente</p>

        <?php }; ?>
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

                <?php  while ($propiedad = mysqli_fetch_assoc($resultado))  : ?>

                    <tr>
                        <td><?php echo $propiedad['id']?></td>
                        <td><?php echo $propiedad['titulo']?></td>
                        <td class="centrar">
                            <img class= "imagen-tabla" src="../imagenes/<?php echo $propiedad['imagen']?>" alt="Imagen Propiedad" width="200px" height="160px">
                        </td>
                        <td><?php echo $propiedad['precio']?> €</td>
                        <td class= "acciones">
                            <a class="boton boton-amarillo-block" href="propiedades/actualizar.php">Actualizar</a>
                            <a class="boton boton-rojo-block" href="propiedades/eliminar.php">Eliminar</a>

                        </td>
                    </tr>
                <?php endwhile; ?>
                
            </tbody>
        </table>

        
     </main>

<?php 

    //Cerrar conexión
    mysqli_close($db);
    incluirTemplate('footer');
?>