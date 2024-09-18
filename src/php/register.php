<?php
// Incluir archivo de conexión a la base de datos
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Sin encriptar
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Verificar si el email ya está registrado
    $sql = 'SELECT * FROM usuarios WHERE email = :email';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Si el correo ya está registrado, mostrar un mensaje de error
        echo "El correo electrónico ya está registrado.";
    } else {
        // Insertar los datos en la tabla usuarios
        $sql = 'INSERT INTO usuarios (nombre, email, password, direccion, telefono) VALUES (:nombre, :email, :password, :direccion, :telefono)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Contraseña sin encriptar
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':telefono', $telefono);

        if ($stmt->execute()) {
            // Redirigir a la página de inicio después del registro exitoso
            header("Location: ../views/index.html");
            exit;
        } else {
            // Si hay un error en la inserción, mostrar un mensaje
            echo "Hubo un error al registrar el usuario.";
        }
    }

    // Cerrar la conexión
    $conn = null;
}
?>
