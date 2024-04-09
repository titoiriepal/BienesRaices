<?php 
     
namespace App;

class Vendedor extends ActiveRecord{


    protected static $tabla = 'vendedores';
    protected static $columnas_DB = ['id','nombre','apellidos','telefono'];

    public $id;
    public $nombre;
    public $apellidos;
    public $telefono;

    public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        
    }

    public function validar(){
        if(!$this->nombre){
            self::$errores[] = 'Añade un nombre  para el vendedor.';
        }else if( strlen($this->nombre) > 45){
            self::$errores[] = 'El nombre no debe superar los 45 caracteres';
        }

        if(!$this->apellidos){
            self::$errores[] = 'Debes añadir, al menos, un apellido para el vendedor';
        }else if( strlen($this->apellidos) > 45){
            self::$errores[] = 'Los apellidos no pueden superar los 45 caracteres';
        }

        if(!$this->telefono){
            self::$errores[] = 'Debes añadir un número de teléfono';
        }else if(!preg_match("/^[+0-9]{1}[0-9]{8,14}$/",$this->telefono)){
            self::$errores[] = "El número de teléfono introducido no es válido";
            self::$errores[] = "Debe contener 9 caracteres numéricos como mínimo y 15 como máximo. Se permite el prefijo + para indicar el pais ";
        }

        return self::$errores;

        }
}