<?php
require_once __DIR__ . '/../config/database.php';

class Libro {
    // Atributo privado que almacenará la conexión a la base de datos
    private $db;
    // Constructor: inicializa la conexión a la base de datos usando una clase externa 'database'
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Busca libros cuyo título, autor o género coincida parcialmente con el término proporcionado.
     *
     * $termino El término de búsqueda ingresado por el usuario.
     * Un arreglo asociativo con los libros que coincidan con el término.
     */
    public function buscarLibros(string $termino): array {
        if ($termino === '') {
            $sql = "SELECT titulo, autor, cantidad FROM libros";
            // Preparación y ejecución de la consulta con parámetros seguros (para evitar inyecciones SQL)
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        }
        // Si el término de búsqueda está vacío, se retorna todos los libros
        else {
            $sql = "SELECT titulo, autor, cantidad FROM libros 
                WHERE titulo LIKE :titulo OR autor LIKE :autor OR genero LIKE :genero";
            // Preparación y ejecución de la consulta con parámetros seguros (para evitar inyecciones SQL)
            $stmt = $this->db->prepare($sql); // Se usa el comodín % para coincidencia parcial
            $likeTermino = '%' . $termino . '%';
            $stmt->bindValue(':titulo', $likeTermino);
            $stmt->bindValue(':autor', $likeTermino);
            $stmt->bindValue(':genero', $likeTermino);
            $stmt->execute();
            // Se devuelve un arreglo con los resultados
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Lista todos los libros disponibles (con cantidad mayor a 0).
     *
     * Un arreglo asociativo con los libros disponibles ordenados por título.
     */
    public function listarLibrosDisponibles(){
        $conn = $this->db;
        $stmt = $conn->prepare("
            SELECT l.id, l.titulo, l.autor, l.genero, l.cantidad
            FROM libros l
            WHERE l.cantidad > 0
            ORDER BY l.titulo ASC
        ");
        $stmt->execute();
        // Devuelve los libros disponibles en orden alfabético por título
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}