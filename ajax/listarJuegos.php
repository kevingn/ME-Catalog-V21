<?php 
	include("../conexion/conexion.php");
	$idConsola=$_POST['id'];
	//echo "SELECT * FROM juegos WHERE consola_id$idConsola=1";
	if($idConsola==0){
		$queryJuegos=  mysqli_query($conexion,"SELECT * FROM juego LIMIT 54") or die(mysqli_error());
	}else{
		$queryJuegos=  mysqli_query($conexion,"SELECT * FROM juego WHERE consola_id$idConsola=$idConsola LIMIT 54") or die(mysqli_error());
	}
	$json = '{"Juegos" : [ ';
	
	while($row=mysqli_fetch_array($queryJuegos)){
		$json.= '{ "id" : "'.$row['id'].'" , "codigo" : "'.$row['cod'].'" , "categoria_id" : "'.$row['categoria_id'].'" , "imagen" : "'.$row['imagen'].'" , "nombre" : "'.$row['nombre'].'" , "lanzamiento" : "'.$row['lanzamiento'].'" , "descripcion"  : "'.$row['descripcion'].'" , "cantidad" : "'.$row['cantidad'].'" , "voto" : "'.$row['voto'].'" },';
	}
	$json= substr($json,0,-1);
	$json .=']}';
	echo $json;
	
	
?>