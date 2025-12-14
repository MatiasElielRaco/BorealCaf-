<?php 

namespace Controllers;

use MVC\Router;

class ReportesController {

    public static function index(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }
        $router->render('admin/reportes/index', [
            'titulo' => 'Reportes'
        ]);

    }

}