<?php
include 'conexion.php';

if (isset($_POST['id_producto']) && isset($_POST['categoria']) && isset($_POST['cantidad'])) {
    $id_producto = $_POST['id_producto'];
    $categoria = $_POST['categoria'];
    $cantidad = $_POST['cantidad'];

    $query = "SELECT nombre_producto, precio, cantidad FROM $categoria WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
        if ($cantidad <= $producto['cantidad']) {
            $query_insert = "INSERT INTO carrito (id_producto, nombre_producto, cantidad, precio) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bind_param(
                "isid",
                $id_producto,
                $producto['nombre_producto'],
                $cantidad,
                $producto['precio']
            );
            $stmt_insert->execute();

            echo "<h2>Producto agregado al carrito exitosamente.</h2>";
        } else {
            echo "<h2>No hay suficiente stock disponible.</h2>";
        }
    } else {
        echo "<h2>Producto no encontrado.</h2>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Error: Datos inválidos.";
}
?>
<a href="index.php" class="back-button">Regresar al Inicio</a>