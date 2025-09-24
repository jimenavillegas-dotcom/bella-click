<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

$mensaje = '';
$exito = false;

// Verificar si se recibió un ID de producto, la categoría y la cantidad
if (isset($_POST['id_producto'], $_POST['categoria'], $_POST['cantidad'])) {
    $producto_id = $_POST['id_producto'];
    $categoria = $_POST['categoria'];
    $cantidad_comprada = intval($_POST['cantidad']);

    // Consultar el producto para obtener precio y stock
    $query = "SELECT * FROM $categoria WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $precio = $row['precio'];
        $cantidad_disponible = $row['cantidad'];

        if ($cantidad_comprada <= $cantidad_disponible) {
            // Actualizar stock
            $nueva_cantidad = $cantidad_disponible - $cantidad_comprada;
            $update_query = "UPDATE $categoria SET cantidad = ? WHERE id_producto = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("ii", $nueva_cantidad, $producto_id);
            $update_stmt->execute();

            $total_a_pagar = $precio * $cantidad_comprada;
            $mensaje = "¡Compra realizada con éxito! Has comprado $cantidad_comprada producto(s) por un total de $$total_a_pagar.";
            $exito = true;
        } else {
            $mensaje = "No hay suficiente stock para realizar la compra.";
        }
    } else {
        $mensaje = "Producto no encontrado.";
    }

    $stmt->close();
    $conn->close();
} else {
    $mensaje = "Error: No se recibieron datos válidos.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Compra de Producto</title>
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
        color: <?php echo $exito ? '#ff6f91' : '#d23f4a'; ?>;
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

<div class="header">Compra de Producto</div>
<div class="container">
    <h2><?php echo $exito ? "¡Éxito!" : "Error"; ?></h2>
    <p><?php echo htmlspecialchars($mensaje); ?></p>
    <a href="index.php" class="back-button">Regresar a la página principal</a>
</div>

</body>
</html>
