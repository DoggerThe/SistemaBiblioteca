<?php
require_once __DIR__ . '/../config/database.php';

class Usuario {
    // Instancia de la base de datos
    private $db;
    // Constructor que crea una conexión con la base de datos
    public function __construct() {
        // Creamos instancia de Database y pedimos la conexión
        $this->db = (new database())->connect();
    }

    /**
     * Inserta un nuevo usuario en la base de datos
     * 
     * array $data Datos del usuario a insertar (cedula, nombre, apellido, etc.)
     * Devuelve true si la inserción fue exitosa, false en caso contrario
     */
    public function create(array $data): bool {
        // SQL para insertar un nuevo usuario
        $sql = "INSERT INTO usuarios (cedula,nombre,apellido,email,direccion,password,rol_id)
                VALUES (:cedula,:nombre,:apellido,:email,:direccion,:password,1)";
                // Preparamos la sentencia SQL
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

    /**
     * Verifica si la cédula ya existe en la base de datos
     * 
     * $cedula Número de cédula del usuario
     * Devuelve true si la cédula ya existe, false en caso contrario
     */
    public function existsCedula(string $cedula): bool {
        // SQL para contar cuántos usuarios tienen la misma cédula
        $sql = "SELECT COUNT(*) FROM usuarios WHERE cedula = :cedula";
        // Preparamos y ejecutamos la sentencia
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':cedula' => $cedula]);
        // Retornamos si el conteo es mayor que 0 (es decir, existe la cédula)
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Valida las credenciales de un usuario utilizando su cédula y contraseña.
     * $usuario Cédula del usuario.
     * $contrasena Contraseña en texto plano.
     * Retorna el array de datos del usuario si las credenciales son válidas, false si no.
     */
    public function validateUser($usuario, $contrasena) {
        $sql = "SELECT * FROM usuarios WHERE cedula = :cedula";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':cedula', $usuario); 
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve los datos del usuario
        // Verifica si existe el usuario y si la contraseña ingresada coincide con la almacenada (hash)
        if ($usuario && password_verify($contrasena, $usuario['password'])) {
            return $usuario;
        }
        return false; // Credenciales incorrectas
    }
    /**
     * Obtiene información básica de un usuario por su ID.
     * $id ID del usuario.
     * Datos del usuario o null si no existe.
     */
    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT nombre, apellido, cedula, email, direccion FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /**
     * Verifica si una contraseña ingresada coincide con la almacenada (por ID de usuario).
     * $id ID del usuario.
     * $passwordPlano Contraseña ingresada en texto plano.
     * true si coincide, false si no.
     */
    public function verificarPassword($id, $passwordPlano) {
        $sql = "SELECT password FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && password_verify($passwordPlano, $usuario['password'])) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Verifica si la contraseña actual ingresada es correcta (uso redundante del método anterior).
     * $usuario_id ID del usuario.
     * $passwordIngresada Contraseña actual ingresada.
     * true si coincide, false si no.
     */
    public function verificarPasswordActual($usuario_id, $passwordIngresada) {
        $sql = "SELECT password FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($usuario && password_verify($passwordIngresada, $usuario['password'])) {
            return true;
        }
    
        return false;
    }
    /**
     * Actualiza la contraseña de un usuario con una nueva ya encriptada.
     * $id ID del usuario.
     * $nuevaHash Contraseña nuevsa (ya en hash).
     * true si se actualizó correctamente.
     */
    public function actualizarPassword($id, $nuevaHash) {
        $sql = "UPDATE usuarios SET password = :password WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':password', $nuevaHash);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}