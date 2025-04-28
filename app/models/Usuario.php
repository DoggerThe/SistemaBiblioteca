<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    private $db;

    public function __construct() {
        // Creamos instancia de Database y pedimos la conexión
        $this->db = (new database())->connect();
    }

    // Inserta un usuario nuevo
    public function create(array $data): bool {
        $sql = "INSERT INTO usuarios (cedula,nombre,apellido,email,password,rol_id)
                VALUES (:cedula,:nombre,:apellido,:email,:password,1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':cedula'   => $data['cedula'],
            ':nombre'   => $data['nombre'],
            ':apellido' => $data['apellido'],
            ':email'    => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);
    }

    // Verifica si la cédula ya existe
    public function existsCedula(string $cedula): bool {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE cedula = :cedula";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':cedula' => $cedula]);
        return $stmt->fetchColumn() > 0;
    }
}