<?php
	$database="db_crudionic3";
	$user='root';
	$password='';


try {
	
	$con=new PDO('mysql:host=localhost;dbname='.$database,$user,$password);

} catch (PDOException $e) {
	echo "Error".$e->getMessage();
}
 
$mysqli = new mysqli('localhost', 'root', '', 'db_crudionic3');


?>