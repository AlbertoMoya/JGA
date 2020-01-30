<?php
   
    session_start();  
  include '../header/header.php';
	include_once 'conexion.php';
	$usuario_final = $_SESSION['Usuario'];
	$sql_Postulados = "SELECT * FROM postulados INNER JOIN master_customer on postulados.id_vacante=master_customer.customer_id INNER JOIN clientes ON master_customer.empresa=clientes.id_cliente where clientes.usuario='$usuario_final' ORDER BY master_customer.customer_id ASC";
	
	$sentencia_select=$con->prepare($sql_Postulados);
	$sentencia_select->execute();
	$resultado=$sentencia_select->fetchAll();

	$sql_Buscar = "SELECT * FROM postulados INNER JOIN master_customer on postulados.id_vacante=master_customer.customer_id INNER JOIN clientes ON master_customer.empresa=clientes.id_cliente where clientes.usuario='$usuario_final'  and name_customer LIKE :campo ORDER BY master_customer.customer_id ASC";

	// metodo buscar
	if(isset($_POST['btn_buscar'])){
		$buscar_text=$_POST['buscar'];
		$select_buscar=$con->prepare($sql_Buscar);
		$select_buscar->execute(array(
			':campo' =>"%".$buscar_text."%"
		));

		$resultado=$select_buscar->fetchAll();

    }
    
    $mysqli = new mysqli('localhost', 'root', '', 'db_crudionic3');

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Demo de menú desplegable</title>
  <meta charset="utf-8" />
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/card.css">
</head>
<body>
  <br>
  <br>
  <br>
  <br>
  <center>
  <h2><b>BUSCAR CANDIDATO</b></h2>
  </center>
  

<div class="card">
  <img src="L1.png" alt="Avatar" style="width:100%">
  <div class="container">
    <h5><b>Selecciona que tipo de candidato estás buscando</b></h5> 
    <p>PERFIL:</p> 
    <form action="index.php"  method="post">
    <select name="Interes">
        <option value="0">Seleccione:</option>
        <?php
          $query = $mysqli -> query ("SELECT DISTINCT interes FROM perfil");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[interes].'">'.$valores[interes].'</option>';
          }
        ?>
      </select>
      <br>
      <br>
      <center>
      <input  type="submit" class="btn" name="btn_buscar" value="Buscar">
      </center>
      <br>
      <br>
    </form>
  </div>
</div>


</body>
</html>

