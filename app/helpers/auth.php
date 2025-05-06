<?php
session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario'])) {
    header('Location: /SistemaBiblioteca/app/views/usuarios/login.php');
    exit;
}

// Función para validar el rol del usuario
function requireRole($rol_id_requerido) {
    if (!isset($_SESSION['usuario']['rol_id']) || $_SESSION['usuario']['rol_id'] != $rol_id_requerido) {
        exit;
    }
}
?>