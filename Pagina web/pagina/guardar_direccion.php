<?php
session_start();
include 'conexion.php';

$usuario = $_SESSION['usuario'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$ciudad = $_POST['ciudad'];
$codigo_postal = $_POST['codigo_postal'];

// Insertar dirección
$stmt = $conn->prepare("INSERT INTO direcciones (usuario, calle, numero, ciudad, codigo_postal) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $usuario, $calle, $numero, $ciudad, $codigo_postal);

if($stmt->execute()){
    header("Location: pago.php"); // Redirige al pago
    exit();
} else {
    echo "Error al guardar la dirección: " . $conn->error;
}

$conn->close();
?>
