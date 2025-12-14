<?php 

namespace Controllers;

use MVC\Router;

class PedidosController {

    public static function index(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }
        $router->render('admin/pedidos/index', [
            'titulo' => 'Pedidos'
        ]);

    }

}