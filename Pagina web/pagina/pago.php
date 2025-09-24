<?php
session_start();
include 'conexion.php';
$usuario = $_SESSION['usuario'];

// Revisar si ya hay tarjeta registrada
$stmt = $conn->prepare("SELECT * FROM tarjetas WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar Tarjeta</title>
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

    .form-container {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .form-container h2 {
        text-align: center;
        color: #ff6f91;
        margin-bottom: 25px;
    }

    .form-container input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 1em;
    }

    .form-container button {
        width: 100%;
        padding: 12px;
        background-color: #ff6f91;
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .form-container button:hover {
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
    <div class="header">Registrar Tarjeta</div>

    <div class="form-container">
    <?php
    if ($result->num_rows == 0) {
        ?>
        <h2>Agregar Tarjeta de Pago</h2>
        <form action="guardar_tarjeta.php" method="POST">
            <input type="text" name="numero" placeholder="Número de tarjeta" required>
            <input type="text" name="nombre" placeholder="Nombre en tarjeta" required>
            <input type="text" name="vencimiento" placeholder="MM/AA" required>
            <input type="text" name="cvv" placeholder="CVV" required>
            <button type="submit">Guardar Tarjeta</button>
        </form>
        <?php
    } else {
        header("Location: factura.php");
        exit();
    }
    ?>
    </div>

    <a href="carrito.php" class="back-button">Regresar al Carrito</a>
</body>
</html>
