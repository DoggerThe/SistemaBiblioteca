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

    public function registrarLibros($post){
        header('Content-Type: application/json');
        $res = $this->model->revisarISBN($post);
        if($res){
            $result = $this->model->actalizarLibros($post);
            echo json_encode($result);
        }else{
            $result = $this->model->registrarLibros($post);
            echo json_encode($result);
        }
    }
    public function listarLibrosAdmin(){
        header ('Content-Type: application/json');
        $result = $this->model->listarLibrosAdmin();
        echo json_encode($result);
    }
    public function buscarLibrosAdmin(array $get){
        header('Content-Type: application/json');
        if (empty($get['q'])){
            $this->listarLibrosAdmin(); // Llama al método obtenerLibros para devolver todos los libros
            return;
        }
        $consulta = $get['q']; // Obtiene el término de búsqueda desde el parámetro 'q'
        // Consulta al modelo los libros que coincidan con el término
        $resultado = $this->model->buscarLibrosAdmin($consulta);
        echo json_encode($resultado);
    }
    public function cambiarDatosLibroAdmin($post){
        header ('Content-Type: application/json');
        $result = $this->model->cambiarDatosLibroAdmin($post);
        echo json_encode($result);
    }
    public function rellenoExistBibli($get){
        header ('Content-Type: application/json');
        if (empty($get['q'])){
            echo json_encode(false);
            return;
        }
        $consulta = $get['q'];
        $resultado = $this->model->rellenoExistBibli($consulta);
        echo json_encode($resultado);
    }
}