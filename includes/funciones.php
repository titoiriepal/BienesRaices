

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