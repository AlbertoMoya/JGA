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
		$empresa=$_POST['empresa_n'];
		$direccion_emp=$_POST['direccion_emp'];
		$telefono=$_POST['telefono'];
		$correo=$_POST['correo'];
		$municipio=$_POST['municipio'];
		$estado=$_POST['estado'];
		$cp_emp=$_POST['cp_emp'];
		$id=(int) $_GET['id'];

		if(!empty($empresa) && !empty($direccion_emp) && !empty($telefono) && !empty($correo) && !empty($municipio) && !empty($estado) && !empty($cp_emp)){
			
				$consulta_update=$con->prepare(' UPDATE perfil_cliente SET  
					empresa_n=:empresa_n,
					direccion_emp=:direccion_emp,
					telefono=:telefono,
					correo=:correo,
					municipio=:municipio,
					estado=:estado,
					cp_emp=:cp_emp
					WHERE id_pc=:id;'
				);
				$consulta_update->execute(array(
					':empresa_n' =>$empresa,
					':direccion_emp' =>$direccion_emp,
					':telefono' =>$telefono,
					':correo' =>$correo,
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
</head>

<body>
	<div class="contenedor">
		<h2>Editar Perfil <?php if($resultado) echo $resultado['empresa_n']; ?> </h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="empresa_n" value="<?php if($resultado) echo $resultado['empresa_n']; ?>" class="input__text">
				
				<input type="number" name="telefono" value="<?php if($resultado) echo $resultado['telefono']; ?>" class="input__text">
			</div>
			
			<div class="form-group">
				<input type="text" name="correo" value="<?php if($resultado) echo $resultado['correo']; ?>" class="input__text">
			    <input type="text" name="direccion_emp" value="<?php if($resultado) echo $resultado['direccion_emp']; ?>" class="input__text">
			
            </div>
		
			<div class="form-group">
				<input type="text" name="municipio" value="<?php if($resultado) echo $resultado['municipio']; ?>" class="input__text">
                <input type="text" name="estado" value="<?php if($resultado) echo $resultado['estado']; ?>" class="input__text">
			
            </div>
			<div class="form-group">
				<input type="number" name="cp_emp" value="<?php if($resultado) echo $resultado['cp_emp']; ?>" class="input__text">
			</div>
			<div class="btn__group">
				<a href="perfil2.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>

</body>
</html>
