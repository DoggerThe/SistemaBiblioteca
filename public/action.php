<?php
//require_once __DIR__ . '/../app/config/database.php';
//require_once __DIR__ . '/../app/models/Usuario.php';
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/IniSesion.php';
require_once __DIR__ . '/../app/controllers/LibroController.php';

// Detectamos qué acción nos pidieron
//$action = $_GET['action'] ?? '';
$action = $_POST['action'] ?? $_GET['action'] ?? '';

//$libroController = new LibroController(); // Instancia del controlador de libros

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case 'register':
            (new UserController())->register($_POST);// este esta en UsuarioController
            break;

        case 'login':
            (new LoginController())->login($_POST); // este esta en IniSesion
            break;
        case 'buscar':
            (new LibroController())->buscar_libro($_POST);
            break;
/*
case 'listar_libros':
    $libroController->listarTodos();
    break;

case 'listar_libros_activos':
    $libroController->listarActivos();
    break;

case 'listar_libros_inactivos':
    $libroController->listarInactivos();
    break;

case 'listar_libros_disponibles':
    $libroController->listarDisponibles();
    break;
*/

        default:
            echo "Acción no reconocida.";
            break;
    }
} else {
    echo "Acceso inválido.";
}


