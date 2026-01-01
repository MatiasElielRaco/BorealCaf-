<?php 

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Productos;
use Model\Categorias;
USE Intervention\Image\ImageManagerStatic as image;

class ProductosController {

    public static function index(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }

        // Página actual (por GET), por defecto 1
        $pagina_actual = $_GET['page'] ?? 1;
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        // Filtros desde GET
        $categoria = $_GET['categoria'] ?? null;
        $categoria = $categoria !== null ? filter_var($categoria, FILTER_VALIDATE_INT) : null;
        $disponible = $_GET['disponible'] ?? null;
        $disponible = $disponible !== null ? filter_var($disponible, FILTER_VALIDATE_INT) : null;
        $search = $_GET['search'] ?? null;
        $search = $search !== null ? trim(filter_var($search)) : null;

        // Preparar query params para mantener filtros en los enlaces de paginación
        $filtros = [];
        if($categoria) $filtros['categoria'] = $categoria;
        if($disponible !== null && ($disponible === 0 || $disponible === 1)) $filtros['disponible'] = $disponible;
        if($search !== null && $search !== '') $filtros['search'] = $search;
        $query_params = http_build_query($filtros);

        // Validar página
        if(!$pagina_actual || $pagina_actual < 1) {
            $redirect = '/admin/productos?' . ($query_params ? $query_params . '&page=1' : 'page=1');
            header("Location: {$redirect}");
            exit;
        }

        $registro_por_pagina = 5;

        // Calcular total con posibles filtros
        if(!empty($filtros)) {
            $condiciones = [];
            if(isset($filtros['categoria'])) {
                $condiciones[] = "categoria_id = " . intval($filtros['categoria']);
            }
            if(isset($filtros['disponible'])) {
                $condiciones[] = "disponible = " . intval($filtros['disponible']);
            }
            if(isset($filtros['search'])) {
                $safe = addslashes($filtros['search']);
                $condiciones[] = "nombre LIKE '%{$safe}%'";
            }
            $condicion = implode(' AND ', $condiciones);
            $total = Productos::total($condicion);
        } else {
            $total = Productos::total();
            $condicion = '';
        }

        $paginacion = new Paginacion($pagina_actual, $registro_por_pagina, $total, $query_params);

        if($paginacion->total_paginas() > 0 && $paginacion->total_paginas() < $pagina_actual) {
            $redirect = '/admin/productos?' . ($query_params ? $query_params . '&page=1' : 'page=1');
            header("Location: {$redirect}");
            exit;
        }

        // Obtener productos con o sin filtros
        if($condicion) {
            $productos = Productos::paginarWhereRaw($registro_por_pagina, $paginacion->offset(), $condicion);
        } else {
            $productos = Productos::paginar($registro_por_pagina, $paginacion->offset());
        }

        $categorias = Categorias::all();

        $router->render('admin/productos/index', [
            'titulo' => 'Productos',
            'paginacion' => $paginacion->paginacion(),
            'productos' => $productos,
            "categorias" => $categorias,
            "filtros" => $filtros
        ]);

    }

    public static function crear(Router $router) {
       if(!is_admin()) {
        header('Location: /');
       }

        $alertas = [];
        $productos = new Productos();
        $categorias = Categorias::all();

       if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!empty($_FILES["imagen"]["tmp_name"])){

                $carpetaImagenes = '../public/img/productos/';

                if(!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes, 0755, true);
                }

                $imagen_png = image::make($_FILES["imagen"]["tmp_name"])->fit(800,800)->encode('png', 80);
                $imagen_webp = image::make($_FILES["imagen"]["tmp_name"])->fit(800,800)->encode('webp', 80);

                $nombreImagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombreImagen;
            }

            $productos->sincronizar($_POST);
            $alertas = $productos->validarProducto();

            if(empty($alertas)) {

                if(!empty($_FILES["imagen"]["tmp_name"])){
                    $imagen_png->save($carpetaImagenes . $nombreImagen . ".png");
                    $imagen_webp->save($carpetaImagenes . $nombreImagen . ".webp");
                }
                $resultado = $productos->guardar();

                if($resultado) header('Location: /admin/productos');

            }
       }
       
        $router->render('admin/productos/crear', [
            'titulo' => 'Crear Producto',
            "categorias" => $categorias,
            'alertas' => $alertas,
            "producto" => $productos
        ]);

    }


    public static function editar(Router $router) {
       if(!is_admin()) header('Location: /');

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) header('Location: /admin/productos');
        $productos = Productos::find($id);
        $categorias = Categorias::all();
        $alertas = [];

        $productos->imagen_actual = $productos->imagen;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(!empty($_FILES["imagen"]["tmp_name"])){

                $carpetaImagenes = '../public/img/productos/';

                if(!is_dir($carpetaImagenes)) {
                    mkdir($carpetaImagenes, 0755, true);
                }

                $imagen_png = image::make($_FILES["imagen"]["tmp_name"])->fit(800,800)->encode('png', 80);
                $imagen_webp = image::make($_FILES["imagen"]["tmp_name"])->fit(800,800)->encode('webp', 80);

                $nombreImagen = md5(uniqid(rand(), true));

                $_POST['imagen'] = $nombreImagen;
            } else {
                $_POST['imagen'] = $productos->imagen;
            }

            $productos->sincronizar($_POST);
            $alertas = $productos->validarProducto();

            // debuguear($_POST);

            if(empty($alertas)) {

                if(!empty($_FILES["imagen"]["tmp_name"])){
                    $imagen_png->save($carpetaImagenes . $nombreImagen . ".png");
                    $imagen_webp->save($carpetaImagenes . $nombreImagen . ".webp");
                }
                $resultado = $productos->guardar();

                if($resultado) header('Location: /admin/productos');

            }
        }
       
        $router->render('admin/productos/editar', [
            'titulo' => 'Editar Producto',
            "categorias" => $categorias,
            'alertas' => $alertas,
            "producto" => $productos
        ]);

    }


    public static function eliminar(Router $router) {
       if(!is_admin()) header('Location: /');
       
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id) {
                $producto = Productos::find($id);
                $resultado = $producto->eliminar();

                if($resultado) {
                    header('Location: /admin/productos');
                }
            }
        }

    }

}