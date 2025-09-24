<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buscar y Agregar al Carrito</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff0f5;
        margin: 0;
        padding: 0;
        color: #333;
    }
    .header {
        background: linear-gradient(90deg, #ff6f91, #ff9a9e);
        color: white;
        padding: 20px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
    }
    .form-container {
        max-width: 600px;
        margin: 30px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    input, select, button {
        width: 100%;
        padding: 12px;
        margin: 12px 0;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1em;
    }
    button {
        background-color: #ff6f91;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border: none;
    }
    button:hover {
        background-color: #ff9a9e;
    }
    .product-info {
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px 0;
        text-align: center;
        border-radius: 10px;
        background-color: #fff5f8;
    }
    .product-info h3 {
        font-size: 1.5em;
        margin-bottom: 10px;
        color: #ff6f91;
    }
    .back-button {
        display: inline-block;
        margin: 30px auto;
        padding: 12px 25px;
        background-color: #ff6f91;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        font-weight: bold;
        text-align: center;
        transition: background-color 0.3s ease;
    }
    .back-button:hover {
        background-color: #ff9a9e;
    }
</style>
</head>
<body>

<div class="header">Buscar y Agregar al Carrito</div>

<div class="form-container">
    <form action="" method="POST">
        <label for="nombre_producto">Nombre del Producto:</label>
        <input type="text" id="nombre_producto" name="nombre_producto" required>

        <label for="categoria">Categoría:</label>
        <select id="categoria" name="categoria" required>
            <option value="autos_motos_y_otros">Brillos y colores mágicos para labios</option>
            <option value="celulares_y_telefonia">Tonos suaves para mejillas sonrojadas</option>
            <option value="electrodomesticos">Paletas de ensueño y delineadores brillantes</option>
            <option value="herramientas">Colores vibrantes para uñas perfectas</option>
            <option value="ropa_bolsas_calzado">Kits completos para princesas</option>
            <option value="deportes_y_fitness">Brochas, espejos y organizadores</option>
            <option value="computacion">productos suaves para la piel</option>
        </select>

        <button type="submit">Buscar Producto</button>
    </form>
</div>

<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_producto = $_POST['nombre_producto'];
    $categoria = $_POST['categoria'];

    $query = "SELECT * FROM $categoria WHERE nombre_producto LIKE ?";
    $stmt = $conn->prepare($query);
    $nombre_producto = "%" . $nombre_producto . "%";
    $stmt->bind_param("s", $nombre_producto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-info'>";
            echo "<h3>" . htmlspecialchars($row['nombre_producto']) . "</h3>";
            echo "<p><strong>Descripción:</strong> " . htmlspecialchars($row['descripcion']) . "</p>";
            echo "<p><strong>Precio:</strong> $" . htmlspecialchars($row['precio']) . "</p>";
            echo "<p><strong>Cantidad en Stock:</strong> " . htmlspecialchars($row['cantidad']) . "</p>";
            echo "<form action='agregar_al_carrito.php' method='POST'>";
            echo "<input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>";
            echo "<input type='hidden' name='categoria' value='$categoria'>";
            echo "<label for='cantidad'>Cantidad:</label>";
            echo "<input type='number' name='cantidad' min='1' max='" . $row['cantidad'] . "' required>";
            echo "<button type='submit'>Agregar al Carrito</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "<p style='text-align:center; color:#d23f4a;'>No se encontraron productos.</p>";
    }
    $stmt->close();
}

$conn->close();
?>

<a href="index.php" class="back-button">Regresar al Inicio</a>

</body>
</html>
