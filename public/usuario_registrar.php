<?php
include('conexion.php');

// Recibir datos del formulario
$nombre = $_POST["txtnombre1"];
$correo = $_POST["txtcorreo1"];
$pass   = $_POST["txtpassword1"];

// Validar formato del correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Correo no válido, por favor ingresa un correo correcto');window.location='index.php';</script>";
    exit();
}

// Verificar si el correo ya existe
$verificarCorreo = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo = '$correo'");
if (mysqli_num_rows($verificarCorreo) > 0) {
    echo "<script>alert('Correo duplicado, intenta con otro correo');window.location='index.php';</script>";
    exit();
}

// Verificar si el nombre de usuario ya existe
$verificarNombre = mysqli_query($conn, "SELECT * FROM usuarios WHERE nom = '$nombre'");
if (mysqli_num_rows($verificarNombre) > 0) {
    echo "<script>alert('Nombre de usuario duplicado, intenta con otro nombre');window.location='index.php';</script>";
    exit();
}

// Insertar nuevo usuario
$insertarusu = mysqli_query($conn, "INSERT INTO usuarios(nom, correo, pass) VALUES ('$nombre', '$correo', '$pass')");
if (!$insertarusu) {
    echo "<script>alert('Error al registrar usuario');window.location='index.php';</script>";
} else {
    echo "<script>alert('Usuario registrado con éxito: $nombre');window.location='index.php';</script>";
}
?>
