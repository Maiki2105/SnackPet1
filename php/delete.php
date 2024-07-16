<?php
include 'config.php';

$id = $_POST['id'];

$sql = "DELETE FROM usuarios WHERE id=$id";

$response = array();
if ($conn->query($sql) === TRUE) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

$conn->close();

echo json_encode($response);
?>
