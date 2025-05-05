<?php
class database {
    private $host   = 'localhost';
    private $dbName = 'biblioteca_mvc';
    private $user   = 'root';
    private $pass   = 'root';
    private $pdo;

    // Método que devuelve la conexión PDO
    public function connect() {
        if ($this->pdo === null) {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";
            try {
                $this->pdo = new PDO($dsn, $this->user, $this->pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Aquí podrías redirigir a un error 500
                die("Error de conexión a BD.");
            }
        }
        return $this->pdo;
    }
}