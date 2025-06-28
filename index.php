<?php
    // Se incluyen los controladores necesarios para manejar las acciones relacionadas con usuarios, sesiones, libros y préstamos
    require __DIR__ . '/app/config/database.php';
    $pdo = database::getConexion();

    require_once __DIR__ . '/app/controllers/UsuarioController.php';
    require_once __DIR__ . '/app/controllers/IniSesion.php'; //loginCOntroller
    require_once __DIR__ . '/app/controllers/LibroController.php';
    require_once __DIR__ . '/app/controllers/PrestamoController.php';

    if (!$pdo) {
        http_response_code(500);
        include 'app/views/errors/500.php';
        exit();
    }

    $action = $_POST['action'] ?? $_GET['action'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        switch ($action){
            case 'registrar':
                (new UserController($pdo))->register($_POST); //CHECK Llama al método register del controlador de usuarios para registrar un nuevo usuario
                break;
            case 'login':
                (new LoginController($pdo))->login($_POST); //CHECK
                break;
            case 'aceptarPrestamo':
                // Acepta una solicitud de préstamo por su ID
                (new PrestamoController($pdo))->aceptarPrestamo($_POST);
                break;
            case 'solicitarLibro':
                // Crea una nueva solicitud de préstamo de un libro
                (new PrestamoController($pdo))->crearSolicitud($_POST);
                break;
            case 'verPerfilUsuario':
                (new UserController($pdo))->verPerfil($_POST);
                break;
            case 'cambiarPassword':
                (new UserController($pdo))->cambiarPassword();
                break;
            case 'listarLibrosPrestaUsu':
                // Lista los libros actualmente prestados a un usuario específico
                (new PrestamoController($pdo))->listarLibrosUsuario($_POST);
                break;
            case 'registrarLibros':
                (new LibroController($pdo))->registrarLibros($_POST);
                break;
            case 'listaBibliotecarios':
                (new UserController($pdo))->listaBibliotecarios();
                break;
            case 'busquedaBibliotecario':
                (new UserController($pdo))->busquedaBibliotecario($_POST);
                break;
            case 'cambiarDatosLibroAdmin':
                (new LibroController($pdo))->cambiarDatosLibroAdmin($_POST);
                break;
            default:
                echo "Acción no reconocida en post: $action";
                http_response_code(404);
                include 'app/views/errors/404.php';
                exit();
        }
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){
        switch ($action){
            case 'buscar':
                // Busca libros en el sistema según parámetros enviados
                (new LibroController($pdo))->buscar_libro($_GET);//check
                break;
            case 'obtenerLibros':
                // Busca libros en el sistema según parámetros enviados
                (new LibroController($pdo))->obtenerLibros();//check
                break;
            case 'obtenerActivos':
                // Obtiene los préstamos activos del usuario o administrador
                (new PrestamoController($pdo))->obtenerActivos();//check
                break;
            case 'obtenerInactivos':
                // Obtiene los préstamos activos del usuario o administrador
                (new PrestamoController($pdo))->obtenerInactivos(); //check
                break;
            case 'buscarActivos':
                // Lista los préstamos activos del usuario o administrador
                (new PrestamoController($pdo))->buscarActivos($_GET);
                break;
            case 'buscarInactivos':
                // Lista los préstamos finalizados o inactivos
                (new PrestamoController($pdo))->buscarInactivos($_GET);
                break;
            case 'listarSolicitudesPendientes':
                // Lista las solicitudes de préstamo pendientes de aprobación
                (new PrestamoController($pdo))->listarPendientes();
                break;
            case 'listarLibrosDisponibles':
                // Lista todos los libros disponibles para préstamo
                (new LibroController($pdo))->listarLibrosDisponibles($_GET);
                break;
            case 'logout': //check
                // Cierra la sesión del usuario
                (new LoginController($pdo))->logout($_GET);
                break;
            case 'listarLibrosAdmin':
                (new LibroController($pdo))->listarLibrosAdmin();
                break;
            case 'buscarLibrosAdmin':
                (new LibroController($pdo))->buscarLibrosAdmin($_GET);
                break;
            case 'rellenoExistBibli':
                (new LibroController($pdo))->rellenoExistBibli($_GET);
                break;
            default: //check
                if (!isset($_SESSION['usuario'])){
                    require 'app/views/generales/lobby.php';
                    exit();
                }
                http_response_code(404);
                include 'app/views/errors/404.php';
                exit();
        }
    }
    else {
        echo "Método no soportado.";
        http_response_code(404);
        include 'app/views/errors/404.php';
        exit();
    }

?>