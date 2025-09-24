<?php
session_start();
include 'conexion.php';
$usuario = $_SESSION['usuario'] ?? '';

// Obtener carrito desde todas las tablas
$stmt = $conn->prepare("
    SELECT c.id_carrito, c.id_producto, p.nombre_producto, p.precio, c.cantidad
    FROM carrito c
    JOIN (
        SELECT id_producto, nombre_producto, precio FROM autos_motos_y_otros
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM celulares_y_telefonia
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM computacion
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM deportes_y_fitness
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM electrodomesticos
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM herramientas
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM ropa_bolsas_calzado
    ) p ON c.id_producto = p.id_producto
    WHERE c.usuario = ?
");

$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Factura</title>
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
    .factura-container {
        max-width: 900px;
        margin: 40px auto;
        background-color: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 25px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
    }
    th {
        background-color: #ff6f91;
        color: white;
    }
    .btn {
        display: inline-block;
        margin: 10px 5px;
        padding: 12px 25px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: bold;
        color: white;
        background-color: #ff6f91;
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background-color: #ff9a9e;
    }
</style>
</head>
<body>

<div class="header">Factura</div>
<div class="factura-container">
    <table>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            $subtotal = $row['precio'] * $row['cantidad'];
            $total += $subtotal;
            echo "<tr>
                    <td>{$row['nombre_producto']}</td>
                    <td>\${$row['precio']}</td>
                    <td>{$row['cantidad']}</td>
                    <td>\$$subtotal</td>
                  </tr>";
        }
        ?>
        <tr>
            <td colspan="3"><strong>Total</strong></td>
            <td><strong>$<?php echo $total; ?></strong></td>
        </tr>
    </table>

    <a href="index.php" class="btn">Regresar al inicio</a>
    <a href="descargar_pdf.php" class="btn">Descargar PDF</a>
    <a href="procesar_pago.php" class="btn">Pagar</a>

</div>

</body>
</html>
<?php $conn->close(); ?>
