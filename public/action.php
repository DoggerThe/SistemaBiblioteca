<?php
//require_once __DIR__ . '/../app/config/database.php';
//require_once __DIR__ . '/../app/models/Usuario.php';
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/IniSesion.php';
require_once __DIR__ . '/../app/controllers/LibroController.php';
require_once __DIR__ . '/../app/controllers/PrestamoController.php';
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
        case 'buscar_activos':
            (new PrestamoController())->buscarActivos($_POST);
            break;
        case 'buscar_inactivos':
            (new PrestamoController())->buscarInactivos($_POST);
            break;
        case 'aceptarPrestamo':
            (new PrestamoController())->aceptarPrestamo($_POST['id']);
            break;
        default:
            echo "Acción no reconocida.";
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($action) {
        case 'listarSolicitudesPendientes':
            (new PrestamoController())->listarPendientes();
            break;
    }
} else {
    echo "Acceso inválido.";
}


