<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('conexion.php');
if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array();
    }

    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += 1;
    } else {
        $result = mysqli_query($conn, "SELECT * FROM productos WHERE id = $producto_id");
        if (mysqli_num_rows($result) > 0) {
            $producto = mysqli_fetch_assoc($result);
            $_SESSION['carrito'][$producto_id] = array(
                "id" => $producto['id'],
                "nombre" => $producto['nombre'],
                "descripcion" => $producto['descripcion'],
                "precio" => $producto['precio'],
                "cantidad" => 1
            );
        }
    }

    $_SESSION['mensaje'] = "Producto agregado al carrito con éxito.";
}

header("Location: productos_tabla.php");
exit();
?>


