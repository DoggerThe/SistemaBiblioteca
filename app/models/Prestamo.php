<?php
require_once __DIR__ . '/../config/database.php';

class Prestamo
{
    private $db;
    // Constructor: crea la conexión a la base de datos
    public function __construct($pdo)
    {
        $this->db = $pdo;
    }
    public function obtenerListaPrestamos($estado){
        $conn = $this->db;
        $stmt = $conn->prepare("
            SELECT p.id AS id_prestamo, u.cedula AS cedula_usuario, l.titulo AS titulo_libro,
                   p.fecha_solicitud, p.fecha_inicio, p.fecha_fin, e.nombre AS estado
            FROM prestamos p
            JOIN usuarios u ON p.usuario_id = u.id
            JOIN libros l ON p.libro_id = l.id
            JOIN estados_prestamo e ON p.estado_id = e.id
            WHERE p.estado_id = ?
            ORDER BY p.id DESC
            LIMIT 10
        ");
        $stmt->execute([$estado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Buscar préstamos activos filtrando por cédula del usuario
    public function buscarPrestamosActivos($termino = '')
    {
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
    // Buscar préstamos inactivos (devoluciones), también filtrando por cédula
    public function buscarPrestamosInactivos($termino = '')
    {
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
    // Lista todas las solicitudes de préstamo que están pendientes (estado_id = 3)
    public function listarSolicitudesPendientes()
    {
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
    // Aceptar una solicitud de préstamo si hay libros disponibles
    public function aceptarPrestamo($idPrestamo)
    {
        $conn = $this->db;

        // Paso 1: Obtener el ID del libro relacionado al préstamo
        $stmt = $conn->prepare("SELECT libro_id FROM prestamos WHERE id = ?");
        $stmt->execute([$idPrestamo]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$resultado) {
            return ['success' => false, 'mensaje' => 'Préstamo no encontrado.'];
        }

        $libro_id = $resultado['libro_id'];

        // Paso 2: Verificar disponibilidad del libro
        $stmt = $conn->prepare("SELECT cantidad FROM libros WHERE id = ?");
        $stmt->execute([$libro_id]);
        $libro = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$libro || $libro['cantidad'] <= 0) {
            return ['success' => false, 'mensaje' => 'No hay ejemplares disponibles del libro.'];
        }

        // Paso 3: Cambiar el estado del préstamo a "Activo" (estado_id = 1)
        $stmt = $conn->prepare("UPDATE prestamos SET estado_id = 1 WHERE id = ?");
        $stmt->execute([$idPrestamo]);

        // Paso 4: Reducir la cantidad disponible del libro en 1
        $stmt = $conn->prepare("UPDATE libros SET cantidad = cantidad - 1 WHERE id = ?");
        $stmt->execute([$libro_id]);

        return ['success' => true];
    }
    // Crear una nueva solicitud de préstamo (estado pendiente = 3)
    public function crearSolicitud($id_libro, $id_usuario, $fecha_solicitud, $fecha_inicio, $fecha_fin)
    {
        $conn = $this->db;

        $sql = "INSERT INTO prestamos (libro_id, usuario_id, fecha_solicitud, fecha_inicio, fecha_fin, estado_id) 
                VALUES (?, ?, ?, ?, ?, 3)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([$id_libro, $id_usuario, $fecha_solicitud, $fecha_inicio, $fecha_fin]);
    }
    // Lista los libros actualmente prestados a un usuario específico
    public function listarLibrosPrestados($usuario_id, $tipo)
    {
        $conn = $this->db;
        $stmt = $conn->prepare("SELECT p.id AS id_prestamo, l.titulo AS titulo_libro, p.libro_id, p.id, p.fecha_solicitud, p.fecha_inicio, p.fecha_fin
                                FROM prestamos p
                                JOIN libros l ON p.libro_id = l.id
                                WHERE p.usuario_id = :id AND p.estado_id = :estado
                                ORDER BY p.fecha_inicio DESC");
        $stmt->bindParam(':id', $usuario_id);
        $stmt->bindParam(':estado', $tipo);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function cancelarSolicitudLibro($datos):bool{
        try{
            $conn = $this->db;
            $sql = "UPDATE prestamos SET estado_id = 4
                    WHERE usuario_id = :usuario_id AND id = :idPrestamo ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usuario_id', $datos['idUser']);
            $stmt->bindParam(':idPrestamo', $datos['NumPrestamo']);
            return $stmt->execute();
        }catch(error){
            return false;
        }
    }
}