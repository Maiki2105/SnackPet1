<?php
include 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener los servicios disponibles
    $sql = 'SELECT * FROM servicios';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $services = $stmt->fetchAll();

    echo json_encode($services);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Añadir un nuevo servicio
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['nombre'], $data['descripcion'], $data['precio'])) {
        $nombre = $data['nombre'];
        $descripcion = $data['descripcion'];
        $precio = $data['precio'];

        $sql = 'INSERT INTO servicios (nombre, descripcion, precio) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nombre, $descripcion, $precio])) {
            echo json_encode(['success' => true, 'message' => 'Servicio añadido']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al añadir el servicio']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
}
?>
