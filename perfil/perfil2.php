<?php
    include '../header/header.php';
    session_start();  
	include_once 'conexion.php';
	$usuario_final = $_SESSION['Usuario'];
	$sql_Vacantes = "SELECT * FROM perfil_cliente INNER JOIN clientes on perfil_cliente.id_pc = clientes.id_cliente  where clientes.usuario='$usuario_final'";
	
	$sentencia_select=$con->prepare($sql_Vacantes);
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
  <!-- Styles -->
  <link rel="stylesheet" href="css2/style.css">

  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500|Titillium+Web:700&display=swap" rel="stylesheet">

  <!-- Ionic icons -->
  <link href="https://unpkg.com/ionicons@4.5.5/dist/css/ionicons.min.css" rel="stylesheet">

  <title>JGAAPP</title>
</head>

<body>
    
<?php foreach($resultado as $fila):?>

  <section id="blog" class="bg-light">
    <div class="container">
      <div class="text-center">
        <h2 class="font-weight-bold">PERFIL <?php echo $fila['empresa_n']; ?> </h2>
        <p class="lead">En esta seción puedes modificar tus datos en cualquier momento</p>
      </div>
      <div class="card mt-5">
        <div class="card-body">
          <div class="row">
            <div class="col-md-5 col-sm-12">
              
              <p></p>
              <br> <br> <br> <br> 
              <img src="<?php echo $fila['imagen']; ?>" class="img-fluid rounded" alt="blog image, image from Unsplash">
              <br>
              <p></p>
              
            </div>
            <div class="col-md-7 col-sm-12 d-flex">
              <div class="align-self-center">
                <h4 class="font-weight-bold mt-2">EMPRESA <?php echo $fila['empresa_n']; ?> </h4>
                <p class="mt-4">Descripción: <br> <?php echo $fila['descripcion']; ?> </p>
                <p class="mt-4">Misión: <br> <?php echo $fila['mision']; ?> </p>
                <p class="mt-4">Visión: <br> <?php echo $fila['vision']; ?> </p>
                <a class="text-primary font-weight-bold" href="update_perfil.php?id=<?php echo $fila['id_pc']; ?>">Modificar<i
                    class="icon ion-md-arrow-dropright-circle text-primary align-middle"></i></a>
                    
              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="card mt-5">
        <div class="card-body">
          <div class="row">
            <div class="col-md-5 col-sm-12">
            <p></p>
              <br> <br> <br> <br> 
              <img src="<?php echo $fila['imagen']; ?>" class="img-fluid rounded" alt="blog image, image from Unsplash">
              <br>
              <p></p>
            </div>
            <div class="col-md-7 col-sm-12 d-flex">
              <div class="align-self-center">
                <h4 class="font-weight-bold mt-2">CONTACTO <?php echo $fila['empresa_n']; ?> </h4>
                
                <p class="mt-4">Teléfono: <br> <?php echo $fila['telefono']; ?> </p>
                <p class="mt-4">Correo: <br> <?php echo $fila['correo']; ?> </p>
                <p class="mt-4">Dirección: <br> <?php echo $fila['direccion_emp']; ?> </p>
                <p class="mt-4">Municipio: <br> <?php echo $fila['municipio']; ?> </p>
                <p class="mt-4">Estado: <br> <?php echo $fila['estado']; ?> </p>
                <p class="mt-4">Código Postal: <br> <?php echo $fila['cp_emp']; ?> </p>
               
                <a class="text-primary font-weight-bold" href="update_contacto.php?id=<?php echo $fila['id_pc']; ?>">Modificar<i
                   class="icon ion-md-arrow-dropright-circle text-primary align-middle"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>
  </section>

  <?php endforeach ?>

  

  

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>