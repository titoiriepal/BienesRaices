<?php 

namespace App;

class Propiedad extends ActiveRecord{

   protected static $tabla = 'propiedades';
   protected static $columnas_DB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedores_id'];

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

   public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
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

}

