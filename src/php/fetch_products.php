<?php
// fetch_products.php

header('Content-Type: application/json');

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'snackpet';
$user = 'root'; 
$password = ''; 

// Crear una conexión a la base de datos
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die('Conexión fallida: ' . $conn->connect_error);
}

$category = isset($_GET['category']) ? $_GET['category'] : '';

// Preparar la consulta
if ($category) {
    $stmt = $conn->prepare("SELECT * FROM productos WHERE categoria = ?");
    $stmt->bind_param('s', $category);
} else {
    $stmt = $conn->prepare("SELECT * FROM productos");
}

// Ejecutar la consulta
$stmt->execute();
$result = $stmt->get_result();

// Obtener los datos y devolverlos como JSON
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
