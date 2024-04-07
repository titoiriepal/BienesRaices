<?php 

require 'includes/app.php';

$errores = [];
$email = '';
//Autenticar el usuario
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $email = $_POST['email'];
    // $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    //Validación

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errores[]= 'Introduce un email valido, por favor';
    }

    if(!$password){
        $errores[]= 'Introduce un password, por favor';
    }

    if(empty($errores)){
        
        $db = conectarDB();

        $email= mysqli_real_escape_string($db,$email);
        $query = "SELECT  * FROM usuarios WHERE email='".$email."'";
        $resultado =  mysqli_query($db, $query);

        if(!$resultado->num_rows){
            $errores []= 'Usuario o contraseña incorrectos';
        }else{
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc( $resultado );
             
            $password = mysqli_real_escape_string($db,$password);
            $auth = password_verify($password, $usuario['password']);
            if ($auth){
                session_start();
                //Llenar el arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header( "Location:/admin/index.php" );
                 
                 
            }else{
                $errores []= 'Usuario o contraseña incorrectos';
            }

        }
         
    }
     
    
     
}

//Incluir header
    incluirTemplate('header');

?>


     <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <div class="errores">
            <?php foreach($errores as $error) :?>

            <p class="alerta error"><?php echo $error;?></p>

            <?php endforeach; ?>
        </div>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Datos de Conexión</legend>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Tu E-mail" value="<?php echo $email ?>">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Tu Password"> 

            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
     </main>

<?php 
    incluirTemplate('footer');
?>