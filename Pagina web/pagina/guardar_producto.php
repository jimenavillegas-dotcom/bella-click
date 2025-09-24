<?php
include 'conexion.php';

// Recibir los datos del formulario
$nombre_producto = $_POST['nombre_producto'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];
$categoria_id = $_POST['categoria'];

// Procesar la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
    $nombre_archivo = $_FILES['imagen']['name'];
    $temporal = $_FILES['imagen']['tmp_name'];
    $carpeta_destino = "img/productos/";

    // Asegurarse que la carpeta exista
    if (!is_dir($carpeta_destino)) {
        mkdir($carpeta_destino, 0777, true);
    }

    // Generar un nombre único para evitar sobrescribir archivos
    $nuevo_nombre = time() . "_" . $nombre_archivo;
    move_uploaded_file($temporal, $carpeta_destino . $nuevo_nombre);
} else {
    $nuevo_nombre = null; // Si no se subió imagen
}

// Determinar la tabla según categoría
switch ($categoria_id) {
    case 1: $tabla_producto = 'autos_motos_y_otros'; break;
    case 2: $tabla_producto = 'celulares_y_telefonia'; break;
    case 3: $tabla_producto = 'electrodomesticos'; break;
    case 4: $tabla_producto = 'herramientas'; break;
    case 5: $tabla_producto = 'ropa_bolsas_calzado'; break;
    case 6: $tabla_producto = 'deportes_y_fitness'; break;
    case 7: $tabla_producto = 'computacion'; break;
    default: die('Categoría no válida');
}

// Insertar el producto en la tabla correspondiente, incluyendo la imagen
$query = "INSERT INTO $tabla_producto (nombre_producto, descripcion, precio, cantidad, categoria_id, imagen) 
          VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssdiss", $nombre_producto, $descripcion, $precio, $cantidad, $categoria_id, $nuevo_nombre);

// Ejecutar la consulta
if ($stmt->execute()) {
    header('Location: productos.php');
    exit();
} else {
    echo "Error al agregar el producto: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
