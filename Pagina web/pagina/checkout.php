<?php
session_start();
include 'conexion.php';
$usuario = $_SESSION['usuario'];

// Revisar si ya hay dirección
$stmt = $conn->prepare("SELECT * FROM direcciones WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registrar Dirección</title>
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

    .container {
        max-width: 500px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        color: #ff6f91;
        margin-bottom: 25px;
    }

    input {
        width: 100%;
        padding: 12px;
        margin-top: 10px;
        border-radius: 10px;
        border: 1px solid #ccc;
        font-size: 1em;
    }

    button {
        margin-top: 20px;
        width: 100%;
        padding: 12px;
        background-color: #ff6f91;
        color: white;
        border: none;
        border-radius: 25px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
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

<div class="header">Registrar Dirección</div>

<div class="container">
<?php
if ($result->num_rows == 0) {
    // Formulario de dirección
    ?>
    <form action="guardar_direccion.php" method="POST">
        <h2>Ingresa tu Dirección</h2>
        <input type="text" name="calle" placeholder="Calle" required>
        <input type="text" name="numero" placeholder="Número" required>
        <input type="text" name="ciudad" placeholder="Ciudad" required>
        <input type="text" name="codigo_postal" placeholder="Código Postal" required>
        <button type="submit">Guardar Dirección</button>
    </form>
<?php
} else {
    // Si ya tiene dirección, ir directo a pago
    header("Location: pago.php");
}
?>
</div>


<a href="index.php" class="back-button">Regresar al Inicio</a>

</body>
</html>
