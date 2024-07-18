<?php
require 'db.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$sql = "UPDATE usuarios SET nombre='$nombre', email='$email', direccion='$direccion', telefono='$telefono' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Usuario actualizado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
