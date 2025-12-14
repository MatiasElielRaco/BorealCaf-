<?php

namespace Model;

class Productos extends ActiveRecord {
    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'descripcion', 'categoria_id', 'precio', "imagen", 'dispnible'];

    public $id;
    public $nombre;
    public $descripcion;
    public $categoria_id;
    public $precio;
    public $imagen;
    public $disponible;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->categoria_id = $args['categoria_id'] ?? "";
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->disponible = $args['disponible'] ?? 1;
    }

    // Validar Productos
    public function validarProducto() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre del Producto es Obligatorio';
        }
        if(!$this->descripcion) {
            self::$alertas['error'][] = 'Coloca una Descripcion Válida';
        }
        if(!$this->precio) {
            self::$alertas['error'][] = 'Coloca un Precio Válido';
        }
        if(!$this->categoria_id) {
            self::$alertas['error'][] = 'Coloca una Categoria Válida';
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'Coloca una Imágen Válida';
        }
        if(!$this->disponible) {
            self::$alertas['error'][] = 'Coloca una Disponibilidad Válida';
        }
        return self::$alertas;
    }
}