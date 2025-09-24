<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Encriptar la contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Insertar el usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nombre, $email, $password_hash);

    if ($stmt->execute()) {
        echo "<script>alert('¡Registro exitoso! Ahora puedes iniciar sesión.'); window.location.href = 'login.php';</script>";
        exit;
    } else {
        $error = "Error al registrar el usuario. Puede que el correo ya esté registrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #84fab0, #8fd3f4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .container h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .container button {
            background-color: #84fab0;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }
        .container button:hover {
            background-color: #8fd3f4;
        }
        .container a {
            color: #84fab0;
            text-decoration: none;
            font-size: 14px;
        }
        .container a:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form action="register.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre Completo" required>
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
