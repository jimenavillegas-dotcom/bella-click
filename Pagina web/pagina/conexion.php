<?php
$servidor = "localhost"; // O la IP de tu servidor
$usuario = "root";       // Tu usuario de MySQL
$contraseña = "";        // Tu contraseña de MySQL
$base_de_datos = "mercado_libre"; // El nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_de_datos);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} else {
    echo "";
}
?>
