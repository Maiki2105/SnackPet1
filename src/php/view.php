<?php
header('Content-Type: application/json');
include 'db.php'; // Incluimos la conexión a la base de datos

// Obtenemos el ID del usuario desde la URL
$userId = $_GET['userId'];

// Consulta para obtener los productos en el carrito de un usuario
$sql = 'SELECT productos.id, productos.nombre, productos.precio, carrito.cantidad FROM carrito
        JOIN productos ON carrito.producto_id = productos.id
        WHERE carrito.usuario_id = ?';

$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);

$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolvemos los productos del carrito en formato JSON
echo json_encode($cartItems);
?>
