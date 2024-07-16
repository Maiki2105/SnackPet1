<?php
include 'config.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$sql = "UPDATE usuarios SET nombre='$nombre', email='$email', direccion='$direccion', telefono='$telefono' WHERE id=$id";

$response = array();
if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

$conn->close();

echo json_encode($response);
?>
