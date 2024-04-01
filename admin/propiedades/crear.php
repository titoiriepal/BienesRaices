<?php 
    require '../../includes/funciones.php';
    incluirTemplate('header');
?>


     <main class="contenedor seccion">
        <h1>Crer Propiedad</h1>

        <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

        <form class="formulario">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" placeholder="Título de la propiedad" >

                <label for="precio">Precio:</label>
                <input type="number" id="precio" placeholder="Precio de la propiedad" >

                <label for="imagen">Imágen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png, image/webp">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion"> </textarea>

                <fieldset>
                    <legend>Información de la propiedad</legend>

                    <label for="habitaciones">Número de Habitaciones:</label>
                    <input type="number" id="habitaciones" placeholder="Número de habitaciones" min="1" max="9">

                    <label for="wc">Número de baños:</label>
                    <input type="number" id="wc" placeholder="Número de baños" min="1" max="9">

                    <label for="estacionamiento">Número de plazas de parking:</label>
                    <input type="number" id="estacionamiento" placeholder="Número de plazas de parking" min="1" max="9">
                </fieldset>

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedores_id" id="vendedores_id">

                    <option disabled selected>Selecciona un vendedor</option>
                    <option value="1">Antonio López</option>
                    <option value="2">María Perez</option>
                </select>
                
            

            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">


        </form>
     </main>

<?php 
    incluirTemplate('footer');
?>