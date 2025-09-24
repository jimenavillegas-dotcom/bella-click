<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buscar y Comprar Producto</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff0f5; /* Rosa pastel */
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

    .form-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .form-container input, .form-container select, .form-container button {
        width: 100%;
        padding: 12px;
        margin: 12px 0;
        border: 1px solid #ccc;
        border-radius: 25px;
        font-size: 1em;
    }

    .form-container button {
        background-color: #ff6f91;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .form-container button:hover {
        background-color: #ff9a9e;
    }

    .product-info {
        border: 1px solid #ccc;
        padding: 20px;
        margin: 20px 0;
        text-align: center;
        border-radius: 15px;
        background-color: #fff0f5;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .product-info h2 {
        color: #ff6f91;
        margin: 5px 0;
    }

    .product-info h3 {
        margin: 5px 0;
        color: #ff6f91;
    }

    .product-info p {
        margin: 5px 0;
        font-size: 0.95em;
    }

    .buy-button {
        margin-top: 15px;
        background-color: #ff6f91;
        color: white;
        border: none;
        border-radius: 25px;
        padding: 12px 20px;
        font-weight: bold;
        cursor: pointer;
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

<div class="header">
    Buscar y Comprar Producto
</div>

<div class="form-container">
    <h2>Buscar Producto</h2>
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
            <option value="computacion">Productos suaves para la piel</option>
        </select>

        <button type="submit">Buscar Producto</button>
    </form>

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
                echo "<h2>" . $row['id_producto'] . "</h2>";
                echo "<h3>" . $row['nombre_producto'] . "</h3>";
                echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                echo "<p><strong>Precio:</strong> $" . $row['precio'] . "</p>";
                echo "<p><strong>Cantidad en Stock:</strong> " . $row['cantidad'] . "</p>";
                echo "<form action='comprar_producto.php' method='POST'>";
                echo "<input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>";
                echo "<input type='hidden' name='categoria' value='$categoria'>";
                echo "<label for='cantidad'>Cantidad a comprar:</label>";
                echo "<input type='number' name='cantidad' min='1' max='" . $row['cantidad'] . "' value='1' required>";
                echo "<p><strong>Total a Pagar:</strong> $" . $row['precio'] * 1 . "</p>";
                echo "<button type='submit' class='buy-button'>Comprar Producto</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No se encontraron productos para esa búsqueda.</p>";
        }
    }

    $conn->close();
    ?>
</div>

<a href="index.php" class="back-button">Regresar a Inicio</a>

</body>
</html>
