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
		$mision=$_POST['mision'];
		$vision=$_POST['vision'];
		$descripcion=$_POST['descripcion'];
		$id=(int) $_GET['id'];

		if(!empty($empresa) && !empty($mision)  && !empty($vision) && !empty($descripcion)){
			
				$consulta_update=$con->prepare(' UPDATE perfil_cliente SET  
					empresa_n=:empresa_n,
					mision=:mision,
				    vision=:vision,
					descripcion=:descripcion
					WHERE id_pc=:id;'
				);
				$consulta_update->execute(array(
					':empresa_n' =>$empresa,
					':mision' =>$mision,
					':vision' =>$vision,
					':descripcion' =>$descripcion,
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
			</div>
            <div class="form-group">
				<textarea rows="10" type="text" name="descripcion" value="<?php if($resultado) echo $resultado['descripcion']; ?>" class="textarea"><?php if($resultado) echo $resultado['descripcion']; ?></textarea>
                <textarea  rows="10" type="text" name="mision" value="<?php if($resultado) echo $resultado['mision']; ?>" class="textarea"><?php if($resultado) echo $resultado['mision']; ?></textarea>
            </div>
			<div class="form-group">
				<textarea rows="10" type="text" name="vision" value="<?php if($resultado) echo $resultado['vision']; ?>" class="textarea"><?php if($resultado) echo $resultado['vision']; ?></textarea>
			</div>
			
			<div class="btn__group">
				<a href="perfil2.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>

</body>
</html>
