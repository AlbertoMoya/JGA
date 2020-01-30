<?php
include 'conexion.php';

$usuarioAD=$_POST['Usuario'];
$clave=$_POST['Clave'];

$usuario=$usuarioAD;

session_start();
$_SESSION['Usuario']=$usuario;

//Conectar a la base de datos

$consulta="SELECT * FROM clientes WHERE usuario='$usuario' and pass='$clave'";
$resultado=mysqli_query($conexion, $consulta);

$filas=mysqli_num_rows($resultado);

if($filas>0){
    header("location:../contenido/contenido.php");
}else{
    $incorrecto="Usuario o contraseña incorrecta... Verifique por favor";
    echo '<script>alert("'.$incorrecto.'");</script>';
         print "<script>window.location='index.php';</script>";
}
mysqli_free_result($resultado);
mysqli_close($conexion);

$usuario_final = $_SESSION['Usuario'];

 $sql="SELECT * FROM clientes WHERE usuario='$usuario_final'";


?>