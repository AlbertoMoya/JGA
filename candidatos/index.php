<?php
    include '../header/header.php';
    session_start();  
	include_once 'conexion.php';

    $interes=$_POST['Interes'];

	$usuario_final = $_SESSION['Usuario'];
	$sql_Candidatos = "SELECT * FROM perfil WHERE interes='$interes' and activo='Si'";
	
	$sentencia_select=$con->prepare($sql_Candidatos);
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	//$sql_Buscar = "SELECT * FROM perfil where nombre LIKE :campo ORDER BY id_perfil ASC";

?>

<!DOCTYPE html>

<html lang="es">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Inicio </title>
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<div class="contenedor">
		<br>
		<br>
		<br>
		<h2>Candidatos de <?php echo $interes; ?></h2>
	
		<table>
			<tr class="head">
				<td>Id</td>
				<td>CANDIDATO</td>
				<td style="width: 70px" >EDAD</td>
				<td>CARRERA</td>
				<td>UNIVERSIDAD</td>
				<td>STATUS</td>
				<td>EXPERIENCIA</td>
				<td>DISPONIBILIDAD</td>
				<td>SEXO</td>
				<td>MUNICIPIO</td>
				<td>ACCIÓN</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr>
					<td><?php echo $fila['id_perfil']; ?></td>
					<td><?php echo $fila['nombre']; ?></td>
					<td><?php echo $fila['edad']." años"; ?></td>
					<td><?php echo $fila['carrera']; ?></td>
					<td><?php echo $fila['universidad']; ?></td>
					<td><?php echo $fila['status_c']; ?></td>


					<td><?php if($fila['experiencia'] == 'SE'){
						      echo "Sin Experiencia";
					        }elseif($fila['experiencia'] == 'ME6'){
							  echo "Menos de 6 meses";
							}elseif($fila['experiencia'] == 'MA6'){
								echo "Más de 6 meses";
							}elseif($fila['experiencia'] == '1'){
								echo "1 año";
							}elseif($fila['experiencia'] == 'MA10'){
								echo "Más de 10 años";
							}else{
								echo $fila['experiencia']." años";
							}
				    ?></td>


					<td><?php if($fila['tiempo'] == 'TC'){
						       echo "Tiempo Completo";
							}elseif($fila['tiempo'] == 'MT'){
								echo "Medio Tiempo";
							}
					?></td>


					<td><?php if($fila['genero'] == 'M'){
						      echo "Masculino";
					        }elseif($fila['genero']== 'F'){
							  echo "Femenino";
							}
                    ?></td>


					<td><?php echo $fila['estado']; ?></td>
					<td><a href="showcan.php?id=<?php echo $fila['id_perfil']; ?>"  class="btn__update" >VER CANDIDATO</a></td>	
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>