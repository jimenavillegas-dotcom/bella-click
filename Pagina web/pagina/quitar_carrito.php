<?php
session_start();
include 'conexion.php';

if(isset($_POST['id_carrito'])){
    $id_carrito = $_POST['id_carrito'];
    $usuario = $_SESSION['usuario'] ?? '';

    // Eliminar del carrito solo si pertenece al usuario
    $stmt = $conn->prepare("DELETE FROM carrito WHERE id_carrito = ? AND usuario = ?");
    $stmt->bind_param("is", $id_carrito, $usuario);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

// Redirigir de vuelta al carrito
header("Location: carrito.php");
exit;
?>
