<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM postulados WHERE id_postulado=:id LIMIT 1');
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


		if(!empty($usuarioPost) && !empty($carrera) && !empty($direccionp) && !empty($telefono) && !empty($correo)  && !empty($fecha) && !empty($cambio_post)){
			
				$consulta_update=$con->prepare(' UPDATE postulados SET  
					status_post=:cambio_post
					WHERE id_postulado=:id;'
				);
				$consulta_update->execute(array(
					':cambio_post' =>$cambio_post,
					':id' =>$id
				));
				$validar="¡USUARIO AGENDADO! el usuario ha sido avisado del interés que tienes por su perfil, estará al pendiente de tu llamado.";
				echo '<script>alert("'.$validar.'");</script>';
					 print "<script>window.location='index.php';</script>";
			
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
</head>
<body>
	<div class="contenedor">
		<h2><?php if($resultado) echo $resultado['name_vacante']; ?> </h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="usuarioPost" value=" NOMBRE:  <?php if($resultado) echo $resultado['usuarioPost']; ?>" class="input__text" readonly>
				<input type="text" name="edad" value=" EDAD: <?php if($resultado) echo $resultado['edad']; ?> AÑOS" class="input__text" readonly>
			</div>
			<div class="form-group">
				<input type="text" name="carrera" value=" CARRERA: <?php if($resultado) echo $resultado['carrera']; ?>" class="input__text" readonly>
				<input type="text" name="direccionp" value="DIRECCIÓN: <?php if($resultado) echo $resultado['direccionp']; ?>" class="input__text" readonly>
			</div>
			<div class="form-group">
				<input type="text" name="telefono" value=" TELÉFONO: <?php if($resultado) echo $resultado['telefono']; ?>" class="input__text" readonly>
				<input type="text" name="correo" value=" CORREO: <?php if($resultado) echo $resultado['correo']; ?>" class="input__text" readonly>
			</div>
			<div class="form-group">
				<input type="text" name="fecha" value=" FECHA DE POSTULACIÓN: <?php if($resultado) echo $resultado['fecha']; ?>" class="input__text" readonly>
				<input type="text" name="status_post" value=" STATUS DE POSTULACIÓN: <?php if($resultado) echo $resultado['status_post']; ?>" class="input__text" readonly>
			    <input type="hidden" name="cambio_post" value="Visto" class="input__text" readonly>
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<?php  if($resultado){
				  if($resultado['status_post'] =="Activo"){ ?>
					<input type="submit" name="guardar" value="AGENDAR CANDIDATO" class="btn btn__primary">
			   <?php } else{ ?>
				<input type="text" value="CANDIDATO AGENDADO" class="btn btn__primary2">
			  <?php }
			     } ?>
				
			</div>
		</form>
	</div>
</body>
</html>
