<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

class UserController {
    private $model;
    // Constructor: instancia el modelo Usuario
    public function __construct($pdo) {
        $this->model = new Usuario($pdo);
    }
    /**
     * Procesa el registro de un nuevo usuario.
     * 
     * $post Datos enviados desde el formulario de registro.
     */
    public function register(array $post) {
        // 1. Validar que no estén vacíos
        foreach (['cedula','nombre','apellido','email','direccion','password'] as $field) {
            if (empty($post[$field])) {
                // Almacena mensaje de error y redirige al formulario
                $_SESSION['error'] = "El campo $field es obligatorio.";
                header('Location: /SistemaBiblioteca/app/views/generales/register.php');
                exit;
            }
        }
        // 2. Evitar duplicados
        if ($this->model->existsCedula($post['cedula'])) {
            $_SESSION['error'] = "La cédula ya existe.";
            // Almacena datos antiguos para repoblar el formulario
            $_SESSION['old'] = [
                'cedula' => $post['cedula'],
                'nombre' => $post['nombre'],
                'apellido' => $post['apellido'],
                'email' => $post['email'],
                'direccion' => $post['direccion'],
            ];
            header('Location: /SistemaBiblioteca/app/views/generales/register.php');
            exit;
        }
        // 3. Intentar crear
        if ($this->model->create($post)) {
            $_SESSION['success'] = "Usuario registrado exitosamente.";
            header('Location: /SistemaBiblioteca/app/views/generales/login.php');
            exit;
        } else {
            $_SESSION['error'] = "Error al registrar.";
            header('Location: /SistemaBiblioteca/app/views/generales/register.php');
            exit;
        }
    }
    /**
     * Muestra el perfil del usuario en formato JSON.
     * 
     * $usuario_id ID del usuario a consultar.
     */
    public function verPerfil($usuario_id) {
        $usuario = $this->model->obtenerUsuarioPorId($usuario_id['usuario_id']);
        if ($usuario) {
            echo json_encode($usuario);
        } else {
            echo json_encode(['error' => 'Usuario no encontrado.']);
        }
    }
    /**
     * Cambia la contraseña de un usuario.
     * 
     * $data Arreglo con 'usuario_id', 'antigua' y 'nueva' contraseñas.
     */
    public function cambiarPassword() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'),true);
        // Verifica si la contraseña actual es correcta
        $verificada = $this->model->verificarPasswordActual($data['usuario_id'], $data['antigua']);
    
        if (!$verificada) {
            echo json_encode(['success' => false, 'message' => 'Contraseña actual incorrecta.']);
            return;
        }
    
        // Si es correcta, genera el hash de la nueva y actualiza
        $nuevaHash = password_hash($data['nueva'], PASSWORD_BCRYPT);
        $result = $this->model->actualizarPassword($data['usuario_id'], $nuevaHash);
    
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la contraseña.']);
        }
    }
}