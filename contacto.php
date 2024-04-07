<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>


     <main class="contenedor seccion">
        <h1>Contacto</h1>
        <picture> 
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jepg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto" width="100%" height="100%">
        </picture> 

        <h2>Rellene el formulario de contacto</h2>

        <form  class="formulario">
            <fieldset>
                <legend>Información Personal</legend>


                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" placeholder="Tu nombre" required> 

                <label for="email">E-mail:</label>
                <input type="email" id="email"  placeholder="Tu E-mail">

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" placeholder="Tu teléfono">

                <label for="mensaje">Tu mensaje:</label>
                <textarea id="mensaje"></textarea>

            </fieldset>

            <fieldset>
                <legend>Información sobre la Propiedad</legend>

                <label for="opciones">Venta o compra:</label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto:</label>
                <input type="number" id="presupuesto" placeholder="Tu precio o presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado:</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">E-Mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email">
                </div>

                <p>Si eligió teléfono, escoga la fecha y la hora </p>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha">

                <label for="hora">Hora:</label>
                <input type="time" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
        

     </main>

<?php 
    incluirTemplate('footer');
?>