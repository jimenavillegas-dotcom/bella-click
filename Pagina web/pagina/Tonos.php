<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tonos y bases</title>
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

    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 30px 20px;
        gap: 25px;
    }

    .product-card {
        background-color: #fff;
        border-radius: 15px;
        padding: 20px;
        width: 250px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .product-card img {
        max-width: 120px;
        height: auto;
        margin-bottom: 15px;
        border-radius: 10px;
    }

    .product-card h3 {
        margin: 10px 0;
        font-size: 1.3em;
        color: #ff6f91;
    }

    .product-card p {
        margin: 5px 0;
        font-size: 0.95em;
    }

    .buy-button, .add-button {
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

    .buy-button:hover, .add-button:hover {
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

<div class="header">Bases y tonos</div>

<div class="product-container">
<?php
session_start();
include 'conexion.php';
$usuario = $_SESSION['usuario'] ?? 'invitado';

// Cambia el nombre de la tabla si tu tabla real no es autos_motos_y_otros
$query = "SELECT * FROM celulares_y_telefonia";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-card'>";
        echo "<img src='img/productos/" . $row['imagen'] . "' alt='" . $row['nombre_producto'] . "'>";
        echo "<h3>" . $row['nombre_producto'] . "</h3>";
        echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
        echo "<p><strong>Precio:</strong> $" . $row['precio'] . "</p>";
        echo "<p><strong>Stock:</strong> " . $row['cantidad'] . "</p>";

        if ($row['cantidad'] > 0) {
            // Formulario para agregar al carrito
            echo "<form method='POST' action='agregar_carrito.php'>";
            echo "<input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>";
            echo "<input type='number' name='cantidad' min='1' max='" . $row['cantidad'] . "' value='1' style='margin-top:10px; width:60px;' required>";
            echo "<button type='submit' class='add-button'>Agregar al Carrito</button>";
            echo "</form>";

            // Formulario para comprar directamente
            echo "<form method='POST' action='checkout.php'>";
            echo "<input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>";
            echo "<input type='hidden' name='cantidad' value='1'>";
            echo "<button type='submit' class='buy-button'>Comprar</button>";
            echo "</form>";
        } else {
            echo "<p style='color:red; font-weight:bold;'>Agotado</p>";
        }

        echo "</div>";
    }
} else {
    echo "<p>No hay productos disponibles en esta categoría.</p>";
}

$conn->close();
?>
</div>

<a href="carrito.php" class="back-button">Ver Carrito</a>
<a href="index.php" class="back-button">Regresar a Inicio</a>

</body>
</html>
