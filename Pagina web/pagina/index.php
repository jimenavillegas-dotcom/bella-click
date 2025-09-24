<?php
session_start();
include 'conexion.php';

// Verificar si el usuario está conectado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tienda Belleza & Estilo Mágico</title>
<style>
/* Estilos generales mágicos */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    min-height: 100vh;
    background: radial-gradient(circle at top left, #ffd6e8, #ffe6f7, #fff0fb);
    overflow-y: auto;   /* habilita el scroll vertical */
    overflow-x: hidden; /* oculta scroll horizontal innecesario */
    position: relative;
    color: #333;


}

/* Rayos de colores animados */
.ray {
    position: absolute;
    width: 3px;
    height: 120vh;
    background: linear-gradient(180deg, #ff6fb1, #ff85c1, #ffb6d1);
    opacity: 0.5;
    transform: rotate(45deg);
    animation: moveRay 4s linear infinite;
}
@keyframes moveRay {
    0% { transform: rotate(45deg) translateX(0); }
    50% { transform: rotate(45deg) translateX(50px); }
    100% { transform: rotate(45deg) translateX(0); }
}

/* Corazones flotantes */
.heart {
    position: absolute;
    width: 20px;
    height: 20px;
    background: pink;
    transform: rotate(45deg);
    animation: float 6s linear infinite;
}
.heart::before, .heart::after {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    background: pink;
    border-radius: 50%;
}
.heart::before { top: -10px; left: 0; }
.heart::after { left: 10px; top: 0; }
@keyframes float {
    0% { transform: translateY(100vh) rotate(45deg); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: translateY(-50px) rotate(45deg); opacity: 0; }
}

/* Estrellas animadas */
.star {
    position: absolute;
    width: 6px;
    height: 6px;
    background: yellow;
    border-radius: 50%;
    box-shadow: 0 0 8px #fff, 0 0 12px #ffccff;
    animation: twinkle 3s infinite;
}
@keyframes twinkle {
    0%, 100% { opacity: 0; transform: scale(0.5); }
    50% { opacity: 1; transform: scale(1.2); }
}

/* Nubecitas animadas */
.cloud {
    position: absolute;
    background: #ffffffaa;
    border-radius: 50%;
    opacity: 0.8;
    animation: moveClouds linear infinite;
}
.cloud::before, .cloud::after {
    content: '';
    position: absolute;
    background: #ffffffaa;
    border-radius: 50%;
}
.cloud::before { width: 50px; height: 50px; top: -20px; left: 10px; }
.cloud::after { width: 30px; height: 30px; top: -10px; left: 30px; }
@keyframes moveClouds {
    0% { transform: translateX(-200px); }
    100% { transform: translateX(120vw); }
}

/* Cabecera */
.header {
    background: linear-gradient(90deg, #ff6f91, #ff9a9e);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    position: relative;
    z-index: 1;
}

.header img {
    height: 50px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
}

.header .user-info {
    font-weight: bold;
    display: flex;
    align-items: center;
}

.header .logout-button {
    margin-left: 15px;
    background-color: #fff;
    color: #ff6f91;
    border: none;
    padding: 7px 15px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.3s ease;
}

.header .logout-button:hover {
    background-color: #ffe6f0;
}

/* Barra de navegación */
.nav {
    background-color: #ffe6f0cc;
    padding: 12px 0;
    display: flex;
    justify-content: center;
    gap: 25px;
    position: relative;
    z-index: 1;
}

.nav a {
    text-decoration: none;
    color: #ff6f91;
    font-weight: bold;
    padding: 5px 15px;
    border-radius: 20px;
    transition: all 0.3s ease;
}

.nav a:hover {
    background-color: #ff6f91;
    color: white;
}

/* Banner con video */
.banner-container {
    position: relative;
    width: 100%;
    height: 350px;
    overflow: hidden;
    z-index: 1;
}

.banner-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.banner-text {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: rgba(220, 58, 241, 1);
    font-size: 90px;
    font-weight: bold;
    text-shadow: 2px 2px 8px rgba(248, 248, 248, 0.88);
    text-align: center;
}

/* Sección de categorías */
.categories {
    padding: 40px 20px;
    position: relative;
    z-index: 1;
}

.categories h2 {
    text-align: center;
    font-size: 28px;
    margin-bottom: 30px;
    color: #ff4da6;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    justify-items: center;
}

.category-item {
    background-color: #ffffffcc;
    border-radius: 20px;
    width: 250px;
    height: 300px;
    text-align: center;
    text-decoration: none;
    color: #333;
    padding: 20px;
    box-shadow: 0 6px 18px rgba(255,182,193,0.4);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.category-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 28px rgba(255,182,193,0.6);
}

.category-item img {
    width: 130px;
    height: 130px;
    object-fit: contain;
    margin-bottom: 15px;
}

.category-item p {
    font-weight: bold;
    font-size: 17px;
    color: #ff6f91;
    line-height: 1.3;
}

/* Pie de página */
.footer {
    background-color: #ff6f91;
    color: white;
    padding: 25px;
    text-align: center;
    position: relative;
    z-index: 1;
}
</style>
</head>
<body>

<!-- Rayos -->
<?php for ($i=0;$i<10;$i++): ?>
    <div class="ray" style="left: <?= rand(0,100) ?>%; animation-duration: <?= rand(3,6) ?>s;"></div>
<?php endfor; ?>

<!-- Corazones -->
<?php for ($i=0;$i<25;$i++): ?>
    <div class="heart" style="left: <?= rand(0,100) ?>%; animation-duration: <?= rand(4,10) ?>s;"></div>
<?php endfor; ?>

<!-- Estrellas -->
<?php for ($i=0;$i<15;$i++): ?>
    <div class="star" style="left: <?= rand(0,100) ?>%; top: <?= rand(0,100) ?>%; animation-duration: <?= rand(2,5) ?>s;"></div>
<?php endfor; ?>

<!-- Nubecitas -->
<?php for ($i=0;$i<8;$i++): ?>
    <div class="cloud" style="top: <?= rand(5,50) ?>%; width: <?= rand(80,150) ?>px; height: <?= rand(40,60) ?>px; animation-duration: <?= rand(40,80) ?>s;"></div>
<?php endfor; ?>

<!-- Cabecera -->
<div class="header">
    <img src="img/logo.jpg" alt="Logo Tienda Belleza">
    <div class="user-info">
        Hola, <?php echo htmlspecialchars($usuario); ?>
        <form action="logout.php" method="POST" style="display:inline;">
            <button type="submit" class="logout-button">Cerrar sesión</button>
        </form>
    </div>
</div>

<!-- Navegación -->
<div class="nav">
   
    <a href="carrito.php">Carrito</a>
    
    <a href="categorias.php">Categorias</a>
</div>

<!-- Banner con video -->
<div class="banner-container">
    <video autoplay muted loop class="banner-video">
        <source src="videos/banner_video.mp4" type="video/mp4">
        Tu navegador no soporta videos.
    </video>
    <div class="banner-text">Bella click</div>
</div>

 <style>
    /* Estilos generales */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff0f5; /* Rosa pastel suave */
        color: #333;
    }

    /* Cabecera */
    .header {
        background: linear-gradient(90deg, #ff6f91, #ff9a9e);
        color: white;
        padding: 25px 10px;
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.2);
    }

    /* Contenedor de productos */
    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        padding: 30px 20px;
        gap: 25px;
    }

    /* Tarjetas de productos */
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

    /* Botón de regreso */
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
  

  <!-- Contenedor de productos Brillos y colores -->
<div class="product-container">
<?php
include 'conexion.php';

// Tabla de brillos
$query = "SELECT * FROM autos_motos_y_otros"; // Asegúrate que esta tabla contiene tus productos de brillos

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
    echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No hay productos de Brillos y colores disponibles.</p>";
}

$conn->close();
?>
<?php
include 'conexion.php';

// Tabla de brillos
$query = "SELECT * FROM celulares_y_telefonia"; // Asegúrate que esta tabla contiene tus productos de brillos

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
    echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No hay productos de Brillos y colores disponibles.</p>";
}

$conn->close();
?>
<?php
include 'conexion.php';

// Tabla de brillos
$query = "SELECT * FROM computacion"; // Asegúrate que esta tabla contiene tus productos de brillos

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
    echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No hay productos de Brillos y colores disponibles.</p>";
}

$conn->close();
?>
<?php
include 'conexion.php';

// Tabla de brillos
$query = "SELECT * FROM deportes_y_fitness"; // Asegúrate que esta tabla contiene tus productos de brillos

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
    echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No hay productos de Brillos y colores disponibles.</p>";
}

$conn->close();
?>
<?php
include 'conexion.php';

// Tabla de brillos
$query = "SELECT * FROM electrodomesticos"; // Asegúrate que esta tabla contiene tus productos de brillos

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
    echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No hay productos de Brillos y colores disponibles.</p>";
}

$conn->close();
?>
<?php
include 'conexion.php';

// Tabla de brillos
$query = "SELECT * FROM herramientas"; // Asegúrate que esta tabla contiene tus productos de brillos

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
    echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No hay productos de Brillos y colores disponibles.</p>";
}

$conn->close();
?>

<?php
include 'conexion.php';

// Tabla de brillos
$query = "SELECT * FROM ropa_bolsas_calzado"; // Asegúrate que esta tabla contiene tus productos de brillos

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
    echo "<p style='text-align:center; color:#ff6f91; font-weight:bold;'>No hay productos de Brillos y colores disponibles.</p>";
}

$conn->close();
?>
</div>

</div>


<!-- Footer -->
<div class="footer">
    &copy; 2024 Tienda Belleza & Estilo. Todos los derechos reservados.
</div>
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
</body>
</html>
