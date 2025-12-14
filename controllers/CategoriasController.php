<?php 

namespace Controllers;

use Model\Categorias;
use MVC\Router;

class CategoriasController {

    public static function index(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }
       
       $categorias = Categorias::all();

        $router->render('admin/categorias/index', [
            'titulo' => 'Categorias',
            'categorias' => $categorias
        ]);

    }

    public static function crear(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }

       $alertas = [];
       $categorias = new Categorias();

       if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!is_admin()) header("location: /login");

            $categorias->sincronizar($_POST);
            $alertas = $categorias->validarCategoria();


            if(empty($alertas)) {
                $resultado  = $categorias->guardar();
                
                if($resultado) {
                    header('Location: /admin/categorias');
                }
            }

       }


        $router->render('admin/categorias/crear', [
            'titulo' => 'Crear Categoria',
            "alertas" => $alertas
        ]);

    }

}