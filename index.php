<?php
    include '../header/header.php';
    session_start();  
	include_once 'conexion.php';
	$usuario_final = $_SESSION['Usuario'];
	$sql_Vacantes = "SELECT * FROM master_customer INNER JOIN clientes on master_customer.empresa=clientes.id_cliente INNER JOIN perfil_cliente ON master_customer.empresa=perfil_cliente.id_pc where clientes.usuario='$usuario_final' ORDER BY master_customer.customer_id ASC";
	
	$sentencia_select=$con->prepare($sql_Vacantes);
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	
	$sql_Buscar = "SELECT * FROM master_customer INNER JOIN clientes on master_customer.empresa=clientes.id_cliente INNER JOIN perfil_cliente ON master_customer.empresa=perfil_cliente.id_pc WHERE name_customer LIKE :campo and clientes.usuario='$usuario_final' ORDER BY master_customer.customer_id ASC";

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare($sql_Buscar);
		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Inicio</title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
	    <br>
		<br>
		<br>
		<h3>VACANTES</h3>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="BUSCAR VACANTE" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
				<a href="insert.php" class="btn btn__nuevo">Nuevo</a>
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>Vacante</td>
				<td>Descripcion</td>
				<td>Fecha</td>
				<td>Requisitos</td>
				<td>Empresa</td>
				<td>Administrador</td>
				<td>Oferta</td>
				<td>Puesto</td>
				<td>Horario</td>
				<td>Dirección</td>
				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr>
					<td><?php echo $fila['customer_id']; ?></td>
					<td><?php echo $fila['name_customer']; ?></td>
					<td><?php echo $fila['desc_customer']; ?></td>
					<td><?php echo $fila['created_at']; ?></td>
					<td><?php echo $fila['requisitos']; ?></td>
					<td><?php echo $fila['empresa_n']; ?></td>
					<td><?php echo $fila['administrador']; ?></td>
					<td><?php echo $fila['oferta']; ?></td>
					<td><?php echo $fila['puesto']; ?></td>
					<td><?php echo $fila['horario']; ?></td>
					<td><?php echo $fila['direccion']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['customer_id']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="delete.php?id=<?php echo $fila['customer_id']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>