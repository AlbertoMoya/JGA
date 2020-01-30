<?php 
     
	 session_start();  
	include_once 'conexion.php';
	
	if(isset($_POST['guardar'])){
		$name_customer=$_POST['name_customer'];
		$desc_customer=$_POST['desc_customer'];
		$requisitos=$_POST['requisitos'];
		$oferta=$_POST['oferta'];
		$puesto=$_POST['puesto'];
		$horario=$_POST['horario'];
		$direccion=$_POST['direccion'];
		$id_cliente=$_POST['id_cliente'];
		$usuario=$_POST['usuario'];
		$fecha_asignacion = date('m/d/y');
			
		$query = "INSERT INTO master_customer (name_customer,desc_customer,requisitos,oferta,puesto,horario,direccion,created_at,empresa,administrador) VALUES('$name_customer','$desc_customer','$requisitos','$oferta','$puesto','$horario','$direccion','$fecha_asignacion',$id_cliente,'$usuario')";

		if(!empty($name_customer) && !empty($desc_customer) && !empty($requisitos) && !empty($oferta) && !empty($puesto) && !empty($horario) && !empty($direccion) ){
			
				$consulta_insert=$con->prepare($query);
				$consulta_insert->execute();
				header('Location: index.php');
			
		}else{
			echo "<script> alert('Los campos estan vacios');</script>";
		}
	}

	$usuario_final = $_SESSION['Usuario'];
	$sql_Vacantes = "SELECT * FROM master_customer INNER JOIN clientes on master_customer.empresa=clientes.id_cliente  where clientes.usuario='$usuario_final' ORDER BY master_customer.customer_id ASC";
	
	$sentencia_select=$con->prepare($sql_Vacantes);
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Nueva Vacante</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<h2>NUEVA VACANTE</h2>
		<form action="" method="post">
			<div class="form-group">
				<input type="text" name="name_customer" placeholder="Nombre de la vacante" class="input__text">
				<input type="text" name="desc_customer" placeholder="Descripción" class="input__text">
			</div>
			<div class="form-group">
				<input type="text" name="requisitos" placeholder="Requisitos" class="input__text">
				<input type="text" name="oferta" placeholder="Oferta" class="input__text">
			</div>
			<div class="form-group">
			    <input type="text" name="puesto" placeholder="Puesto" class="input__text">
				<input type="text" name="horario" placeholder="Horario" class="input__text">
			</div>
			<div class="form-group">
			    <input type="text" name="direccion" placeholder="Dirección" class="input__text">	
			</div>
             
			<?php foreach($resultado as $fila):?>
				<div class="form-group">
				<input type="hidden" name="id_cliente"  class="input__text" value="<?php echo $fila['id_cliente']; ?>" >
				<input type="hidden" name="usuario"  class="input__text" value="<?php echo $fila['usuario']; ?>" >
			    </div>
			<?php endforeach ?>

			<div class="btn__group">
				<a href="index.php" class="btn btn__danger">Cancelar</a>
				<input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
			</div>
		</form>
	</div>
</body>
</html>
