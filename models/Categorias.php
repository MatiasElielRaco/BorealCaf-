<?php

namespace Model;

class Categorias extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
    }

    // Validar el Login de Categoria
    public function validarCategoria() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'Coloca un Nombre a la Categoria';
        }
        return self::$alertas;

    }
}