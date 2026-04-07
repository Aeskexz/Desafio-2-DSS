<?php
// app/models/Usuario.php

require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Database::getInstancia()->getConexion();
    }

    // Buscar usuario por username
    public function buscarPorUsername(string $username): array|false {
        $stmt = $this->db->prepare(
            "SELECT id, username, password FROM usuarios WHERE username = ? LIMIT 1"
        );
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    // Verificar contraseña - Versión que soporta MD5
    public function verificarPassword(string $inputPassword, string $hashGuardado): bool {
        // Verificar si es MD5 (32 caracteres hexadecimales)
        if (preg_match('/^[a-f0-9]{32}$/', $hashGuardado)) {
            return md5($inputPassword) === $hashGuardado;
        }
        
        // Verificar con bcrypt (el método normal)
        return password_verify($inputPassword, $hashGuardado);
    }
}