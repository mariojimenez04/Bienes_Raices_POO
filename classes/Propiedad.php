<?php

    namespace App;

    class Propiedad {
        //Base de datos
        protected static $db;
        protected static $database_columns = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
        //Errores/validacion
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
        public $vendedorId;

        //Definir la conexion a la base de datos
        public static function setDB( $database ) {
            self::$db = $database;
        }

        public function __construct( $args = [] )
        {
            $this->id = $args['id'] ?? null;
            $this->titulo = $args['titulo'] ?? '';
            $this->precio = $args['precio'] ?? '';
            $this->imagen = $args['imagen'] ?? '';
            $this->descripcion = $args['descripcion'] ?? '';
            $this->habitaciones = $args['habitaciones'] ?? '';
            $this->wc = $args['wc'] ?? '';
            $this->estacionamiento = $args['estacionamiento'] ?? '';
            $this->creado = date('Y-m-d H:i:s');
            $this->vendedorId = $args['vendedorId'] ?? 1;
        }

        public function save_record() {
            //Sanitizar los datos
            $atributos = $this->sanitize_data();

            //insertar en la base de datos
            $query = "INSERT INTO propiedades ( ";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES ('"; 
            $query .= join("', '", array_values($atributos)); 
            $query .= " ') ";
            
            $resultado = self::$db->query($query);

            if ($resultado) {
                header('Location: /admin');
            }
        }

        //Identificar y unir los atributos de la BD
        public function attributes() {
            $attributes = [];

            foreach ( self::$database_columns as $column) {
                if($column === 'id') continue;
                $attributes[$column] = $this->$column;
            }
            return $attributes;
        }

        public function sanitize_data() {
            $attributes = $this->attributes();

            $sanitize = [];

            foreach ( $attributes as $key => $value) {
                $sanitize[$key] = self::$db->escape_string( $value );
            }

            return $sanitize;
        }

        //Subir archivos
        public function setImage($imagen) {
            //Asignar al atributo de imagen el nombre de la imagen
            if($imagen) {
                $this->imagen = $imagen;
            }
        }

        //Validacion
        public static function getErrores() {
            return self::$errores;
        }

        public function validate() {
            if (!$this->titulo) {
                self::$errores[] = 'Debes añadir un Titulo';
            }
            if (!$this->precio) {
                self::$errores[] = 'El Precio es Obligatorio';
            }
            if (strlen($this->descripcion) < 50) {
                self::$errores[] = 'La Descripción es obligatoria y debe tener al menos 50 caracteres';
            }
            if (!$this->habitaciones) {
                self::$errores[] = 'La Cantidad de Habitaciones es obligatoria';
            }
            if (!$this->wc) {
                self::$errores[] = 'La cantidad de WC es obligatoria';
            }
            if (!$this->estacionamiento) {
                self::$errores[] = 'La cantidad de lugares de estacionamiento es obligatoria';
            }
            if (!$this->vendedorId) {
                self::$errores[] = 'Elige un vendedor';
            }
        
            if (!$this->imagen) {
                self::$errores[] = 'La imagen es obligatoria';
            }

            return self::$errores;
        }

        public static function all() {
            //Realizar consulta
            $query = "SELECT * FROM propiedades";

            //Obtener resultados
            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        public static function consultarSQL($query) {
            //Consultar la base de datos
            $resultado = self::$db->query($query);

            //Iterar los resultados
            $array = [];
            while ( $registro = $resultado->fetch_assoc() ) {
                # code...
                $array[] = self::crearObjeto($registro);
            }

            //Liberar la memoria
            $resultado->free();

            //Retornar los resultados
            return $array;
        }

        protected static function crearObjeto($registro) {
            $objeto = new self;

            foreach ($registro as $key => $value) {
                # code...
                if( property_exists( $objeto, $key ) ){
                    $objeto->$key = $value;
                }
            }

            return $objeto;
        }
    }