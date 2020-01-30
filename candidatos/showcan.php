<?php
	include 'conexion.php';
	session_start();  
	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM perfil WHERE id_perfil=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$usuarioPost=$_POST['usuarioPost'];
		$carrera=$_POST['carrera'];
		$direccionp=$_POST['direccionp'];
		$telefono=$_POST['telefono'];
		$correo=$_POST['correo'];
		$fecha=$_POST['fecha'];
		$cambio_post=$_POST['cambio_post'];
		$id=(int) $_GET['id'];
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Editar Cliente</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2> CANDIDATO SELECCIONADO </h2>
		<form action="select.php" method="post">
			<div class="form-group">
				<input type="text" name="usuarioPost" value=" NOMBRE:  <?php if($resultado) echo $resultado['nombre']; ?>" class="input__text" readonly>
				<input type="text" name="edad" value=" EDAD: <?php if($resultado) echo $resultado['edad']; ?> AÑOS" class="input__text" readonly>
			</div>
			<div class="form-group">
				<input type="text" name="carrera" value=" CARRERA: <?php if($resultado) echo $resultado['carrera']; ?>" class="input__text" readonly>
				<input type="text" name="direccion" value="DIRECCIÓN: <?php if($resultado) echo $resultado['direccion']; ?>" class="input__text" readonly>
			</div>
			<div class="form-group">
				<input type="text" name="telefono" value=" TELÉFONO: <?php if($resultado) echo $resultado['telefono']; ?>" class="input__text" readonly>
				<input type="text" name="correo" value=" CORREO: <?php if($resultado) echo $resultado['correo']; ?>" class="input__text" readonly>
			</div>
			<div class="form-group">
				<input type="text" name="estado" value=" ESTADO: <?php if($resultado) echo $resultado['estado']; ?>" class="input__text" readonly>
				<input type="text" name="municipio" value=" MUNICIPIO: <?php if($resultado) echo $resultado['municipio']; ?>" class="input__text" readonly>
			    <input type="hidden" name="interes" value="<?php if($resultado) echo $resultado['interes']; ?>" class="input__text" readonly>
			    
			</div>
			<div class="btn__group">
			
				<input  type="submit" class="btn btn__primary" name="btn_buscar" value="Regresar">
				
			</div>
		</form>
	</div>
</body>
</html>
