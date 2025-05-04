<?php
require_once __DIR__ . '/../config/database.php';

class Libro {
    private $db;

    public function __construct() {
        $this->db = (new database())->connect();
    }

    // Buscar libros por título o autor
    public function buscarLibros(string $termino): array {
        $sql = "SELECT titulo, autor, cantidad FROM libros 
                WHERE titulo LIKE :termino OR autor LIKE :termino OR genero LIKE :termino";
        
        $stmt = $this->db->prepare($sql);
        $likeTermino = '%' . $termino . '%';
        $stmt->bindValue(':termino', $likeTermino);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Otros métodos que podrías querer implementar más adelante:
    // - public function obtenerTodos(): array {}
    // - public function crear(array $datos): bool {}
    // - public function eliminar(int $id): bool {}
    // - public function actualizar(array $datos): bool {}
}