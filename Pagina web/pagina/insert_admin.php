<?php
// Incluye la conexión a la base de datos
include 'conexion.php';

// Datos del administrador
$nombre = 'Admin Principal';
$email = 'admin0@gmail.com';
$password = '1234';

// Generar contraseña encriptada
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertar datos en la tabla
$query = "INSERT INTO admin1 (nombre_admin, email_admin, password_admin) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $nombre, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Administrador insertado correctamente. Ahora puedes iniciar sesión con:<br>";
    echo "Correo: $email<br>";
    echo "Contraseña: $password<br>";
} else {
    echo "Error al insertar el administrador: " . $conn->error;
}

// Cierra la conexión
$conn->close();
?>
