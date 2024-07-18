<?php
require 'db.php';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO usuarios (nombre, email, direccion, telefono) VALUES ('$nombre', '$email', '$direccion', '$telefono')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario agregado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
