<?php
include 'conexion.php';

$categoria_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;

if ($categoria_id > 0) {
    switch ($categoria_id) {
        case 1: $tabla_producto = 'autos_motos_y_otros'; break;
        case 2: $tabla_producto = 'celulares_y_telefonia'; break;
        case 3: $tabla_producto = 'electrodomesticos'; break;
        case 4: $tabla_producto = 'herramientas'; break;
        case 5: $tabla_producto = 'ropa_bolsas_calzado'; break;
        case 6: $tabla_producto = 'deportes_y_fitness'; break;
        case 7: $tabla_producto = 'computacion'; break;
        default: die('Categoría no válida');
    }
    $query = "SELECT * FROM $tabla_producto";
} else {
    $query = "SELECT * FROM autos_motos_y_otros UNION 
              SELECT * FROM celulares_y_telefonia UNION 
              SELECT * FROM electrodomesticos UNION 
              SELECT * FROM herramientas UNION 
              SELECT * FROM ropa_bolsas_calzado UNION 
              SELECT * FROM deportes_y_fitness UNION 
              SELECT * FROM computacion";
}

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Productos</title>
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
        padding: 20px 10px;
        text-align: center;
        color: white;
        font-size: 24px;
        font-weight: bold;
    }

    .container {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .filter-form {
        text-align: center;
        margin-bottom: 30px;
    }

    .filter-form select, .filter-form button {
        padding: 12px 20px;
        margin: 8px;
        border-radius: 25px;
        border: 1px solid #ccc;
        font-size: 1em;
    }

    .filter-form button {
        background-color: #ff6f91;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .filter-form button:hover {
        background-color: #ff9a9e;
    }

    .product-card {
        border: 1px solid #ccc;
        padding: 20px;
        margin: 15px;
        border-radius: 15px;
        background-color: #fff0f5;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
        display: inline-block;
        vertical-align: top;
        width: 250px;
    }

    .product-card img {
        max-width: 120px;
        margin-bottom: 15px;
        border-radius: 10px;
    }

    .product-card h3 {
        color: #ff6f91;
        margin: 5px 0;
    }

    .product-card p {
        margin: 5px 0;
        font-size: 0.95em;
    }

    .buy-button {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #ff6f91;
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .buy-button:hover {
        background-color: #ff9a9e;
    }

    .back-button {
        display: block;
        margin: 30px auto 0 auto;
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

<div class="header">Productos</div>

<div class="container">
    <form class="filter-form" method="GET" action="productos.php">
        <label for="categoria">Filtrar por Categoría:</label>
        <select id="categoria" name="categoria">
            <option value="0">Todas</option>
            <option value="1" <?php if ($categoria_id == 1) echo 'selected'; ?>>Brillos y colores mágicos para labios</option>
            <option value="2" <?php if ($categoria_id == 2) echo 'selected'; ?>>Tonos suaves para mejillas sonrojadas</option>
            <option value="3" <?php if ($categoria_id == 3) echo 'selected'; ?>>Paletas de ensueño y delineadores brillantes</option>
            <option value="4" <?php if ($categoria_id == 4) echo 'selected'; ?>>Colores vibrantes para uñas perfectas</option>
            <option value="5" <?php if ($categoria_id == 5) echo 'selected'; ?>>Kits completos para princesas</option>
            <option value="6" <?php if ($categoria_id == 6) echo 'selected'; ?>>Brochas, espejos y organizadores</option>
            <option value="7" <?php if ($categoria_id == 7) echo 'selected'; ?>>Productos suaves para la piel</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-card'>";
            echo "<img src='img/productos/" . $row['imagen'] . "' alt='" . $row['nombre_producto'] . "'>";
            echo "<h3>" . $row['nombre_producto'] . "</h3>";
            echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
            echo "<p><strong>Precio:</strong> $" . $row['precio'] . "</p>";
            echo "<p><strong>Stock:</strong> " . $row['cantidad'] . "</p>";

            // Formulario de comprar
            if ($row['cantidad'] > 0) {
                echo "<form method='POST' action='agregar_carrito.php'>";
                echo "<input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>";
                echo "<input type='number' name='cantidad' min='1' max='" . $row['cantidad'] . "' value='1' required>";
                echo "<button type='submit' class='buy-button'>Comprar</button>";
                echo "</form>";
            } else {
                echo "<p style='color:red; font-weight:bold;'>Agotado</p>";
            }

            echo "</div>";
        }
    } else {
        echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No hay productos disponibles.</p>";
    }

    $conn->close();
    ?>
</div>

<a href="index.php" class="back-button">Regresar a Inicio</a>
</body>
</html>
