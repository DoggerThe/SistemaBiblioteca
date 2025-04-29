<?php
//require_once __DIR__ . '/../app/config/database.php';
//require_once __DIR__ . '/../app/models/Usuario.php';
require_once __DIR__ . '/../app/controllers/UsuarioController.php';

// Detectamos qué acción nos pidieron
$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case 'register':
            (new UserController())->register($_POST);
            break;

        case 'login':
            (new UserController())->login($_POST);
            break;

        default:
            echo "Acción no reconocida.";
            break;
    }
} else {
    echo "Acceso inválido.";
}