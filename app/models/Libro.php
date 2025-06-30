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
    public function registrarLibros($post):bool{
        if((int)$post["rol"] === 3 ){
            $conn = $this->db;
            $sql = "INSERT INTO libros (titulo,autor,isbn,genero,editorial,cantidad)
                    VALUES (:titulo,:autor,:isbn,:genero,:editorial,:cantidad)";
            $stmt = $conn->prepare($sql);
            return $stmt->execute([
                ':titulo' => $post["titulo"] ,
                ':autor' => $post["autor"],
                ':isbn' => $post["isbn"],
                ':genero' => $post["genero"],
                ':editorial' => $post["editorial"],
                ':cantidad' => $post["cantidad"],
            ]);
        }
        return false;
    }
    public function actalizarLibros($post):bool{
        if((int)$post["rol"] === 3 ){
            $conn = $this->db;
            $sql = "UPDATE libros
                    SET cantidad = :cantidad
                    WHERE isbn = :isbn";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':isbn', $post['isbn']);
            $stmt->bindParam(':cantidad', $post['cantidad']);
            return $stmt->execute();
        }
        return false;
    }
    //existencia de ISBN
    public function revisarISBN($post):bool{
        try {
            $conn = $this->db;
            $sql = "SELECT 1 FROM libros WHERE isbn = :isbn LIMIT 1";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':isbn', $post['isbn']);
            $stmt->execute();
            return (bool) $stmt->fetch(); // Convierte explícitamente a bool
        } catch (PDOException $e) {
            error_log("Error en revisarISBN: " . $e->getMessage());
            return false; // Retorna false en caso de error
        }
    }
    public function listarLibrosAdmin(){
        $conn = $this->db;
        $stmt = $conn->prepare("SELECT titulo, autor, isbn, genero, editorial, SUM(cantidad) AS total_cantidad
                                FROM libros
                                GROUP BY titulo, autor, isbn, genero, editorial
                                ORDER BY titulo DESC;");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function buscarLibrosAdmin(string $termino):array{
        $conn = $this->db;
        $sql = "SELECT isbn, titulo, autor, genero, editorial, SUM(cantidad) AS total_cantidad
                FROM libros
                WHERE isbn LIKE :isbn OR titulo LIKE :titulo OR autor LIKE :autor OR genero LIKE :genero OR editorial LIKE :editorial
                GROUP BY isbn, titulo, autor, genero, editorial
                ORDER BY titulo DESC;";
        $stmt = $conn->prepare($sql);
        $likeTermino = '%' . $termino . '%';
        $stmt->bindValue(':titulo', $likeTermino);
        $stmt->bindValue(':autor', $likeTermino);
        $stmt->bindValue(':genero', $likeTermino);
        $stmt->bindValue(':editorial', $likeTermino);
        $stmt->bindValue(':isbn', $likeTermino);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function cambiarDatosLibroAdmin($post):bool{
        $conn = $this->db;
        $sql = "UPDATE libros
                SET titulo=:titulo, autor=:autor, genero=:genero, editorial=:editorial
                WHERE isbn=:isbn";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titulo', $post['titulo']);
        $stmt->bindParam(':autor', $post['autor']);
        $stmt->bindParam(':genero', $post['genero']);
        $stmt->bindParam(':editorial', $post['editorial']);
        $stmt->bindParam(':isbn', $post['isbn']);

        return $stmt->execute();
        
    }
    public function rellenoExistBibli($consulta){
        $conn = $this->db;
        $sql = "SELECT titulo, autor, genero, cantidad, editorial
                FROM libros
                WHERE isbn = :isbn";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':isbn', $consulta);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}