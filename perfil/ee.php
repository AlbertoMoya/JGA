<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM perfil_cliente WHERE id_pc=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$empresa=$_POST['empresa'];
		$direccion_emp=$_POST['direccion_emp'];
		$telefono=$_POST['telefono'];
		$correo=$_POST['correo'];
		$mision=$_POST['mision'];
		$vision=$_POST['vision'];
		$descripcion=$_POST['descripcion'];
		$municipio=$_POST['municipio'];
		$estado=$_POST['estado'];
		$cp_emp=$_POST['cp_emp'];
		$id=(int) $_GET['id'];

		if(!empty($empresa) && !empty($direccion_emp) && !empty($telefono) && !empty($correo) && !empty($mision)  && !empty($vision) && !empty($descripcion) && !empty($municipio) && !empty($estado) && !empty($cp_emp)){
			
				$consulta_update=$con->prepare(' UPDATE perfil_cliente SET  
					empresa=:empresa,
					direccion_emp=:direccion_emp,
					telefono=:telefono,
					correo=:correo,
					mision=:mision,
				    vision=:vision,
					descripcion=:descripcion,
					municipio=:municipio,
					estado=:estado,
					cp_emp=:cp_emp
					WHERE id_pc=:id;'
				);
				$consulta_update->execute(array(
					':empresa' =>$empresa,
					':direccion_emp' =>$direccion_emp,
					':telefono' =>$telefono,
					':correo' =>$correo,
					':mision' =>$mision,
					':vision' =>$vision,
					':descripcion' =>$descripcion,
					':municipio' =>$municipio,
					':estado' =>$estado,
					':cp_emp' =>$cp_emp,
					':id' =>$id
				));
				header('Location: perfil2.php');
			
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">

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


</head>
<body>
	<div class="contenedor">
		<h2>Editar Perfil <?php if($resultado) echo $resultado['empresa']; ?> </h2>
		<form action="" method="post">
			<div class="form-group">
			   
				<h3>Empresa:</h3>
				<input type="text" name="empresa" value="<?php if($resultado) echo $resultado['empresa']; ?>" class="input__text">
				<h3>Descripción:</h3>
				<textarea type="text" name="descripcion" value="<?php if($resultado) echo $resultado['descripcion']; ?>" class="textarea"><?php if($resultado) echo $resultado['descripcion']; ?></textarea>
			</div>
			<div class="form-group">
			    <h3>Misión:</h3>
				<textarea type="text" name="mision" value="<?php if($resultado) echo $resultado['mision']; ?>" class="textarea"><?php if($resultado) echo $resultado['mision']; ?></textarea>
				<h3>Visión:</h3>
				<textarea type="text" name="vision" value="<?php if($resultado) echo $resultado['vision']; ?>" class="textarea"><?php if($resultado) echo $resultado['vision']; ?></textarea>
			</div>
			<div class="form-group">
				<h3>Teléfono:</h3>
				<br>
				<br>
				<input type="number" name="telefono" value="<?php if($resultado) echo $resultado['telefono']; ?>" class="input__text">
				<h3>Correo:</h3>
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo']; ?>" class="input__text">
			</div>
		
			<div class="form-group">
			    <h3>Dirección:</h3>
			    <input type="text" name="direccion_emp" value="<?php if($resultado) echo $resultado['direccion_emp']; ?>" class="input__text">
				<h3>Municipio:</h3>
				<input type="text" name="municipio" value="<?php if($resultado) echo $resultado['municipio']; ?>" class="input__text">
			</div>
			<div class="form-group">
			    <h3>Estado:</h3>
				<input type="text" name="estado" value="<?php if($resultado) echo $resultado['estado']; ?>" class="input__text">
				<h3>C.P.:</h3>
				<input type="number" name="cp_emp" value="<?php if($resultado) echo $resultado['cp_emp']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="perfil2.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>



	<!-- inicio de card  -->

	
	<section id="blog" class="bg-light">
    <div class="container">
      <div class="text-center">
        <h2 class="font-weight-bold">PERFIL <?php echo $fila['empresa']; ?> </h2>
        <p class="lead">En esta seción puedes modificar tus datos en cualquier momento</p>
      </div>
      <div class="card mt-5">
        <div class="card-body">
          <div class="row">
           
            <div class="col-md-7 col-sm-12 d-flex">
              <div class="align-self-center">
              	<form action="" method="post">
                <div class="form-group">
			   
				<h3>Empresa:</h3>
				<input type="text" name="empresa" value="<?php if($resultado) echo $resultado['empresa']; ?>">
				<h3>Descripción:</h3>
				<textarea type="text" name="descripcion" value="<?php if($resultado) echo $resultado['descripcion']; ?>" class="textarea"><?php if($resultado) echo $resultado['descripcion']; ?></textarea>
			</div>
			<div class="form-group">
			    <h3>Misión:</h3>
				<textarea type="text" name="mision" value="<?php if($resultado) echo $resultado['mision']; ?>" class="textarea"><?php if($resultado) echo $resultado['mision']; ?></textarea>
				<h3>Visión:</h3>
				<textarea type="text" name="vision" value="<?php if($resultado) echo $resultado['vision']; ?>" class="textarea"><?php if($resultado) echo $resultado['vision']; ?></textarea>
			</div>
			<div class="form-group">
				<h3>Teléfono:</h3>
				<br>
				<br>
				<input type="number" name="telefono" value="<?php if($resultado) echo $resultado['telefono']; ?>" class="input__text">
				<h3>Correo:</h3>
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo']; ?>" class="input__text">
			</div>
		
			<div class="form-group">
			    <h3>Dirección:</h3>
			    <input type="text" name="direccion_emp" value="<?php if($resultado) echo $resultado['direccion_emp']; ?>" class="input__text">
				<h3>Municipio:</h3>
				<input type="text" name="municipio" value="<?php if($resultado) echo $resultado['municipio']; ?>" class="input__text">
			</div>
			<div class="form-group">
			    <h3>Estado:</h3>
				<input type="text" name="estado" value="<?php if($resultado) echo $resultado['estado']; ?>" class="input__text">
				<h3>C.P.:</h3>
				<input type="number" name="cp_emp" value="<?php if($resultado) echo $resultado['cp_emp']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="perfil2.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			   </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>


     


    </div>
  </section>

  
  

  

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
