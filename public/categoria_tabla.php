<?php
include('conexion.php');
include("barra_lateral.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>E-COMMERCE</title>
</head>
<body>
<div class="ContenedorPrincipal">	
    <?php
    $filasmax = 7;
    if (isset($_GET['pag'])) {
        $pagina = $_GET['pag'];
    } else {
        $pagina = 1;
    }

    if (isset($_POST['btnbuscar'])) {
        $buscar = $_POST['txtbuscar'];
        $sqlcat = mysqli_query($conn, "SELECT * FROM categoria_productos WHERE nombre = '$buscar'");
    } else {
        $sqlcat = mysqli_query($conn, "SELECT * FROM categoria_productos ORDER BY id ASC LIMIT " . (($pagina - 1) * $filasmax)  . ", " . $filasmax);
    }

    $resultadoMaximo = mysqli_query($conn, "SELECT count(*) as num_categorias FROM categoria_productos");
    $maxusutabla = mysqli_fetch_assoc($resultadoMaximo)['num_categorias'];
    ?>
    <div class="ContenedorTabla">
        <form method="POST">
            <h1>Lista de categorías</h1>
            <div class="ContBuscar">
                <div style="float: left;">
                    <a href="categoria_tabla.php" class="BotonesTeam">Inicio</a>
                    <input class="BotonesTeam" type="submit" value="Buscar" name="btnbuscar">
                    <input class="CajaTextoBuscar" type="text" name="txtbuscar" placeholder="Ingresar categoría" autocomplete="off">
                </div>
                <div style="float: right;">
                    <a class="BotonesTeam5" href="categoria_registrar.php?pag=<?= $pagina ?>">Agregar categoria</a>
                    <a class="BotonesTeam5" href="mostrar_carrito.php">Ver Carrito</a>
                </div>
            </div>
        </form>
        <table>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Acción</th>
            </tr>
            <?php while ($mostrar = mysqli_fetch_assoc($sqlcat)): ?>
                <tr>
                    <td><?= $mostrar['id'] ?></td>
                    <td><?= $mostrar['nombre'] ?></td>
                    <td style="width: 24%">
                        <a class='BotonesTeam1' href="categoria_ver.php?categoria=<?= $mostrar['id'] ?>&pag=<?= $pagina ?>">&#x1F50D;</a>
                        <a class='BotonesTeam2' href="categoria_modificar.php?categoria=<?= $mostrar['id'] ?>&pag=<?= $pagina ?>">&#128397;</a>
                        <a class='BotonesTeam3' href="categoria_eliminar.php?categoria=<?= $mostrar['id'] ?>&pag=<?= $pagina ?>" onClick="return confirm('¿Estás seguro de eliminar la categoría <?= $mostrar['nombre'] ?>?')">&#10006;</a>
                        <a class='BotonesTeam4' href="productos_registrar.php?pag=<?= $pagina ?>">Agregar producto &#128397;</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <div style="text-align: right;">
            <br>
            <?php echo "Total de categorías: $maxusutabla"; ?>
        </div>
    </div>
    <div style="text-align: center;">
        <?php if ($pagina > 1): ?>
            <a class="BotonesTeam4" href="categoria_tabla.php?pag=<?= $pagina - 1 ?>">Anterior</a>
        <?php else: ?>
            <a class="BotonesTeam4" href="#" style="pointer-events: none">Anterior</a>
        <?php endif; ?>

        <?php if (($pagina * $filasmax) < $maxusutabla): ?>
            <a class="BotonesTeam4" href="categoria_tabla.php?pag=<?= $pagina + 1 ?>">Siguiente</a>
        <?php else: ?>
            <a class="BotonesTeam4" href="#" style="pointer-events: none">Siguiente</a>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
