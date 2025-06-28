<?php
require_once __DIR__ . '/../models/Prestamo.php';

class PrestamoController
{
    private $model;
    // Constructor: instancia el modelo Prestamo
    public function __construct($pdo)
    {
        $this->model = new Prestamo($pdo);
    }
    /**
     * Busca préstamos activos que coincidan con un término dado.
     * Utilizado para filtrar resultados en tiempo real.
     * 
     * $post Arreglo con la clave 'termino' (opcional).
     */
    public function buscarActivos(array $post)
    {
        $termino = $post['q'] ?? '';
        $resultados = $this->model->buscarPrestamosActivos($termino);
        echo json_encode($resultados);
    }
    /**
     * Busca préstamos inactivos que coincidan con un término dado.
     * Generalmente, se refiere a préstamos finalizados o cancelados.
     * 
     * $post Arreglo con la clave 'termino' (opcional).
     */
    public function buscarInactivos(array $post)
    {
        $termino = $post['q'] ?? '';
        $resultados = $this->model->buscarPrestamosInactivos($termino);
        echo json_encode($resultados);
    }
    /**
     * Lista todas las solicitudes de préstamo pendientes de aprobación.
     * Útil para personal administrativo o bibliotecario.
     */
    public function listarPendientes()
    {
        $resultados = $this->model->listarSolicitudesPendientes();
        echo json_encode($resultados);
    }
    /**
     * Acepta una solicitud de préstamo pendiente.
     * Cambia su estado a "aceptado" y actualiza disponibilidad del libro.
     * 
     * $id ID de la solicitud de préstamo.
     */
    public function aceptarPrestamo($dato)
    {
        $id = $dato['id'] ?? null;
        $resultado = $this->model->aceptarPrestamo($id);
        echo json_encode($resultado);
    }
    /**
     * Crea una nueva solicitud de préstamo.
     * Requiere datos como usuario, libro y fechas involucradas.
     * 
     * $post Arreglo con claves: id_libro, id_usuario, fecha_solicitud, fecha_inicio, fecha_fin.
     */
    public function crearSolicitud(array $post)
    {
        $id_libro = $post['id_libro'] ?? null;
        $id_usuario = $post['id_usuario'] ?? null;
        $fecha_solicitud = $post['fecha_solicitud'] ?? null;
        $fecha_inicio = $post['fecha_inicio'] ?? null;
        $fecha_fin = $post['fecha_fin'] ?? null;
        // Validación de campos obligatorios
        if (!$id_libro || !$id_usuario || !$fecha_solicitud || !$fecha_inicio || !$fecha_fin) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            return;
        }

        $resultado = $this->model->crearSolicitud($id_libro, $id_usuario, $fecha_solicitud, $fecha_inicio, $fecha_fin);

        echo json_encode(['success' => $resultado]);
    }
    /**
     * Lista todos los libros prestados actualmente a un usuario específico.
     * 
     * $usuario_id ID del usuario.
     */
    public function listarLibrosUsuario($post)
    {
        $resultados = $this->model->listarLibrosPrestados($post['usuario_id'], $post['tipo']);
        echo json_encode($resultados);
    }

    public function obtenerActivos()
    {
        $resultados = $this->model->obtenerListaPrestamos("1");
        echo json_encode($resultados);
    }
    public function obtenerInactivos()
    {
        $resultados = $this->model->obtenerListaPrestamos("2");
        echo json_encode($resultados);
    }
    public function cancelarSolicitudLibro($post){
        $resultados = $this->model->cancelarSolicitudLibro($post);
        echo json_encode($resultados);
    }
}