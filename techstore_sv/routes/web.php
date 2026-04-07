<?php
// routes/web.php

session_start();

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/ProductoController.php';

$ruta = $_GET['ruta'] ?? 'login';

$auth     = new AuthController();
$producto = new ProductoController();

switch ($ruta) {
    case 'login':
        $auth->login();
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'productos':
        $producto->index();
        break;
    case 'productos.crear':
        $producto->crear();
        break;
    case 'productos.editar':
        $producto->editar();
        break;
    case 'productos.eliminar':
        $producto->eliminar();
        break;
    default:
        header('Location: index.php');
        exit;
}