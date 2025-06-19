<?php
require_once __DIR__ . '/../models/Libro.php';

class LibroController
{
    private $model;
    // Constructor: instancia el modelo Libro
    public function __construct($pdo)
    {
        $this->model = new Libro($pdo);
    }

    /**
     * Permite buscar libros por título o autor.
     * Este método es utilizado comúnmente desde peticiones AJAX (ej. en autocompletado o búsqueda dinámica).
     *
     * $post Debe incluir el índice 'termino', que es la cadena de búsqueda.
     */
    public function obtenerLibros()
    {
        // Establece el tipo de respuesta como JSON
        header('Content-Type: application/json');
        $resultado = $this->model->buscarLibros('');
        echo json_encode($resultado); // Devuelve los resultados como JSON
    }
    public function buscar_libro(array $get)
    {
        
        // Establece el tipo de respuesta como JSON
        header('Content-Type: application/json');
        // Si no se envía un término de búsqueda, se devuelve un array vacío
        if (empty($get['q'])) {
            $this->obtenerLibros(); // Llama al método obtenerLibros para devolver todos los libros
            return;
        }
        $consulta = $get['q']; // Obtiene el término de búsqueda desde el parámetro 'q'
        // Consulta al modelo los libros que coincidan con el término
        $resultado = $this->model->buscarLibros($consulta);
        echo json_encode($resultado); // Devuelve los resultados como JSON
    }
    /**
     * Lista todos los libros actualmente disponibles para préstamo.
     * Se utiliza para mostrar al usuario final solo los libros que pueden ser solicitados.
     */
    public function listarLibrosDisponibles()
    {
        header('Content-Type: application/json');
        $resultados = $this->model->listarLibrosDisponibles();
        echo json_encode($resultados); // Devuelve el listado de libros disponibles en formato JSON
    }
}