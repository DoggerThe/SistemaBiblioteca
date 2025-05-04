<?php
require_once __DIR__ . '/../models/Libro.php';

class LibroController {
    private $model;

    public function __construct() {
        $this->model = new Libro();
    }

    // Buscar libros por título o autor (se usa desde action.php con AJAX)
    public function buscar_libro(array $post) {
        header('Content-Type: application/json');
        if (empty($post['termino'])) {
            echo json_encode([]); // Devuelve un array vacío si no se envió término
            return;
        }

        $resultado = $this->model->buscarLibros($post['termino']);
        echo json_encode($resultado); // Responde con los libros en formato JSON
    }
}
