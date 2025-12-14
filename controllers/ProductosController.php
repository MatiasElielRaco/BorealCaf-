<?php 

namespace Controllers;

use MVC\Router;

class ProductosController {

    public static function index(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }
        $router->render('admin/productos/index', [
            'titulo' => 'Productos'
        ]);

    }

    public static function crear(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }
        $router->render('admin/productos/crear', [
            'titulo' => 'Crear Producto'
        ]);

    }

}