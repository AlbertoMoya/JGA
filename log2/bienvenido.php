<?php
 session_start();

 include 'conexion.php';
 
 $result = $conexion->query($sql);
 if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $id = $row['id'];
         $Cliente = $row['Cliente'];
 
?>


<!DOCTYPE html>
<html lang="es">
   <head>
       
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
       <link rel="stylesheet" href="estilos.css">
   </head>
   <body>
       <h1>BIENVENID@ <?php echo $_SESSION['Usuario'] ?> </h1>
          <br>
          <p><?php echo $Cliente ?></p>
          <br>
          <br>
       <a href="logout.php" >Cerrar sesión</a>
   </body>
</html>

     <?php }
     } ?>

