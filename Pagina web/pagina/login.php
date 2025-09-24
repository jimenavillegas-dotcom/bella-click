<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['usuario'] = $user['nombre'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "El correo electrónico no está registrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar Sesión Mágico</title>
<style>
body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: radial-gradient(circle at top left, #ffd6e8, #ffe6f7, #fff0fb);
    overflow: hidden;
    position: relative;
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

/* Contenedor login */
.login-container {
    position: relative;
    background: #ffffffcc;
    padding: 50px 30px;
    border-radius: 25px;
    box-shadow: 0 15px 30px rgba(255,182,193,0.4);
    max-width: 400px;
    width: 100%;
    text-align: center;
    z-index: 1;
    overflow: hidden;
}

/* Encabezado */
.login-container h2 {
    margin-bottom: 25px;
    font-size: 28px;
    color: #ff4da6;
    text-shadow: 2px 2px 5px rgba(255,111,177,0.5);
}

/* Formulario */
.login-container form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}
.login-container input {
    padding: 14px;
    font-size: 15px;
    border: none;
    border-radius: 12px;
    outline: none;
    background: #ffe6f2;
    transition: all 0.3s ease;
}
.login-container input:focus {
    box-shadow: 0 0 12px #ff99cc;
    transform: scale(1.05);
}

/* Botón */
.login-container button {
    background: linear-gradient(135deg, #ff6fb1, #ff85c1);
    color: white;
    padding: 14px;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}
.login-container button:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 10px 20px rgba(255,111,177,0.5);
}

/* Mensaje de error */
.error-message {
    color: #ff1a75;
    font-size: 14px;
    font-weight: bold;
}

/* Links */
.login-container p {
    font-size: 14px;
}
.login-container a {
    color: #ff4da6;
    font-weight: bold;
    text-decoration: none;
}
.login-container a:hover {
    text-decoration: underline;
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

<div class="login-container">
    <h2>Iniciar Sesión Mágico</h2>
    <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Correo Electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
    <p>¿Eres administrador? <a href="admin1.php">Entra aquí</a></p>
</div>

</body>
</html>
