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
}