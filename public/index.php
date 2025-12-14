<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\PaginasController;
use Controllers\PedidosController;
use Controllers\ReportesController;
use Controllers\DashboardController;
use Controllers\ProductosController;
use Controllers\CategoriasController;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

// Área Pública
$router->get('/', [PaginasController::class, 'index']);

// Páginas Dashboard
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

// Páginas de Productos
$router->get('/admin/productos', [ProductosController::class, 'index']);    
$router->get('/admin/productos/crear', [ProductosController::class, 'crear']);    
$router->post('/admin/productos/crear', [ProductosController::class, 'crear']);    

// Páginas de Pedidos
$router->get('/admin/pedidos', [PedidosController::class, 'index']);

// Páginas de Categorías
$router->get('/admin/categorias', [CategoriasController::class, 'index']);
$router->get('/admin/categorias/crear', [CategoriasController::class, 'crear']);
$router->post('/admin/categorias/crear', [CategoriasController::class, 'crear']);

// Páginas de Reportes
$router->get('/admin/reportes', [ReportesController::class, 'index']);

// Pagina de error
$router->get('/404', [PaginasController::class, 'error']);

$router->comprobarRutas();