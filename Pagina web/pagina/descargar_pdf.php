<?php
session_start();
require('fpdf.php');

include 'conexion.php';

// Validar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
$usuario = $_SESSION['usuario'];

// Crear PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(190,10,'Factura de Compra',0,1,'C');
$pdf->Ln(10);

// Agregar fecha y usuario
$pdf->SetFont('Arial','',12);
$pdf->Cell(190,10,'Cliente: '.$usuario,0,1,'L');
$pdf->Cell(190,10,'Fecha: '.date('d/m/Y H:i'),0,1,'L');
$pdf->Ln(5);

// Encabezados tabla
$pdf->SetFont('Arial','B',12);
$pdf->Cell(80,10,'Producto',1);
$pdf->Cell(30,10,'Precio',1);
$pdf->Cell(30,10,'Cantidad',1);
$pdf->Cell(50,10,'Subtotal',1);
$pdf->Ln();

// Consultar carrito
$stmt = $conn->prepare("
    SELECT c.id_carrito, c.id_producto, p.nombre_producto, p.precio, c.cantidad
    FROM carrito c
    JOIN (
        SELECT id_producto, nombre_producto, precio FROM autos_motos_y_otros
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM celulares_y_telefonia
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM computacion
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM deportes_y_fitness
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM electrodomesticos
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM herramientas
        UNION ALL
        SELECT id_producto, nombre_producto, precio FROM ropa_bolsas_calzado
    ) p ON c.id_producto = p.id_producto
    WHERE c.usuario = ?
");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$pdf->SetFont('Arial','',12);
while ($row = $result->fetch_assoc()) {
    $subtotal = $row['precio'] * $row['cantidad'];
    $total += $subtotal;

    $pdf->Cell(80,10,$row['nombre_producto'],1);
    $pdf->Cell(30,10,"$".$row['precio'],1);
    $pdf->Cell(30,10,$row['cantidad'],1);
    $pdf->Cell(50,10,"$".$subtotal,1);
    $pdf->Ln();
}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(140,10,'Total',1);
$pdf->Cell(50,10,"$".$total,1);

// Limpiar buffer para evitar errores de salida previa
if (ob_get_length()) {
    ob_end_clean();
}

// Descargar PDF
$pdf->Output('D','Factura.pdf');

// Vaciar carrito después de generar PDF
$conn->query("DELETE FROM carrito WHERE usuario='$usuario'");
$conn->close();
