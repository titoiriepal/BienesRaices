

<?php 

    define('TEMPLATES_URL', __DIR__ . '/templates');
    define('FUNCIONES_URL', __DIR__ . 'funciones.php');
    define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');
    

function incluirTemplate (string $nombre, bool $inicio = false){

    include TEMPLATES_URL."/".$nombre.".php";
}

function estaAutorizado(){
    session_start(); 

    if(!$_SESSION['login']){
        header('location:/');
    }

}

function debuguear($variable) {
    echo '<pre>'; 
    var_dump($variable); 
    echo '</pre>'; 

    exit;

}

//Escapa / sanitiza el HTML

function s (string $cadena) : string{
   return htmlspecialchars($cadena, ENT_QUOTES | ENT_HTML5); //Devuelve la cadena de texto con los caracteres especiales convertidos a lenguaje HTML5 para impedir que se inyecte código en nuestra web
}

//Validar tipo de id para admin/index.html
function validarTipoId($tipo){

    $tipos = ['idVendedor' , 'idPropiedad'];

    return in_array($tipo, $tipos);
}

function mostrarNotificación($codigo) { //Devuelve un mensaje de error y la clase del párrafo según el código que le introducimos
    $mensaje = '';
    $clase= '';
     switch(intval($codigo)) { 
        case 1: 
            $mensaje='Propiedad insertada correctamente';
            $clase='exito';
        break; 
        case 2 :
            $mensaje='No se ha proporcionado un id para la actualización';
            $clase='error';
     break; 
        case 3:
        $mensaje='El id proporcionado para la actualización no corresponde con ningun registro';
            $clase='error';
     break; 
        case 4:
        $mensaje='Propiedad actualizada correctamente';
            $clase='exito';
     break; 
        case 5:
        $mensaje='Propiedad borrada correctamente';
            $clase='exito';
     break;  
        case 6:
        $mensaje='Vendedor borrado correctamente';
            $clase='exito';
     break;
        case 7:
        $mensaje='Vendedor Creado correctamente';
            $clase="exito";
     break;
        case 8:
        $mensaje='Vendedor Actualizado correctamente';
            $clase="exito";
     break;
        default:
        $mensaje='';
        $clase='';
     
     ;}

     return [$mensaje,$clase];
}