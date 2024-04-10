<fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo s($propiedad->titulo)?>" >

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" min="1" value="<?php echo s($propiedad->precio)?>">

                <label for="imagen">Imágen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png, image/webp" name="imagen">

                <?php if ($propiedad->imagen  != "" && file_exists(CARPETA_IMAGENES . $propiedad->imagen)) { ?>
                    <img src="/imagenes/<?php echo s($propiedad->imagen);?>" alt="" height="100px" width="150px" class="imagen-actualizar">
                <?php } ?>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo s($propiedad->descripcion)?></textarea>

                <fieldset>
                    <legend>Información de la propiedad</legend>

                    <label for="habitaciones">Número de Habitaciones:</label>
                    <input 
                        type="number" 
                        id="habitaciones" 
                        name="habitaciones" 
                        placeholder="Número de habitaciones" 
                        min="1" 
                        max="9" 
                        value="<?php echo s($propiedad->habitaciones)?>">

                    <label for="wc">Número de baños:</label>
                    <input type="number" 
                        id="wc" 
                        name="wc" 
                        placeholder="Número de baños" 
                        min="1" 
                        max="9" 
                        value="<?php echo s($propiedad->wc)?>">

                    <label for="estacionamiento">Número de plazas de parking:</label>
                    <input type="number" 
                        id="estacionamiento" 
                        name="estacionamiento" 
                        placeholder="Número de plazas de parking" 
                        min="0" 
                        max="9" 
                        value="<?php echo s($propiedad->estacionamiento)?>">
                </fieldset>

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedores_id" id="vendedores_id">

                    <option value="" disabled selected>--Selecciona un vendedor--</option>

                    <?php  foreach ($vendedores as $vendedor)  : ?>
                        <option 
                            value="<?php echo s($vendedor->id)?>" 
                            <?php echo s($propiedad->vendedores_id) == $vendedor->id ? 'selected' : '';?>>
                            <?php echo s($vendedor->nombre) . " " . s($vendedor->apellidos); ?>
                        </option> <!--Traemos el valor del id para el valor del option. Luego lo comparamos con el id anterior para ver si estaba seleccionado anteriormete. Finalmente cargamos el nombre y el apellido en la lista del option para poder seleccionarlo-->
                    <?php endforeach; ?>
                    <!-- <option value="1" <?php //echo $vendedores_id == 1 ? 'selected' : ''?>>Antonio López</option>
                    <option value="2" <?php //echo $vendedores_id == 2 ? 'selected': ''?>>María Perez</option> -->
                </select>
                
            

            </fieldset>