<?php
// Inicia la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('conexion.php');
include("barra_lateral.php");

// Eliminar un producto del carrito si se especifica
if (isset($_GET['eliminar'])) {
    $id_eliminar = $_GET['eliminar'];
    if (isset($_SESSION['carrito'][$id_eliminar])) {
        unset($_SESSION['carrito'][$id_eliminar]);
    }
}

// Redirigir de vuelta a la página de productos si se especifica
if (isset($_GET['pag'])) {
    $pagina = $_GET['pag'];
} else {
    $pagina = 1;
}

?>

<html>
<head>
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="ContenedorPrincipal">
    <h1>Carrito de Compras</h1>
    <form method="POST" action="carrito.php">
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Acción</th>
            </tr>
            <?php
            $total = 0;
            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $id_producto => $producto) {
                    $subtotal = $producto['precio'] * $producto['cantidad'];
                    $total += $subtotal;
                    echo "<tr>";
                    echo "<td>{$id_producto}</td>";
                    echo "<td>{$producto['nombre']}</td>";
                    echo "<td>{$producto['descripcion']}</td>";
                    echo "<td>{$producto['precio']}</td>";
                    echo "<td><input type='number' name='cantidad[{$id_producto}]' value='{$producto['cantidad']}' min='1'></td>";
                    echo "<td>{$subtotal}</td>";
                    echo "<td><a href='carrito.php?eliminar={$id_producto}&pag={$pagina}'>Eliminar</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>El carrito está vacío.</td></tr>";
            }
            ?>
            <tr>
                <td colspan="5" style="text-align: right;">Total:</td>
                <td><?php echo $total; ?></td>
                <td></td>
            </tr>
        </table>
        <div style="text-align: right;">
            <a href="productos_tabla.php?pag=<?php echo $pagina; ?>" class="BotonesTeam5">Continuar Comprando</a>
        </div>
    </form>
</div>
</body>
</html>
