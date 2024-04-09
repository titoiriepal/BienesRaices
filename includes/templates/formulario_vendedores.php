<fieldset>
        <legend>Información Vendedor</legend>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Nombre del Vendedor" value="<?php echo s($vendedor->nombre)?>" >

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos del Vendedor" value="<?php echo s($vendedor->apellidos)?>">

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" placeholder="Teléfono del vendedor" value="<?php echo s($vendedor->telefono)?>">
    
</fieldset>