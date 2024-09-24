<?php
header('Content-Type: application/json');
include '../db.php'; // Incluimos la conexión a la base de datos

// Validamos si el método es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $userId = $data['userId'];
    $productId = $data['productId'];
    $quantity = $data['quantity'];

    // Consulta para agregar un producto al carrito
    $sql = 'INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)';
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$userId, $productId, $quantity])) {
        echo json_encode(['success' => true, 'message' => 'Producto agregado al carrito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al agregar el producto al carrito']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
?>
