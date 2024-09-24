<?php
include 'db.php';

header('Content-Type: application/json');

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado']);
    exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Obtener la información del usuario
    $sql = 'SELECT nombre, email, direccion, telefono FROM usuarios WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if ($user) {
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Actualizar la información del usuario
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['nombre'], $data['direccion'], $data['telefono'])) {
        $nombre = $data['nombre'];
        $direccion = $data['direccion'];
        $telefono = $data['telefono'];

        $sql = 'UPDATE usuarios SET nombre = ?, direccion = ?, telefono = ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nombre, $direccion, $telefono, $userId])) {
            echo json_encode(['success' => true, 'message' => 'Información actualizada']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la información']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
}
?>
