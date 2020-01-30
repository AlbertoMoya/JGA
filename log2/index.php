<?php  session_start();  ?>
<!DOCTYPE html>
<html lang="es">
   <head>
       
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
       <link rel="stylesheet" href="estilos.css">
   </head>
   <body>
       <form action="validar.php" method="POST">
           <center>
           <img alt="JGA" style="width: 380px; height: 260px; text-align: center;" src="L1.png" class="align-right"/>
           </center>
      
           <h2>INGRESA A TU PERFIL</h2>
           <input type="text" placeholder="Nombre" name="Usuario" required>
           <input type="password" placeholder="Contraseña" name="Clave" required>
           <input type="submit" value="Ingresar">
           <br>
           <br>
           <a href="../registro/registro.php" type="submit">REGISTRATE</a>
       </form>
   </body>
</html>

