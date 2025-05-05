<?php
require_once __DIR__ . '/../config/database.php';

class Prestamo {
    private $db;

    public function __construct() {
        $this->db = (new database())->connect();
    }
    //check
    public function buscarPrestamosActivos($termino = '') {
        $conn = $this->db;
        $like = '%' . $termino . '%';
        $stmt = $conn->prepare("
            SELECT p.id AS id_prestamo, u.cedula AS cedula_usuario, l.titulo AS titulo_libro,
                   p.fecha_solicitud, p.fecha_inicio, p.fecha_fin, e.nombre AS estado
            FROM prestamos p
            JOIN usuarios u ON p.usuario_id = u.id
            JOIN libros l ON p.libro_id = l.id
            JOIN estados_prestamo e ON p.estado_id = e.id
            WHERE p.estado_id = 1 AND u.cedula LIKE ?
            ORDER BY p.id DESC
            LIMIT 10
        ");
        $stmt->execute([$like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //check
    public function buscarPrestamosInactivos($termino = '') {
        $conn = $this->db;
        $like = '%' . $termino . '%';
        $stmt = $conn->prepare("
            SELECT p.id AS id_prestamo, u.cedula AS cedula_usuario, l.titulo AS titulo_libro,
                   p.fecha_solicitud, p.fecha_inicio, p.fecha_fin, e.nombre AS estado
            FROM prestamos p
            JOIN usuarios u ON p.usuario_id = u.id
            JOIN libros l ON p.libro_id = l.id
            JOIN estados_prestamo e ON p.estado_id = e.id
            WHERE p.estado_id = 2 AND u.cedula LIKE ?
            ORDER BY p.id DESC
            LIMIT 10
        ");
        $stmt->execute([$like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //check
    public function listarSolicitudesPendientes() {
        $conn = $this->db;
        $stmt = $conn->prepare("
            SELECT p.id AS id_prestamo, u.cedula AS cedula_usuario, l.titulo AS titulo_libro,
               p.fecha_solicitud, p.fecha_inicio, p.fecha_fin, e.nombre AS estado
            FROM prestamos p
            JOIN usuarios u ON p.usuario_id = u.id
            JOIN libros l ON p.libro_id = l.id
            JOIN estados_prestamo e ON p.estado_id = e.id
            WHERE p.estado_id = 3
            ORDER BY p.fecha_inicio ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //a

    public function aceptarPrestamo($idPrestamo) {
        $conn = $this->db;
    
        // Paso 1: Obtener libro_id asociado al préstamo
        $stmt = $conn->prepare("SELECT libro_id FROM prestamos WHERE id = ?");
        $stmt->execute([$idPrestamo]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$resultado) {
            return ['success' => false, 'mensaje' => 'Préstamo no encontrado.'];
        }
    
        $libro_id = $resultado['libro_id'];
    
        // Paso 2: Verificar si hay ejemplares disponibles
        $stmt = $conn->prepare("SELECT cantidad FROM libros WHERE id = ?");
        $stmt->execute([$libro_id]);
        $libro = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$libro || $libro['cantidad'] <= 0) {
            return ['success' => false, 'mensaje' => 'No hay ejemplares disponibles del libro.'];
        }
    
        // Paso 3: Actualizar estado del préstamo a ACTIVO (1)
        $stmt = $conn->prepare("UPDATE prestamos SET estado_id = 1 WHERE id = ?");
        $stmt->execute([$idPrestamo]);
    
        // Paso 4: Disminuir en 1 la cantidad del libro
        $stmt = $conn->prepare("UPDATE libros SET cantidad = cantidad - 1 WHERE id = ?");
        $stmt->execute([$libro_id]);
    
        return ['success' => true];
    }

    public function crearSolicitud($id_libro, $id_usuario, $fecha_solicitud, $fecha_inicio, $fecha_fin) {
        $conn = $this->db;
    
        $sql = "INSERT INTO prestamos (libro_id, usuario_id, fecha_solicitud, fecha_inicio, fecha_fin, estado_id) 
                VALUES (?, ?, ?, ?, ?, 3)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id_libro, $id_usuario, $fecha_solicitud, $fecha_inicio, $fecha_fin]);
    }

    public function listarLibrosPrestados($usuario_id) {
        $conn = $this->db;
        $stmt = $conn->prepare("
            SELECT p.id AS id_prestamo, l.titulo AS titulo_libro, p.libro_id, p.fecha_solicitud, p.fecha_inicio, p.fecha_fin
            FROM prestamos p
            JOIN libros l ON p.libro_id = l.id
            WHERE p.usuario_id = ? AND p.estado_id = 1
            ORDER BY p.fecha_inicio DESC
        ");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}