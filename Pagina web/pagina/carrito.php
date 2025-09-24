<?php
session_start();
include 'conexion.php';
$usuario = $_SESSION['usuario'] ?? '';

// Obtener productos del carrito desde todas las tablas
$stmt = $conn->prepare("
    SELECT c.id_carrito, c.id_producto, p.nombre_producto, p.precio, c.cantidad, p.imagen, p.tabla_origen
    FROM carrito c
    JOIN (
        SELECT id_producto, nombre_producto, precio, imagen, 'autos_motos_y_otros' AS tabla_origen FROM autos_motos_y_otros
        UNION ALL
        SELECT id_producto, nombre_producto, precio, imagen, 'celulares_y_telefonia' FROM celulares_y_telefonia
        UNION ALL
        SELECT id_producto, nombre_producto, precio, imagen, 'computacion' FROM computacion
        UNION ALL
        SELECT id_producto, nombre_producto, precio, imagen, 'deportes_y_fitness' FROM deportes_y_fitness
        UNION ALL
        SELECT id_producto, nombre_producto, precio, imagen, 'electrodomesticos' FROM electrodomesticos
        UNION ALL
        SELECT id_producto, nombre_producto, precio, imagen, 'herramientas' FROM herramientas
        UNION ALL
        SELECT id_producto, nombre_producto, precio, imagen, 'ropa_bolsas_calzado' FROM ropa_bolsas_calzado
    ) p ON c.id_producto = p.id_producto
    WHERE c.usuario = ?
");

$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carrito de Compras</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff0f5;
        color: #333;
    }

    .header {
        background: linear-gradient(90deg, #ff6f91, #ff9a9e);
        color: white;
        padding: 25px 10px;
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.2);
    }

    .cart-container {
        max-width: 1000px;
        margin: 40px auto;
        display: flex;
        flex-wrap: wrap;
        gap: 25px;
        justify-content: center;
    }

    .cart-item {
        background-color: #fff;
        border-radius: 15px;
        padding: 20px;
        width: 250px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .cart-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .cart-item img {
        max-width: 120px;
        height: auto;
        margin-bottom: 15px;
        border-radius: 10px;
    }

    .cart-item h3 {
        margin: 10px 0;
        font-size: 1.3em;
        color: #ff6f91;
    }

    .cart-item p {
        margin: 5px 0;
        font-size: 0.95em;
    }

    .remove-button, .checkout-button {
        margin-top: 10px;
        padding: 10px 15px;
        background-color: #ff6f91;
        color: white;
        border: none;
        border-radius: 20px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .remove-button:hover, .checkout-button:hover {
        background-color: #ff9a9e;
    }

    .back-button {
        display: block;
        margin: 30px auto;
        padding: 12px 25px;
        background-color: #ff6f91;
        color: white;
        text-decoration: none;
        text-align: center;
        border-radius: 25px;
        width: 220px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #ff9a9e;
    }
</style>
</head>
<body>

<div class="header">Carrito de Compras</div>

<div class="cart-container">
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='cart-item'>";
        echo "<img src='img/productos/" . $row['imagen'] . "' alt='" . $row['nombre_producto'] . "'>";
        echo "<h3>" . $row['nombre_producto'] . "</h3>";
        echo "<p><strong>Precio:</strong> $" . $row['precio'] . "</p>";
        echo "<p><strong>Cantidad:</strong> " . $row['cantidad'] . "</p>";
        echo "<form method='POST' action='quitar_carrito.php'>";
        echo "<input type='hidden' name='id_carrito' value='" . $row['id_carrito'] . "'>";
        echo "<button type='submit' class='remove-button'>Quitar</button>";
        echo "</form>";
        echo "</div>";
    }

    echo "<div style='width:100%; text-align:center; margin-top:30px;'>";
    echo "<a href='checkout.php' class='checkout-button'>Continuar a Pagar</a>";
    echo "</div>";

} else {
    echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>Tu carrito está vacío.</p>";
}

$conn->close();
?>
</div>

<a href="index.php" class="back-button">Regresar a Inicio</a>

</body>
</html>
