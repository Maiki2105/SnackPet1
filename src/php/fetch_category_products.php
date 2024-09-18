<?php
header('Content-Type: application/json');

// Conectar a la base de datos
include('db.php');

// Obtener categoría y subcategoría desde la consulta
$category = $_GET['category'] ?? '';
$subcategoria = $_GET['subcategoria'] ?? '';

// Consultar productos por categoría y subcategoría
$sql = "SELECT * FROM productos WHERE categoria = ? AND subcategoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $category, $subcategoria);
$stmt->execute();
$result = $stmt->get_result();

// Obtener productos y convertir a JSON
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);

$stmt->close();
$conn->close();
?>
