<?php
//Clase para la conexión a la base de datos
class database {
    private static ?PDO $pdo = null; //Instancia estática de PDO
    private function __construct(){
    }

    // Método que devuelve la conexión PDO
    public static function getConexion(): ?PDO{   
        $host   = 'localhost';
        $dbName = 'biblioteca_mvc'; //Nombre de la base de datos
        $user   = 'root'; //Usuario de la base de datos
        $pass   = 'root'; //Depende de que se pusiera en la BD al crearla
        $charset = 'utf8mb4'; //Codificación de caracteres
        $opciones = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Modo de error
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Modo de obtención por defecto
            PDO::ATTR_EMULATE_PREPARES   => false, // Desactivar emulación de sentencias preparadas
        ];

        try{
            if (self::$pdo === null){
                $dsn = "mysql:host={$host}; dbname={$dbName};charset={$charset}";
                self::$pdo = new PDO($dsn, $user, $pass, $opciones);
            }
            return self::$pdo;    
        }
        catch (PDOException $e) {
            // Manejo de errores de conexión
            return null; // Retorna null si hay un error
        }
    }
}