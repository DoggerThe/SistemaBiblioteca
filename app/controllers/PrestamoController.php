<?php
require_once __DIR__ . '/../models/Prestamo.php';

class PrestamoController {
    private $model;

    public function __construct() {
        $this->model = new Prestamo();
    }
    public function buscarActivos(array $post) {
        $termino = $post['termino'] ?? '';
        $resultados = $this->model->buscarPrestamosActivos($termino);
        echo json_encode($resultados);
    }
    
    public function buscarInactivos(array $post) {
        $termino = $post['termino'] ?? '';
        $resultados = $this->model->buscarPrestamosInactivos($termino);
        echo json_encode($resultados);
    }
}