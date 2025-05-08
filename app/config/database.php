<?php
//Clase para la conexión a la base de datos
class database {
    private $host   = 'localhost';
    private $dbName = 'biblioteca_mvc'; //Nombre de la base de datos
    private $user   = 'root'; //Usuario de la base de datos
    private $pass   = 'root'; //Depende de que se pusiera en la BD al crearla
    private $pdo;
    // Método que devuelve la conexión PDO
    public function connect() {
        if ($this->pdo === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";
            try {
                $this->pdo = new PDO($dsn, $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Aquí se pone un mensaje de error al usuario en caso de entrar.
                echo json_encode([
                    'success' => false,
                    'message' => 'Error de conexión a la base de datos intentelo mas tarde.'
                ]);
                exit;
            }
        }
        return $this->pdo;
    }
}