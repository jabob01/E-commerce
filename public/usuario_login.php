<?php
session_start();
include('conexion.php');

$correo = $_POST["txtcorreo"];
$pass   = $_POST["txtpassword"];

$buscandousu = mysqli_query($conn,"SELECT * FROM usuarios WHERE correo = '".$correo."' and pass = '".$pass."'");
$nr = mysqli_num_rows($buscandousu);

if($nr == 1)
{
    $_SESSION['usuarioingresando']=$correo;
    echo "<script>alert('Inicio de sesión exitoso'); window.location= 'inicio.html';</script>";
}
else if ($nr == 0) 
{
    echo "<script> alert('Usuario no existe'); window.location= 'index.php' </script>";
}
?>
