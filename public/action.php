<?php
// Se incluyen los controladores necesarios para manejar las acciones relacionadas con usuarios, sesiones, libros y préstamos
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/IniSesion.php';
require_once __DIR__ . '/../app/controllers/LibroController.php';
require_once __DIR__ . '/../app/controllers/PrestamoController.php';

// Se obtiene la acción enviada por el método POST o GET, si existe
$action = $_POST['action'] ?? $_GET['action'] ?? '';

// Si la solicitud es de tipo POST, se procesan las diferentes acciones disponibles
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($action) {
        case 'register':
            // Llama al método register del controlador de usuarios para registrar un nuevo usuario
            (new UserController())->register($_POST); // este esta en UsuarioController
            break;
        case 'login':
            // Llama al método login del controlador de inicio de sesión para autenticar al usuario
            (new LoginController())->login($_POST);
            break;
        case 'buscar':
            // Busca libros en el sistema según parámetros enviados
            (new LibroController())->buscar_libro($_POST);
            break;
        case 'buscar_activos':
            // Lista los préstamos activos del usuario o administrador
            (new PrestamoController())->buscarActivos($_POST);
            break;
        case 'buscar_inactivos':
            // Lista los préstamos finalizados o inactivos
            (new PrestamoController())->buscarInactivos($_POST);
            break;
        case 'aceptarPrestamo':
            // Acepta una solicitud de préstamo por su ID
            (new PrestamoController())->aceptarPrestamo($_POST['id']);
            break;
        case 'solicitarLibro':
            // Crea una nueva solicitud de préstamo de un libro
            (new PrestamoController())->crearSolicitud($_POST);
            break;
        case 'listarLibrosPrestaUsu':
            // Lista los libros actualmente prestados a un usuario específico
            $input = json_decode(file_get_contents("php://input"), true);
            $_POST = array_merge($_POST, $input);
            (new PrestamoController())->listarLibrosUsuario($_POST['usuario_id']);
            break;
        case 'verPerfilUsuario':
            // Muestra el perfil de un usuario específico
            $input = json_decode(file_get_contents("php://input"), true);
            $_POST = array_merge($_POST, $input);
            (new UserController())->verPerfil($_POST['usuario_id']);
            break;
        case 'cambiarPassword':
            // Cambia la contraseña de un usuario
            $input = json_decode(file_get_contents("php://input"), true);
            $_POST = array_merge($_POST, $input);
            (new UserController())->cambiarPassword($_POST);
            break;
        default:
            // Acción no reconocida: devuelve un mensaje de error
            echo "Acción no reconocida.";
            break;
    }
    // Si la solicitud es de tipo GET, se procesan las acciones correspondientes
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($action) {
        case 'listarSolicitudesPendientes':
            // Lista las solicitudes de préstamo pendientes de aprobación
            (new PrestamoController())->listarPendientes();
            break;
        case 'listarLibrosDisponibles':
            // Lista todos los libros disponibles para préstamo
            (new LibroController())->listarLibrosDisponibles();
            break;
        case 'logout':
            // Cierra la sesión del usuario
            (new LoginController())->logout(); // Crearás este método
            break;
    }
    // Si no es ni POST ni GET, se considera un acceso inválido
} else {
    echo "Acceso inválido.";
}