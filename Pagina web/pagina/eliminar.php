<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está conectado
if (!isset($_SESSION['admin1'])) {
    header("Location: admin1.php");
    exit;
}

// Obtener el nombre del usuario de la sesión
$usuario = $_SESSION['admin1'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar y Eliminar Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #f30049;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .form-container {
            margin: 30px;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .product-info {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 15px 0;
            text-align: center;
        }
        .product-info h3 {
            font-size: 1.5em;
        }
        .product-info p {
            margin: 5px 0;
        }
        .delete-button {
            background-color: #f30049;
            color: white;
            cursor: pointer;
        }
        /* Contenedor de productos */
    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 30px 20px;
        gap: 25px;
    }
        .back-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #f30049;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            width: 200px;
            display: block;
            margin: 20px auto;
        }
        
    </style>
</head>
<body>
    <div class="header">
        <h1>Buscar y Eliminar Producto</h1>
    </div>
    <!-- Navegación -->
<div class="nav">
   
 
    <a href="vender_producto.html">Vender Producto</a>
    <a href="productos.php">productos</a>

</div>

    <div class="form-container">
        <h2>Buscar Producto</h2>
        <form action="eliminar.php" method="POST">
            <label for="nombre_producto">Nombre del Producto:</label>
            <input type="text" id="nombre_producto" name="nombre_producto" required>

            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <option value="autos_motos_y_otros">Brillos y colores mágicos para labio</option>
                <option value="celulares_y_telefonia">Tonos suaves para mejillas sonrojadas</option>
                <option value="electrodomesticos">Paletas de ensueño y delineadores brillantes</option>
                <option value="herramientas">Colores vibrantes para uñas perfectas</option>
                <option value="ropa_bolsas_calzado">Kits completos para princesas</option>
                <option value="deportes_y_fitness">Brochas, espejos y organizadores</option>
                <option value="computacion">productos suaves para la piel</option>
            </select>

            <button type="submit">Buscar Producto</button>
        </form>

        <?php
        // Incluir la conexión a la base de datos
        include 'conexion.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre_producto = $_POST['nombre_producto'];
            $categoria = $_POST['categoria'];

            // Consultar el producto de la base de datos
            $query = "SELECT * FROM $categoria WHERE nombre_producto LIKE ?";
            $stmt = $conn->prepare($query);
            $nombre_producto = "%" . $nombre_producto . "%";  // Para búsqueda parcial
            $stmt->bind_param("s", $nombre_producto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Mostrar la información del producto encontrado
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product-info'>";
                    echo "<h2>ID: " . $row['id_producto'] . "</h2>";
                    echo "<h3>" . $row['nombre_producto'] . "</h3>";
                    echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
                    echo "<p><strong>Precio:</strong> $" . $row['precio'] . "</p>";
                    echo "<p><strong>Cantidad en Stock:</strong> " . $row['cantidad'] . "</p>";
                    echo "<p><strong>Imagen:</strong> " . $row['imagen'] . "</p>";
                    echo "<img src='img/productos/" . $row['imagen'] . "' alt='" . $row['nombre_producto'] . "'>";
                    echo "<form action='eliminar_producto.php' method='POST'>";
                    echo "<input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>";
                    echo "<input type='hidden' name='categoria' value='$categoria'>";
                    echo "<button type='submit' class='delete-button'>Eliminar Producto</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>No se encontraron productos para esa búsqueda.</p>";
            }
        }

        // Cerrar conexión
        $conn->close();
        ?>
    </div>

    <a href="login.php" class="back-button">Regresar a Inicio</a>
    <div class="user-info">
        Hola, <?php echo htmlspecialchars($usuario); ?> 
        <form action="index.php" method="POST" style="display: inline;">
            <button type="submit" class="logout-button">Cerrar sesión</button>
        </form>
    </div>
</body>
</html>
