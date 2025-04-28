<?php
//require_once 'DatabaseInterface.php';
require_once 'DatabaseConexion.php';

//configuracion fuera cosa que si entra otra BD se crea asi como esto que acabamos de hacer y no movemos la clase DatabaseConexion.
$dbConfig = [
    'host' => 'localhost',
    'dbname' => 'biblioteca_mvc',
    'username' => 'root',
    'password' => 'root'
];

try {
    //Se instancia la conexion para ver si conecta,
    $databaseConexion = new DatabaseConexion(
        $dbConfig['host'],
        $dbConfig['dbname'],
        $dbConfig['username'],
        $dbConfig['password']
    );
    
    $databaseConexion -> connect();
    return $databaseConexion; //retorno la instancia con la conexion hecha.
    
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>