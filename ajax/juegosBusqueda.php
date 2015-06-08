<?php 
	$idConsola=$_POST['idConsola'];
	$busqueda=$_POST['busqueda'];
	include("../conexion/conexion.php");
	if($idConsola==0 AND $busqueda==0){
		$queryJuegos=  mysqli_query($conexion,"SELECT * FROM juego LIMIT 12") or die(mysqli_error());
	}
	elseif($idConsola==0 AND $busqueda!=0){
		$queryJuegos=  mysqli_query($conexion,"SELECT * FROM juego WHERE nombre LIKE '%$busqueda%' LIMIT 12") or die(mysqli_error());
	}
	else{
		$queryJuegos=  mysqli_query($conexion,"SELECT * FROM juego WHERE consola_id$idConsola=$idConsola AND nombre LIKE '%$busqueda%' LIMIT 12") or die(mysqli_error());
	}
	$json = '{"Juegos" : [ ';
	
	while($row=mysqli_fetch_array($queryJuegos)){
		$json.= '{ "id" : "'.$row['id'].'" , "codigo" : "'.$row['cod'].'" , "categoria_id" : "'.$row['categoria_id'].'" , "imagen" : "'.$row['imagen'].'" , "nombre" : "'.$row['nombre'].'" , "lanzamiento" : "'.$row['lanzamiento'].'" , "descripcion"  : "'.$row['descripcion'].'" , "cantidad" : "'.$row['cantidad'].'" , "voto" : "'.$row['voto'].'" },';
	}
	$json= substr($json,0,-1);
	$json .=']}';
	echo $json;	
?>