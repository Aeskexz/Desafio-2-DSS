<?php
// app/controllers/ProductoController.php

require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $productoModel;

    public function __construct() {
        $this->productoModel = new Producto();
    }

    // Proteger rutas: si no hay sesión, redirigir al login
    private function proteger(): void {
        if (empty($_SESSION['usuario'])) {
            header('Location: index.php');
            exit;
        }
    }

    public function index(): void {
        $this->proteger();
        $productos = $this->productoModel->obtenerTodos();
        require_once __DIR__ . '/../views/productos/index.php';
    }

    public function crear(): void {
        $this->proteger();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $precio = floatval($_POST['precio'] ?? 0);
            $stock  = intval($_POST['stock'] ?? 0);

            $errores = [];
            if (empty($nombre))  $errores[] = "El nombre es obligatorio.";
            if ($precio <= 0)    $errores[] = "El precio debe ser mayor a 0.";
            if ($stock < 0)      $errores[] = "El stock no puede ser negativo.";

            if (empty($errores)) {
                $this->productoModel->crear($nombre, $precio, $stock);
                header('Location: index.php?ruta=productos&ok=creado');
                exit;
            }
        }

        require_once __DIR__ . '/../views/productos/crear.php';
    }

    public function editar(): void {
        $this->proteger();
        $id = intval($_GET['id'] ?? 0);
        $producto = $this->productoModel->obtenerPorId($id);

        if (!$producto) {
            header('Location: index.php?ruta=productos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');
            $precio = floatval($_POST['precio'] ?? 0);
            $stock  = intval($_POST['stock'] ?? 0);

            $errores = [];
            if (empty($nombre))  $errores[] = "El nombre es obligatorio.";
            if ($precio <= 0)    $errores[] = "El precio debe ser mayor a 0.";
            if ($stock < 0)      $errores[] = "El stock no puede ser negativo.";

            if (empty($errores)) {
                $this->productoModel->actualizar($id, $nombre, $precio, $stock);
                header('Location: index.php?ruta=productos&ok=editado');
                exit;
            }
        }

        require_once __DIR__ . '/../views/productos/editar.php';
    }

    public function eliminar(): void {
        $this->proteger();
        $id = intval($_GET['id'] ?? 0);

        if ($id > 0) {
            $this->productoModel->eliminar($id);
        }

        header('Location: index.php?ruta=productos&ok=eliminado');
        exit;
    }
}