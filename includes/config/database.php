<?php 

require __DIR__ . '/../../vendor/autoload.php';

function conectarDB() : mysqli{


    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();
    $db = mysqli_connect( 
        $_SERVER["DB_HOST"], 
        $_SERVER["DB_USER"], 
        $_SERVER["DB_PASSWORD"], 
        $_SERVER["DB_SCHEME"]
    );

    echo '<pre>'; 
    var_dump($_ENV); 
    echo '</pre>'; 
     

    if (!$db) {
        echo "Error: No se pudo conectar a MySQL.";
        echo "error de depuración: " . mysqli_connect_errno();
        echo "error de depuración: " . mysqli_connect_error();
        exit;
    }
     
    return $db;
}