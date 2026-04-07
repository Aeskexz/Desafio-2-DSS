<?php


require_once __DIR__ . '/../models/Usuario.php';

class AuthController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function login(): void {
        // Si ya está logueado, redirigir
        if (!empty($_SESSION['usuario'])) {
            header('Location: index.php?ruta=productos');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            // Validaciones
            if (empty($username) || empty($password)) {
                $error = "Todos los campos son obligatorios.";
            } else {
                $usuario = $this->usuarioModel->buscarPorUsername($username);

                if ($usuario && $this->usuarioModel->verificarPassword($password, $usuario['password'])) {
                    $_SESSION['usuario'] = $usuario['username'];
                    $_SESSION['usuario_id'] = $usuario['id'];
                    header('Location: index.php?ruta=productos');
                    exit;
                } else {
                    $error = "Usuario o contraseña incorrectos.";
                }
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function logout(): void {
        session_destroy();
        header('Location: index.php');
        exit;
    }
}