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
        $sql = "INSERT INTO usuarios (cedula,nombre,apellido,email,direccion,password,rol_id)
                VALUES (:cedula,:nombre,:apellido,:email,:direccion,:password,1)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':cedula'   => $data['cedula'],
            ':nombre'   => $data['nombre'],
            ':apellido' => $data['apellido'],
            ':email'    => $data['email'],
            ':direccion'=> $data['direccion'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);
    }

    // Verifica si la cédula ya existe
    public function existsCedula(string $cedula): bool {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE cedula = :cedula";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':cedula' => $cedula]);
        return $stmt->fetchColumn() > 0;
        echo $stmt->fetchColumn() > 0;
    }

    //reemplazar usuario por cedula
    public function validateUser($usuario, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE cedula = :cedula AND password = :password";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':cedula', $usuario); 
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el usuario completo
        if ($usuario && password_verify($contrasena, $usuario['password'])) {
            return $usuario; // Devuelve el usuario completo
        }
        return false; // Credenciales incorrectas
    }
}