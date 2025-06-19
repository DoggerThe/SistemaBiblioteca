<?php
require_once __DIR__ . '/../models/Usuario.php';

class LoginController
{
    private $model;
    // Constructor: instancia el modelo Usuario
    public function __construct($pdo)
    {
        $this->model = New Usuario($pdo);
    }
    /**
     * Maneja el proceso de inicio de sesión.
     * Valida que se reciban las credenciales, las compara contra la base de datos
     * y gestiona la sesión del usuario según su rol.
     *
     * $post Arreglo que contiene 'usuario' y 'contrasena' enviados por POST.
     */
    public function login(array $post)
    {
        // Define la respuesta como tipo JSON para el cliente
        header('Content-Type: application/json');
        // Validación básica: verificar si se proporcionaron las credenciales
        if (empty($post['usuario']) || empty($post['contrasena'])) {
            echo json_encode(['success' => false, 'message' => 'Usuario y contraseña requeridos.']);
            return;
        }
        // Validar usuario con el modelo
        $usuario = $this->model->validateUser($post['usuario'], $post['contrasena']);
        // Si las credenciales son válidas, iniciar sesión
        if ($usuario) {
            // Inicia sesión si no está ya iniciada
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            // Guardar datos del usuario en la sesión
            $_SESSION['usuario'] = $usuario;
            // Redirigir según el rol
            if ($usuario['rol_id'] == 1) { // Usuario común
                echo json_encode(['success' => true, 'redirect' => '/SistemaBiblioteca/app/views/usuarios/InicioUser.php']);
            } elseif ($usuario['rol_id'] == 2) { // Bibliotecario
                echo json_encode(['success' => true, 'redirect' => '/SistemaBiblioteca/app/views/bibliotecario/InicioBibliotec.php']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Rol no reconocido.']);// Rol no reconocido
            }
        } else {
            // Si las credenciales no son válidas
            echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas.']);
        }
    }
    /**
     * Cierra la sesión del usuario actual y redirige a la página de inicio.
     * Se usa típicamente en el botón de "Cerrar sesión".
     */
    public function logout()
    {
        session_start();
        session_unset(); // Limpia todas las variables de sesión
        session_destroy(); // Destruye la sesión por completo
        // Redireccionar al index público
        header('Location: /SistemaBiblioteca/app/views/generales/lobby.php');
        exit;
    }
}
