<?php
    include '../header/header.php';
    session_start();  
	include_once 'conexion.php';
	$usuario_final = $_SESSION['Usuario'];
	$sql_Postulados = "SELECT * FROM postulados INNER JOIN master_customer on postulados.id_vacante=master_customer.customer_id INNER JOIN clientes ON master_customer.empresa=clientes.id_cliente INNER JOIN perfil ON postulados.id_perfil=perfil.id_user where clientes.usuario='$usuario_final' ORDER BY master_customer.customer_id ASC";
	
	$sentencia_select=$con->prepare($sql_Postulados);
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	$sql_Buscar = "SELECT * FROM postulados INNER JOIN master_customer on postulados.id_vacante=master_customer.customer_id INNER JOIN clientes ON master_customer.empresa=clientes.id_cliente INNER JOIN perfil ON postulados.id_perfil=perfil.id_user where clientes.usuario='$usuario_final'  and name_customer LIKE :campo ORDER BY master_customer.customer_id ASC";

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
		<h3>POSTULADOS</h3>
		<div class="barra__buscador">
			<form action="" class="formulario" method="post">
				<input type="text" name="buscar" placeholder="BUSCAR VACANTE" 
				value="<?php if(isset($buscar_text)) echo $buscar_text; ?>" class="input__text">
				<input type="submit" class="btn" name="btn_buscar" value="Buscar">
			</form>
		</div>
		<table>
			<tr class="head">
				<td>Id</td>
				<td>VACANTE</td>
				<td>CANDIDATO</td>
				<td>EXPERIENCIA</td>
				<td>CARRERA</td>
				<td>STATUS CARRERA</td>
				<td>DISPONIBILIDAD</td>
				<td>FECHA POSTULACION</td>
				<td>GENERO</td>
				<td>STATUS</td>
				<td style="width: 160px">IDIOMAS</td>
				<td>ACCIÓN</td>
			</tr>
			<?php foreach($resultado as $fila):?>
				<tr>
					<td><?php echo $fila['id_postulado']; ?></td>
					<td><?php echo $fila['name_customer']; ?></td>
					<td><?php echo $fila['usuarioPost']; ?></td>
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
					<td><?php echo $fila['carrera']; ?></td>
					<td><?php echo $fila['status_c']; ?></td>
					<td><?php if($fila['tiempo'] == 'TC'){
						       echo "Tiempo Completo";
							}elseif($fila['tiempo'] == 'MT'){
								echo "Medio Tiempo";
							}
					?></td>
					
					<td><?php echo $fila['fecha']; ?></td>
					<td><?php if($fila['genero'] == 'M'){
						      echo "Masculino";
					        }elseif($fila['genero']== 'F'){
							  echo "Femenino";
							}
                    ?></td>
					<td><?php echo $fila['status_post']; ?></td>
					<td><?php if($fila['ingles'] != 'No'){
						        if($fila['ingles'] == 'A'){
									echo "<strong>Inglés:</strong>  Avanzado <br>";
								}elseif($fila['ingles'] == 'B'){
									echo "<strong>Inglés:</strong> Básico <br>";
								}elseif($fila['ingles'] == 'I'){
									echo "<strong>Inglés:</strong> Intermedio <br>";
								}
							}

							if($fila['frances'] != 'No'){
						        if($fila['frances'] == 'A'){
									echo "<strong>Francés:</strong>  Avanzado <br>";
								}elseif($fila['frances'] == 'B'){
									echo "<strong>Francés:</strong> Básico <br>";
								}elseif($fila['frances'] == 'I'){
									echo "<strong>Francés:</strong> Intermedio <br>";
								}
							}

							if($fila['italiano'] != 'No'){
						        if($fila['italiano'] == 'A'){
									echo "<strong>Italiano:</strong>  Avanzado <br>";
								}elseif($fila['italiano'] == 'B'){
									echo "<strong>Italiano:</strong> Básico <br>";
								}elseif($fila['italiano'] == 'I'){
									echo "<strong>Italiano:</strong> Intermedio <br>";
								}
							}

							if($fila['aleman'] != 'No'){
						        if($fila['aleman'] == 'A'){
									echo "<strong>Aleman:</strong>  Avanzado <br>";
								}elseif($fila['aleman'] == 'B'){
									echo "<strong>Aleman:</strong> Básico <br>";
								}elseif($fila['aleman'] == 'I'){
									echo "<strong>Aleman:</strong> Intermedio <br>";
								}
							}

							if($fila['portugues'] != 'No'){
						        if($fila['portugues'] == 'A'){
									echo "<strong>Portugues:</strong>  Avanzado <br>";
								}elseif($fila['portugues'] == 'B'){
									echo "<strong>Portugues:</strong> Básico <br>";
								}elseif($fila['portugues'] == 'I'){
									echo "<strong>Portugues:</strong> Intermedio <br>";
								}
							}

					 ?></td>
					<td><a href="showpost.php?id=<?php echo $fila['id_postulado']; ?>"  class="btn__update" >VER CANDIDATO</a></td>
					
				</tr>
			<?php endforeach ?>

		</table>
	</div>
</body>
</html>