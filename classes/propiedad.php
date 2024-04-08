<?php 

namespace App;

class Propiedad{

    //Base de datos
    protected static $db;
    protected static $columnas_DB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'];

    //Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

       //Definir la conexión a la Bd

    public static function setDB($database) {
        self::$db = $database;
    }

    public function __construct($args = []) {

        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    //Guardar registros en la BD

    public function guardar(){
        if(!($this->id === '')){
            //Actualizamos
            $resultado = $this->actualizar();

        }else{
            //Creamos
            $resultado = $this->crear();
        }

        return $resultado;
    }

    public function crear(){

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //Insertar en la BD
        $query= "INSERT INTO propiedades ( ";
        $query.= join(', ', array_keys($atributos)); 
        $query .= " ) VALUES ( '";
        $query.= join("', '", array_values($atributos)); 
        $query.= "' )";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    public function actualizar(){

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        //Insertar en la BD
        $query= "UPDATE propiedades SET ";
        foreach ($atributos as $key => $value){
            $query .= $key . "= '" . $value . "', " ;
        }
        $query = substr($query,0,-2);//quitando el ultimo coma y espacio
        $query.=" WHERE id='".self::$db->escape_string($this->id) . "' LIMIT 1;";
        $resultado = self::$db->query($query);

        return $resultado;
        

    }

    //**LISTAR REGISTROS DE LA BASE DE DATOS */

    public static function all(){

        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);

        return $resultado;
        
    }

    //**BUSCA UN REGISTRO EN LA BD */
    public static function find($id){

        $query = "SELECT * FROM propiedades WHERE  id='$id'";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado); //Devuelve el primer elemento de  un array o false si está vacío.
        
    }


    public static function consultarSQL($query){ //Consulta la base de datos y devuelve un array con todos los resultados que haya generado la consulta
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()){//Por cada registro que nos devuelve la consulta creamos un objeto de esta misma clase
            $array [] = self::crearObjeto($registro); //Creamos cada objeto uno por uno
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new self;

        foreach($registro as $key => $value){
            if ( property_exists($objeto, $key) ){  //Comprueba que el valor del nombre del atributo (p.e 'titulo' exista en las propiedades del objeto que le pasas como primer parámetro)
                $objeto->$key = $value;
            }
        }

        return $objeto;
    
    }

    //Identifica y une los atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(self::$columnas_DB as $columna){
            if ($columna === 'id') continue;
            $atributos [$columna] = $this->$columna;
        }
        return $atributos;
    }
    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);

        }

        return $sanitizado;
    }

    //Subida de archivos

    public function setImagen($imagen){
        //Asignamos al atributo imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

 
    //Validación

    public static function getErrores(){

        return self::$errores;
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = 'Debes añadir un título';
        }else if( strlen($this->titulo) > 45){
            self::$errores[] = 'El título no debe superar los 45 caracteres';
        }

        if(!$this->precio){
            self::$errores[] = 'Debes añadir un precio';
        }else if( $this->precio < 1){
            self::$errores[] = 'Introduce un precio mayor que 0';
        }

        if(!$this->descripcion){
            self::$errores[] = 'Debes añadir una descripción';
        }else if( strlen($this->descripcion) < 50){
            self::$errores[] = 'La descripción ha de contener, al menos, 50 caracteres';
        }

        if(!$this->habitaciones){
            self::$errores[] = 'Debes añadir un número de habitaciones';
        }else if( $this->habitaciones < 1){
            self::$errores[] = 'Introduce un número de habitaciones mayor que 0';
        }

        if(!$this->wc){
            self::$errores[] = 'Debes añadir un número de baños';
        }else if( $this->wc < 1){
            self::$errores[] = 'Introduce un número de baños mayor que 0';
        }

        if(!$this->estacionamiento){
            self::$errores[] = 'Debes añadir un número de estacionamientos';
        }else if( $this->estacionamiento < 0){
            self::$errores[] = 'No puedes introducir un número negativo de estacionamientos';
        }

        if(!$this->vendedores_id){
            self::$errores[] = 'Debes elegir un vendedor';
        }

        //Comprobar que existe la imagen 
        if(!$this->imagen){
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;

    }


    //**SINCRONIZAR EL OBJETO EN MEMORIA CON LOS CAMBIOS REALIZADOS POR EL USUARIO */

    public function sincronizar( $args = []) {

            foreach($args as $key => $value){
                if(property_exists($this, $key) && !is_null($value)){
                    $this->$key = $value;
                }
            }
        
    }
}

