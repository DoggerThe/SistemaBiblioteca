<?php
require_once __DIR__ . '/../models/Usuario.php';

class UserController {
    private $model;

    public function __construct() {
        // Creamos instancia del modelo
        $this->model = new Usuario();
    }

    public function register(array $post) {
        // 1. Validar que no estén vacíos
        foreach (['cedula','nombre','apellido','email','password'] as $field) {
            if (empty($post[$field])) {
                echo "El campo $field es obligatorio."; return;
            }
        }
        // 2. Evitar duplicados
        if ($this->model->existsCedula($post['cedula'])) {
            echo "La cédula ya existe."; return;
        }
        // 3. Intentar crear
        if ($this->model->create($post)) {
            echo "Usuario registrado.";
        } else {
            echo "Error al registrar.";
        }
    }
}

// Punto de entrada mínimo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_GET['action'] ?? '') === 'register') {
    (new UserController())->register($_POST);
}
