
<?php 
    
    
    require 'funciones.php';
    require 'config/database.php';
    require __DIR__ . '/../vendor/autoload.php';

    use App\ActiveRecord;

    //Conectarnos a la base de datos
    $db = conectarDB();

    ActiveRecord::setDB($db);

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();

    