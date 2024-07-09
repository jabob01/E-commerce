<?php
session_start();
include('barra_lateral.php');
?>
<html>
<title>Carrito de Compras</title>
<body>
<div class="ContenedorPrincipal">
    <h1>Carrito de Compras</h1>

    <?php
    if (isset($_SESSION['mensaje'])) {
        echo "<p style='color: green;'>".$_SESSION['mensaje']."</p>";
        unset($_SESSION['mensaje']);
    }

    if (!empty($_SESSION['carrito'])) {
        $total = 0;
    ?>
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
            foreach ($_SESSION['carrito'] as $producto) {
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;

                echo "<tr>";
                echo "<td>".$producto['id']."</td>";
                echo "<td>".$producto['nombre']."</td>";
                echo "<td>".$producto['descripcion']."</td>";
                echo "<td>".$producto['precio']."</td>";
                echo "<td>".$producto['cantidad']."</td>";
                echo "<td>".$subtotal."</td>";
                echo "<td><a href='eliminar_carrito.php?id=".$producto['id']."'>Eliminar</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <h2>Total: <?php echo $total; ?></h2>
        <br>
        <a class='BotonesTeam5' href="productos_tabla.php">Seguir comprando</a>
    <?php
    } else {
        echo "<p>El carrito está vacío.</p>";
        echo "<a href='productos_tabla.php'>Ir a productos</a>";
    }
    ?>
</div>
</body>
</html>


