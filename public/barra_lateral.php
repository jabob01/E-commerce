<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include('conexion.php');
if(isset($_SESSION['usuarioingresando']))
{
    $usuarioingresado = $_SESSION['usuarioingresando'];
    $buscandousu = mysqli_query($conn,"SELECT * FROM usuarios WHERE correo = '".$usuarioingresado."'");
    $mostrar=mysqli_fetch_array($buscandousu);
} else {
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>E-COMMERCE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/styles.css">
  <link href="./css/tailwind.css" rel="stylesheet">
</head>
<body>
  <div class="BarraLateral bg-gray-200 p-4">
    <ul>
      <li><a href="inicio.html" class="block py-2 border-b border-gray-300">• Inicio</a></li>
      <li><a href="productos_tabla.php" class="block py-2 border-b border-gray-300">• Productos</a></li>
      <li><a href="categoria_tabla.php" class="block py-2 border-b border-gray-300">• Categoría</a></li>
      <li><a href="cerrar_sesion.php" class="block py-2">• Cerrar sesión</a></li>
    </ul>
  </div>
</body>
</html>

