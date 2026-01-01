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

            $nombre_categoria = Categorias::where('nombre', $_POST['nombre']);
            if($nombre_categoria) {
                Categorias::setAlerta('error', 'La categoria ya existe');
            }

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


    public static function editar(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }

       $alertas = [];
       $id = $_GET['id'];
       $id = filter_var($id, FILTER_VALIDATE_INT);

       if(!$id) header('Location: /admin/categorias');

       $categoria = Categorias::find($id);
       
       if($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(!is_admin()) header("location: /login");
    
                $categoria->sincronizar($_POST);
                $alertas = $categoria->validarCategoria();

                if(empty($alertas)) {
                    $resultado  = $categoria->guardar();
                    
                    if($resultado)header('Location: /admin/categorias');

                }
                
        }

        $router->render('admin/categorias/editar', [
            'titulo' => 'Editar Categoria',
            "alertas" => $alertas,
            'categoria' => $categoria
        ]);
    }


    public static function eliminar() {
     
         if($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(!is_admin()) header("location: /login");
    
            
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
    
                if($id) {
                    $categoria = Categorias::find($id);
                    $resultado = $categoria->eliminar();

                    if($resultado) echo json_encode(["resultado" => "ok"]);
                }
         }

    }

}