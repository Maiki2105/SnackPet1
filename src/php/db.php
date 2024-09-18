<?php
// src/php/db.php

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "snackpet"; // El nombre de la base de datos

try {
    // Crear la conexión usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar PDO para que muestre excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Mostrar error en caso de que falle la conexión
    echo "Connection failed: " . $e->getMessage();
}
?>
