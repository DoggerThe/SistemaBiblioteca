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
}