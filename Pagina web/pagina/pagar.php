<?php
session_start();
$_SESSION['seleccionados'] = $_POST['seleccionados'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Pago</title>
<style>
    body { font-family: Arial, sans-serif; background:#f4f6f9; padding:20px; }
    h2 { color:#2c3e50; text-align:center; }
    form { width:50%; margin:0 auto; background:white; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.1); }
    label { display:block; margin:10px 0 5px; }
    input { width:100%; padding:8px; border:1px solid #ccc; border-radius:5px; }
    button { margin-top:15px; background:#27ae60; color:white; border:none; padding:10px 20px; border-radius:5px; cursor:pointer; width:100%; }
    button:hover { background:#219150; }
</style>
</head>
<body>
<h2>Formulario de Pago</h2>
<form method="POST" action="descargar_pdf.php">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    <label>Dirección:</label>
    <input type="text" name="direccion" required>
    <label>Número de Tarjeta:</label>
    <input type="text" name="tarjeta" required>
    <button type="submit">Finalizar Compra</button>
</form>
</body>
</html>
