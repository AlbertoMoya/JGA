<?php


$conexion=mysqli_connect("localhost", "root", "", "db_crudionic3");
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

$usuario_final = $_SESSION['Usuario'];

 $sql="SELECT * FROM clientes WHERE usuario='$usuario_final'";

 $sql_Vacantes = "SELECT * FROM master_customer INNER JOIN clientes on master_customer.empresa=clientes.id_cliente  where clientes.usuario='$usuario_final' ORDER BY master_customer.customer_id DESC";
                    

