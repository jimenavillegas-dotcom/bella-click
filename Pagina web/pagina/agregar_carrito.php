<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];

// Revisar si ya existe el producto en el carrito
$query = "SELECT * FROM carrito WHERE usuario = ? AND id_producto = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $usuario, $id_producto);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si ya está, actualizar cantidad
    $row = $result->fetch_assoc();
    $nueva_cantidad = $row['cantidad'] + $cantidad;
    $update = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_carrito = ?");
    $update->bind_param("ii", $nueva_cantidad, $row['id_carrito']);
    $update->execute();
} else {
    // Si no está, agregar nuevo
    $insert = $conn->prepare("INSERT INTO carrito (usuario, id_producto, cantidad) VALUES (?, ?, ?)");
    $insert->bind_param("sii", $usuario, $id_producto, $cantidad);
    $insert->execute();
}

header("Location: carrito.php");
?>
