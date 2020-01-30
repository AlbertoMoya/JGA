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
		<h3>PERFIL</h3>
		
		<table>
			<tr class="head">
				<td>Id_pc</td>
				<td>Empresa</td>
				<td>Direccion</td>
				<td>Telefono</td>
				<td>Correo</td>
				<td>Mision</td>
				<td>Vision</td>
				<td>Descripcion</td>
				<td>Municipio</td>
				<td>Estado</td>
				<td>CP</td>
				<td colspan="2">Acción</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr>
					<td><?php echo $fila['id_pc']; ?></td>
					<td><?php echo $fila['empresa']; ?></td>
					<td><?php echo $fila['direccion_emp']; ?></td>
					<td><?php echo $fila['telefono']; ?></td>
					<td><?php echo $fila['correo']; ?></td>
					<td><?php echo $fila['mision']; ?></td>
					<td><?php echo $fila['vision']; ?></td>
					<td><?php echo $fila['descripcion']; ?></td>
					<td><?php echo $fila['municipio']; ?></td>
					<td><?php echo $fila['estado']; ?></td>
					<td><?php echo $fila['cp_emp']; ?></td>
					<td><a href="update.php?id=<?php echo $fila['id_pc']; ?>"  class="btn__update" >Editar</a></td>
					<td><a href="delete.php?id=<?php echo $fila['id_pc']; ?>" class="btn__delete">Eliminar</a></td>
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>