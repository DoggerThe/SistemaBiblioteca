<?php
require_once __DIR__ . '/../models/Usuario.php';

class LoginController {
    private $model;

    public function __construct() {
        $this->model = new Usuario();
    }

    public function login(array $post) {
        if (empty($post['usuario']) || empty($post['contrasena'])) {
            echo "Usuario y contraseña requeridos.";
            return;
        }

        $usuario = $this->model->validateUser($post['usuario'], $post['contrasena']);

        if ($usuario) {
            session_start();
            $_SESSION['usuario'] = $usuario;

            // Redirección según el rol_id
            if ($usuario['rol_id'] == 1) {
                header('Location: /SistemaBiblioteca/app/views/usuarios/InicioUser.php');
            } elseif ($usuario['rol_id'] == 2) {
                header('Location: /SistemaBiblioteca/app/views/bibliotecario/InicioBibliotec.php');
            } else {
                echo "Rol no reconocido.";
            }
            exit;
        } else {
            echo "Credenciales incorrectas.";
        }
    }
    public function logout() {
        session_start();
        session_unset();
        session_destroy();

        header('Location: /SistemaBiblioteca/public/index.php');
        exit;
    }
}