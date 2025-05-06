<?php
session_start();
require_once __DIR__ . '/../models/Usuario.php';

class UserController {
    private $model;

    public function __construct() {
        // Creamos instancia del modelo
        $this->model = new Usuario();
    }

    public function register(array $post) {
        // 1. Validar que no estén vacíos
        foreach (['cedula','nombre','apellido','email','direccion','password'] as $field) {
            if (empty($post[$field])) {
                $_SESSION['error'] = "El campo $field es obligatorio.";
                header('Location: /SistemaBiblioteca/app/views/usuarios/registerUser.php');
                exit;
                //echo "El campo $field es obligatorio."; return;
            }
        }
        // 2. Evitar duplicados
        if ($this->model->existsCedula($post['cedula'])) {
            //echo "La cédula ya existe."; return;
            $_SESSION['error'] = "La cédula ya existe.";
            //guardado de todo para mantenerlo en caso de que exista la cedula.
            $_SESSION['old'] = [
                'cedula' => $post['cedula'],
                'nombre' => $post['nombre'],
                'apellido' => $post['apellido'],
                'email' => $post['email'],
                'direccion' => $post['direccion'],
            ];
            header('Location: /SistemaBiblioteca/app/views/usuarios/registerUser.php');
            exit;
        }
        // 3. Intentar crear
        if ($this->model->create($post)) {
            $_SESSION['success'] = "Usuario registrado exitosamente.";
            header('Location: /SistemaBiblioteca/app/views/usuarios/login.php');
            exit;
        } else {
            $_SESSION['error'] = "Error al registrar.";
            header('Location: /SistemaBiblioteca/app/views/usuarios/registerUser.php');
            exit;
            //echo "Error al registrar.";
        }
    }

    public function verPerfil($usuario_id) {
        $usuario = $this->model->obtenerUsuarioPorId($usuario_id);
        if ($usuario) {
            echo json_encode($usuario);
        } else {
            echo json_encode(['error' => 'Usuario no encontrado.']);
        }
    }
    
    public function cambiarPassword($data) {
        // Validar contraseña actual directamente en el modelo
        $verificada = $this->model->verificarPasswordActual($data['usuario_id'], $data['antigua']);
    
        if (!$verificada) {
            echo json_encode(['success' => false, 'message' => 'Contraseña actual incorrecta.']);
            return;
        }
    
        // Si está verificada, procede al cambio
        $nuevaHash = password_hash($data['nueva'], PASSWORD_BCRYPT);
        $result = $this->model->actualizarPassword($data['usuario_id'], $nuevaHash);
    
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la contraseña.']);
        }
    }
}