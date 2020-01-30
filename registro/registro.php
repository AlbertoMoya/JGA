<?php

include_once 'conexion.php';

if(isset($_POST['guardar'])){
    $name_customer=$_POST['name_customer'];
    $desc_customer=$_POST['desc_customer'];
    $mision=$_POST['mision'];
    $vision=$_POST['vision'];
    $telefono=$_POST['telefono'];
    $correo=$_POST['correo'];
    $direccion_emp=$_POST['direccion_emp'];
    $estado=$_POST['estado'];
    $municipio=$_POST['municipio'];
    $cp_emp=$_POST['cp_emp'];
    $fecha_creacion = date('m/d/y');
    
    $nombreimg=$_FILES['imagen']['name']; //Obtiene el nombre del archivo
    $archivo=$_FILES['imagen']['tmp_name']; //Obtiene el archivo
    
    $ruta="images"; //nombre de la carpeta
    $ruta="../".$ruta."/".$nombreimg; // Obtengo la ruta donde se guardará el archivo

    move_uploaded_file($archivo,$ruta); //muevo el archivo a la capeta images

    $query = "INSERT INTO perfil_cliente (empresa_n, direccion_emp, telefono, correo, mision, vision, descripcion, municipio, estado, cp_emp, imagen) VALUES('$name_customer', '$direccion_emp', '$telefono', '$correo', '$mision', '$vision', '$desc_customer', '$municipio', '$estado', '$cp_emp', '$ruta')";

           
            $consulta_insert=$con->prepare($query);
            $consulta_insert->execute();
           
           header('Location: user_register.php?emp='.$name_customer);

    ?>

        
   <?php
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">



</head>
<body>

<h2 style="text-align:center">Regístrate con nosotros</h2>

<div class="card">
  <center>
  <img src="L1.png" alt="Avatar" style="width:30%">
  </center>
  
  <div class="container">
    <h4><b>REGISTRO</b></h4> 
    <p>Llena los datos de tu perfil</p> 

<form action="" method="post" enctype="multipart/form-data">

  <label for="fname">Nombre de la empresa:</label>
  <input type="text" id="fname" name="name_customer" required>
  <label for="lname">Descripción:</label>
  <textarea rows="5" type="text" id="lname" name="desc_customer" required></textarea>
  <label for="lname">Misión:</label>
  <textarea rows="5" type="text" id="lname" name="mision" required></textarea>
  <label for="lname">Visión:</label>
  <textarea rows="5" type="text" id="lname" name="vision" required></textarea>
  <label for="lname">Subir imagen de la empresa</label> <br>
  <input type="file" name="imagen" required>
    
  <h2>CONTACTO:</h2>
  <label for="lname">Teléfono:</label>
  <input type="number" id="lname" name="telefono" required>
  <label for="lname">Correo:</label>
  <input type="text" id="lname" name="correo" required>
  <label for="lname">Dirección:</label>
  <input type="text" id="lname" name="direccion_emp" required>
  <label for="lname">Estado:</label>
  <input type="text" id="lname" name="estado" required>
  <label for="lname">Municipio:</label>
  <input type="text" id="lname" name="municipio" required>
  <label for="lname">Código Postal:</label>
  <input type="number" id="lname" name="cp_emp" required>




  <input type="submit" name="guardar" value="Guardar">

</form>


     <br>
     <br>

  </div>
</div>

</body>
</html>