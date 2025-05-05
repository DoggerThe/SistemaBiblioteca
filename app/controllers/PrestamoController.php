<?php
require_once __DIR__ . '/../models/Prestamo.php';

class PrestamoController {
    private $model;

    public function __construct() {
        $this->model = new Prestamo();
    }
    //Check
    public function buscarActivos(array $post) {
        $termino = $post['termino'] ?? '';
        $resultados = $this->model->buscarPrestamosActivos($termino);
        echo json_encode($resultados);
    }
    //Check
    public function buscarInactivos(array $post) {
        $termino = $post['termino'] ?? '';
        $resultados = $this->model->buscarPrestamosInactivos($termino);
        echo json_encode($resultados);
    }
    //agregar un nuevo metodo para listar los prestamos pendientes check
    public function listarPendientes() {
        $resultados = $this->model->listarSolicitudesPendientes();
        echo json_encode($resultados);
    }


    public function aceptarPrestamo($id) {
        $resultado = $this->model->aceptarPrestamo($id);
        echo json_encode($resultado);
    }

    public function crearSolicitud(array $post) {
        $id_libro = $post['id_libro'] ?? null;
        $id_usuario = $post['id_usuario'] ?? null;
        $fecha_solicitud = $post['fecha_solicitud'] ?? null;
        $fecha_inicio = $post['fecha_inicio'] ?? null;
        $fecha_fin = $post['fecha_fin'] ?? null;
    
        if (!$id_libro || !$id_usuario || !$fecha_solicitud || !$fecha_inicio || !$fecha_fin) {
            echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
            return;
        }
    
        $resultado = $this->model->crearSolicitud($id_libro, $id_usuario, $fecha_solicitud, $fecha_inicio, $fecha_fin);
    
        echo json_encode(['success' => $resultado]);
    }

    public function listarLibrosUsuario($usuario_id) {
        $resultados = $this->model->listarLibrosPrestados($usuario_id);
        echo json_encode($resultados);
    }
}