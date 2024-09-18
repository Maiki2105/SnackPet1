<?php
include 'db.php';

header('Content-Type: application/json');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data['productId'])) {
        $productId = $data['productId'];

        // Verifica si el carrito ya existe en la sesión
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Añade el producto al carrito
        $_SESSION['cart'][] = $productId;
        echo json_encode(['success' => true, 'message' => 'Producto añadido al carrito']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
}
?>
