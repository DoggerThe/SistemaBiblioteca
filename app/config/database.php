<?php
class Database{
    private $host = 'localhost';
    private $db_name = 'biblioteca_mvc';
    private $username = 'root';
    private $password = 'root';
    public $conn;

    public function connect(){
        $this->conn = null;
        try{
            $this -> conn =  new PDO ("mysql:host = {$this->host};dbname={$this->db_name};charset=utf8mb4", $this -> username, $this -> password);
            $this ->conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "conexion exitante.";
        }catch (PDOException $exception){
            echo "error de conexion: ". $exception -> getMessage();
        }
        return $this->conn;
    }
}