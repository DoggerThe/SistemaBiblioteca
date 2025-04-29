<?php
//require_once __DIR__ . '/../app/config/database.php';
//require_once __DIR__ . '/../app/models/Usuario.php';
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/IniSesion.php';

// Detectamos qué acción nos pidieron
$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case 'register':
            (new UserController())->register($_POST);// este esta en UsuarioController
            break;

        case 'login':
            (new LoginController())->login($_POST); // este esta en IniSesion
            break;

        default:
            echo "Acción no reconocida.";
            break;
    }
} else {
    echo "Acceso inválido.";
}
