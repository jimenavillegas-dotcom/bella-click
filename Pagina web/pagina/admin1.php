<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar en la tabla admin1
    $query = "SELECT * FROM admin1 WHERE email_admin = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($password, $admin['password_admin'])) {
            // Crear sesión y redirigir
            $_SESSION['admin1'] = $admin['nombre_admin'];
            header("Location: eliminar.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El correo electrónico no está registrado como administrador.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Admin1</title>
    <style>
        /* Estilo base */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to bottom right, #ec8fe5ff, #f1adeeff);
        }

        .admin1-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .admin1-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333333;
        }

        .admin1-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .admin1-container input {
            padding: 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s ease;
        }

        .admin1-container input:focus {
            border-color: #dc36c6ff;
            box-shadow: 0 0 5px rgba(199, 33, 250, 0.5);
        }

        .admin1-container button {
            background: #b224ebff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .admin1-container button:hover {
            background: #c82fd6ff;
        }

        .admin1-container p {
            font-size: 14px;
            margin-top: 10px;
        }

        .admin1-container a {
            color: #e73dd9ff;
            text-decoration: none;
            font-weight: bold;
        }

        .admin1-container a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #ff4a4a;
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* Responsivo */
        @media (max-width: 480px) {
            .admin1-container {
                padding: 20px;
            }

            .admin1-container h2 {
                font-size: 20px;
            }

            .admin1-container button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="admin1-container">
        <h2>Iniciar Sesión - Admin1</h2>
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
        <form action="admin1.php" method="POST">
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p><a href="index.php">Volver al inicio</a></p>
    </div>
</body>
</html>
