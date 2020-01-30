<?php
	include_once 'conexion.php';

	if(isset($_GET['id'])){
		$id=(int) $_GET['id'];

		$buscar_id=$con->prepare('SELECT * FROM master_customer WHERE customer_id=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
	}else{
		header('Location: index.php');
	}


	if(isset($_POST['guardar'])){
		$name_customer=$_POST['name_customer'];
		$desc_customer=$_POST['desc_customer'];
		$requisitos=$_POST['requisitos'];
		$oferta=$_POST['oferta'];
		$puesto=$_POST['puesto'];
		$horario=$_POST['horario'];
		$direccion=$_POST['direccion'];
		$id=(int) $_GET['id'];

		if(!empty($name_customer) && !empty($desc_customer) && !empty($requisitos) && !empty($oferta) && !empty($puesto)  && !empty($horario) && !empty($direccion)){
			
				$consulta_update=$con->prepare(' UPDATE master_customer SET  
					name_customer=:name_customer,
					desc_customer=:desc_customer,
					requisitos=:requisitos,
					oferta=:oferta,
					puesto=:puesto,
					horario=:horario,
					direccion=:direccion
					WHERE customer_id=:id;'
				);
				$consulta_update->execute(array(
					':name_customer' =>$name_customer,
					':desc_customer' =>$desc_customer,
					':requisitos' =>$requisitos,
					':oferta' =>$oferta,
					':puesto' =>$puesto,
					':horario' =>$horario,
					':direccion' =>$direccion,
					':id' =>$id
				));
				header('Location: index.php');
			
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
		<h2>Editar <?php if($resultado) echo $resultado['name_customer']; ?> </h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="name_customer" value="<?php if($resultado) echo $resultado['name_customer']; ?>" class="input__text">
				<input type="text" name="desc_customer" value="<?php if($resultado) echo $resultado['desc_customer']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="requisitos" value="<?php if($resultado) echo $resultado['requisitos']; ?>" class="input__text">
				<input type="text" name="oferta" value="<?php if($resultado) echo $resultado['oferta']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="puesto" value="<?php if($resultado) echo $resultado['puesto']; ?>" class="input__text">
				<input type="text" name="horario" value="<?php if($resultado) echo $resultado['horario']; ?>" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="direccion" value="<?php if($resultado) echo $resultado['direccion']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
