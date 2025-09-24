<?php
session_start();
include 'conexion.php';
$usuario = $_SESSION['usuario'] ?? '';

// Obtener productos del carrito con la tabla de origen
$stmt = $conn->prepare("
    SELECT c.id_carrito, c.id_producto, p.nombre_producto, p.precio, c.cantidad, p.cantidad AS stock, p.tabla_origen
    FROM carrito c
    JOIN (
        SELECT id_producto, nombre_producto, precio, cantidad, 'autos_motos_y_otros' AS tabla_origen FROM autos_motos_y_otros
        UNION ALL
        SELECT id_producto, nombre_producto, precio, cantidad, 'celulares_y_telefonia' FROM celulares_y_telefonia
        UNION ALL
        SELECT id_producto, nombre_producto, precio, cantidad, 'computacion' FROM computacion
        UNION ALL
        SELECT id_producto, nombre_producto, precio, cantidad, 'deportes_y_fitness' FROM deportes_y_fitness
        UNION ALL
        SELECT id_producto, nombre_producto, precio, cantidad, 'electrodomesticos' FROM electrodomesticos
        UNION ALL
        SELECT id_producto, nombre_producto, precio, cantidad, 'herramientas' FROM herramientas
        UNION ALL
        SELECT id_producto, nombre_producto, precio, cantidad, 'ropa_bolsas_calzado' FROM ropa_bolsas_calzado
    ) p ON c.id_producto = p.id_producto
    WHERE c.usuario = ?
");

$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

// Comenzar transacción
$conn->begin_transaction();
$todoOk = true;

while ($row = $result->fetch_assoc()) {
    // Verificar stock suficiente
    if ($row['cantidad'] > $row['stock']) {
        $todoOk = false;
        break;
    }

    // Restar del stock
    $new_stock = $row['stock'] - $row['cantidad'];
    $tabla = $row['tabla_origen'];
    $upd = $conn->prepare("UPDATE $tabla SET cantidad = ? WHERE id_producto = ?");
    $upd->bind_param("ii", $new_stock, $row['id_producto']);
    if(!$upd->execute()) $todoOk = false;
    $upd->close();

    // Eliminar del carrito
    $del = $conn->prepare("DELETE FROM carrito WHERE id_carrito = ?");
    $del->bind_param("i", $row['id_carrito']);
    if(!$del->execute()) $todoOk = false;
    $del->close();
}

if($todoOk){
    $conn->commit();
    $msg = "Pago realizado con éxito!";
} else {
    $conn->rollback();
    $msg = "Error: no se pudo completar el pago.";
}

$conn->close();

// Redirigir a factura.php con mensaje
header("Location: factura.php?msg=" . urlencode($msg));
exit;
?>
