

<?php 

    require 'app.php';
    

function incluirTemplate (string $nombre, bool $inicio = false){

    include TEMPLATES_URL."/".$nombre.".php";
}

function estaAutorizado() : bool{
    session_start(); 

    if(!$_SESSION['login']){
        return false;
    }

    return true;
}