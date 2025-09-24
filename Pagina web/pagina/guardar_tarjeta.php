<?php
session_start();
include 'conexion.php';

$usuario = $_SESSION['usuario'];
$numero = $_POST['numero'];
$nombre = $_POST['nombre'];
$vencimiento = $_POST['vencimiento'];
$cvv = $_POST['cvv'];

// Insertar tarjeta en la base de datos
$stmt = $conn->prepare("INSERT INTO tarjetas (usuario, numero, nombre, vencimiento, cvv) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $usuario, $numero, $nombre, $vencimiento, $cvv);

if ($stmt->execute()) {
    // Redirigir a la factura después de guardar
    header("Location: factura.php");
    exit();
} else {
    echo "Error al guardar la tarjeta: " . $conn->error;
}

$conn->close();
?>
