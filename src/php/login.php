<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Preparar consulta SQL para obtener el usuario por email
    $sql = 'SELECT * FROM usuarios WHERE email = :email or nombre = :email'  ;
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si se encontró el usuario, verificar la contraseña
    if ($user && $user['password'] === $password) {
        header("LOCATION:../views/index.html");
        exit;
    } else {
        echo "Correo o contraseña incorrectos.";
    }
}
?>
