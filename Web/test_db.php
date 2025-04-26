<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=mysql', 'root', 'root');
    echo "Conexión exitosa a MySQL Community Server";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>