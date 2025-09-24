<?php
include 'conexion.php';

$conn->query("DELETE FROM carrito");

echo "<h2>El carrito ha sido vaciado.</h2>";
echo "<a href='carrito.php'>Regresar al carrito</a>";

$conn->close();
?>
