<?php
    require_once 'DatabaseInterface.php';

    class DatabaseConexion implements DatabaseInterface{
        private $host;
        private $db_name;
        private $username;
        private $password;
        private $conn;

        public function __construct($host, $db_name, $username, $password){
            $this -> host = $host;
            $this -> db_name = $db_name;
            $this -> username = $username;
            $this -> password = $password;
        }
        public function connect(){
            $this -> conn = null;
            try{
                $dsn = "mysql:host={$this -> host}; dbname={$this ->db_name};charset=utf8mb4"; // se crea el Data Source Name con las instrucciones dadas por el constructor.
                $this -> conn = new PDO($dsn, $this -> username, $this->password); //PDO es PHP Data Objects la libreria para conectarme a la BD con php
                $this -> conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // todo erros es lanzado como exception.
                $this -> conn -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //Pasa obtener los datos como arreglos, posiblemente desaparezca.
                return true;
            }catch (PDOException $e){
                throw new PDOException ("Error de conexion: ". $e->getMessage());
            }
        }
        public function getConnection(){
            if ($this -> conn === null){
                $this -> connect();
            }
            return $this -> conn;
        }
    }
?>