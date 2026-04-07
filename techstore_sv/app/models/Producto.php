<?php


require_once __DIR__ . '/../config/database.php';

class Producto {
    private $db;

    public function __construct() {
        $this->db = Database::getInstancia()->getConexion();
    }

  
    public function obtenerTodos(): array {
        $stmt = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    
    public function obtenerPorId(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    
    public function crear(string $nombre, float $precio, int $stock): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO productos (nombre, precio, stock) VALUES (?, ?, ?)"
        );
        return $stmt->execute([$nombre, $precio, $stock]);
    }

    
    public function actualizar(int $id, string $nombre, float $precio, int $stock): bool {
        $stmt = $this->db->prepare(
            "UPDATE productos SET nombre = ?, precio = ?, stock = ? WHERE id = ?"
        );
        return $stmt->execute([$nombre, $precio, $stock, $id]);
    }

    
    public function eliminar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM productos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}