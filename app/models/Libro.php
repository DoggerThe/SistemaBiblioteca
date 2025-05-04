<?php
require_once __DIR__ . '/../config/database.php';

class Libro {
    private $db;

    public function __construct() {
        $this->db = (new database())->connect();
    }

    // Buscar libros por título o autor
    public function buscarPorTituloOAutor(string $termino): array {
        $sql = "SELECT * FROM libros 
                WHERE titulo LIKE :termino OR autor LIKE :termino";
        $stmt = $this->db->prepare($sql);
        $termino = "%$termino%";
        $stmt->bindParam(':termino', $termino, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Otros métodos que podrías querer implementar más adelante:
    // - public function obtenerTodos(): array {}
    // - public function crear(array $datos): bool {}
    // - public function eliminar(int $id): bool {}
    // - public function actualizar(array $datos): bool {}
}