<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Verificar si se recibió un ID de producto y la categoría
if (isset($_POST['id_producto']) && isset($_POST['categoria'])) {
    $producto_id = $_POST['id_producto'];
    $categoria = $_POST['categoria'];

    // Eliminar el producto de la base de datos
    $query = "DELETE FROM $categoria WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $producto_id);

    if ($stmt->execute()) {
        echo "<h2>Producto eliminado con éxito.</h2>";
        echo "<a href='eliminar.php'>Eliminar otro producto</a>";
        echo "<a href='index.php'>regresar al inicio</a>";
    } else {
        echo "<h2>Error al eliminar el producto. Por favor, inténtelo de nuevo.</h2>";
    }
   
    // Cerrar conexión
    $stmt->close();
    $conn->close();
} else {
    echo "Error: No se recibieron datos válidos.";
}
?>
<!-- Navegación -->
<div class="nav">
   
 
    <a href="vender_producto.html">Vender Producto</a>
    <a href="productos.php">productos</a>

</div>