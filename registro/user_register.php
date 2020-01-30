<?php

include_once 'conexion.php';

if(isset($_GET['emp'])){
    $empresa=(string) $_GET['emp'];

    $buscar_emp=$con->prepare('SELECT * FROM perfil_cliente WHERE empresa_n=:emp LIMIT 1');
    $buscar_emp->execute(array(
        ':emp'=>$empresa
    ));
    $resultado=$buscar_emp->fetch();
}else{
    header('Location: index.php');
}







if(isset($_POST['guardar'])){
    $name_customer=$_POST['name_customer'];

    $user=$_POST['user'];
    $pass=$_POST['pass'];
    $Cliente=$_POST['Cliente'];
    $id_cliente=$_POST['id_cliente'];
    $empresa=(string) $_GET['empresa'];
   

    $query = "INSERT INTO clientes (id_cliente, usuario, pass, Cliente) VALUES('$id_cliente', '$user', '$pass', '$Cliente')";

    if(!empty($user) && !empty($pass) && !empty($Cliente)){
        
            $consulta_insert=$con->prepare($query);
            $consulta_insert->execute();
            header('Location: ../log2/index.php');
        
    }else{
        echo "<script> alert('Favor de llenar todos los campos');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">




</head>
<body>

<h2 style="text-align:center">Crea tu usuario y contraseña</h2>

<div class="card">
  <center>
  <img src="L1.png" alt="Avatar" style="width:30%">
  </center>
  
  <div class="container">
    <h4><b>REGISTRO DE ADMINISTRADOR</b></h4> 
    <p>Llena los datos de tu administrador.</p> 

<form action="" method="post">

<h2>CUENTA:</h2>

  <label for="fname">Usuario:</label>
  <input type="text" id="fname" name="user">
  <label for="fname">Contraseña:</label>
  <input type="password" id="fname" name="pass">
  <input type="text" name="Cliente" value="<?php if($resultado) echo $resultado['empresa_n']; ?>" class="input__text" readonly>
  <input type="text" name="id_cliente" value="<?php if($resultado) echo $resultado['id_pc']; ?>" class="input__text" readonly>
   
  
  <input type="submit" name="guardar" value="Guardar">

</form>





     <br>
     <br>

  </div>
</div>

</body>
</html>