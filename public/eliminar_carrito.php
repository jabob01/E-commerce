<?php
session_start();
if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    if (isset($_SESSION['carrito'][$producto_id])) {
        unset($_SESSION['carrito'][$producto_id]);
    }
}

// Redirigimos de vuelta al carrito
header("Location: mostrar_carrito.php");
exit();
?>

