<?php 
     


namespace App;

class ActiveRecord{

//Base de datos
    protected static $db;
    protected static $columnas_DB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];

       //Definir la conexión a la Bd

    public static function setDB($database) {
        self::$db = $database;
    }

    //Guardar registros en la BD

    public function guardar(){
        if(!is_null($this->id)){
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
        $query= "INSERT INTO " . static::$tabla  . " ( ";
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
        $query= "UPDATE " . static::$tabla . " SET ";
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

        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;
        
    }

    //**OBTENER UN DETERMINADO NÚMERO DE REGISTROS  */

    public static function get(int $limite){
        $query ="SELECT * FROM " . static::$tabla . " LIMIT ". $limite;

        $resultado = self::consultarSQL($query);

        return $resultado;

    }

    //**BUSCA UN REGISTRO EN LA BD */
    public static function find($id){

        $query = "SELECT * FROM " . static::$tabla ." WHERE  id='$id'";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado); //Devuelve el primer elemento de  un array o false si está vacío.
        
    }


    public static function consultarSQL($query){ //Consulta la base de datos y devuelve un array con todos los resultados que haya generado la consulta
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()){//Por cada registro que nos devuelve la consulta creamos un objeto de esta misma clase
            $array [] = static::crearObjeto($registro); //Creamos cada objeto uno por uno
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if ( property_exists($objeto, $key) ){  //Comprueba que el valor del nombre del atributo (p.e 'titulo' exista en las propiedades del objeto que le pasas como primer parámetro)
                $objeto->$key = $value;
            }
        }

        return $objeto;
    
    }

    //**ELIMINAR REGISTROS */

    public function eliminar(){

        $query = "DELETE FROM " . static::$tabla ." Where id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        return $resultado;
    }


    //Identifica y une los atributos de la BD
    public function atributos(){
        $atributos = [];
        foreach(static::$columnas_DB as $columna){
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

        return static::$errores;
    }

    public function validar(){
        
        static::$errores = [];
        return static::$errores;

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