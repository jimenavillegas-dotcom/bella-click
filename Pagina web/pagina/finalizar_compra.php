<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Iniciar la transacción para asegurar que todo se ejecute correctamente
$conn->begin_transaction();

try {
    // Consultar todos los productos en el carrito
    $query_carrito = "SELECT * FROM carrito";
    $result_carrito = $conn->query($query_carrito);

    if ($result_carrito->num_rows > 0) {
        $total_compra = 0;

        // Definir las tablas de productos por categoría
        $categorias = [
            'autos_motos_y_otros' => 'Autos, Motos y otros',
            'celulares_y_telefonia' => 'Celulares y Telefonía',
            'electrodomesticos' => 'Electrodomésticos',
            'herramientas' => 'Herramientas',
            'ropa_bolsas_calzado' => 'Ropa, bolsas y calzado',
            'deportes_y_fitness' => 'Deportes y Fitness',
            'computacion' => 'Productos suaves para la piel'
        ];

        // Procesar cada producto del carrito
        while ($row = $result_carrito->fetch_assoc()) {
            $id_producto = $row['id_producto'];
            $nombre_producto = $row['nombre_producto'];
            $cantidad_comprada = $row['cantidad'];
            $precio = $row['precio'];
            $categoria = $row['categoria'];  // El nombre de la categoría

            if (array_key_exists($categoria, $categorias)) {
                $tabla_categoria = $categoria;

                $query_producto = "SELECT * FROM $tabla_categoria WHERE id_producto = ?";
                $stmt = $conn->prepare($query_producto);
                $stmt->bind_param("i", $id_producto);
                $stmt->execute();
                $result_producto = $stmt->get_result();

                if ($result_producto->num_rows > 0) {
                    $producto = $result_producto->fetch_assoc();
                    $cantidad_disponible = $producto['cantidad'];

                    if ($cantidad_comprada <= $cantidad_disponible) {
                        $nueva_cantidad = $cantidad_disponible - $cantidad_comprada;
                        $update_query = "UPDATE $tabla_categoria SET cantidad = ? WHERE id_producto = ?";
                        $update_stmt = $conn->prepare($update_query);
                        $update_stmt->bind_param("ii", $nueva_cantidad, $id_producto);
                        $update_stmt->execute();

                        $total_compra += $precio * $cantidad_comprada;

                        $delete_query = "DELETE FROM carrito WHERE id_producto = ?";
                        $delete_stmt = $conn->prepare($delete_query);
                        $delete_stmt->bind_param("i", $id_producto);
                        $delete_stmt->execute();
                    } else {
                        throw new Exception("No hay suficiente stock para el producto: $nombre_producto.");
                    }
                } else {
                    throw new Exception("Producto no encontrado en la categoría: $nombre_producto.");
                }

                $stmt->close();
            } else {
                throw new Exception("Categoría no válida: $categoria.");
            }
        }

        $conn->commit();
    } else {
        throw new Exception("No hay productos en el carrito.");
    }

} catch (Exception $e) {
    $conn->rollback();
    $error_message = $e->getMessage();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Finalizar Compra</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff0f5;
        margin: 0;
        padding: 0;
        color: #333;
        text-align: center;
    }
    .header {
        background: linear-gradient(90deg, #ff6f91, #ff9a9e);
        color: white;
        padding: 20px;
        font-size: 24px;
        font-weight: bold;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    h2 {
        color: #ff6f91;
    }
    p {
        font-size: 1.1em;
        margin: 20px 0;
    }
    .back-button {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 25px;
        background-color: #ff6f91;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    .back-button:hover {
        background-color: #ff9a9e;
    }
</style>
</head>
<body>

<div class="header">Resumen de Compra</div>
<div class="container">
<?php if (isset($error_message)): ?>
    <h2>Error</h2>
    <p><?php echo htmlspecialchars($error_message); ?></p>
<?php else: ?>
    <h2>¡Compra realizada con éxito!</h2>
    <p>El total a pagar es: $<?php echo number_format($total_compra, 2); ?></p>
<?php endif; ?>
<a href="index.php" class="back-button">Regresar a la página principal</a>
</div>

</body>
</html>
