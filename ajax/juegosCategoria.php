<?php 
	$idConsola=$_POST['idConsola'];
	$idCategoria=$_POST['idCategoria'];
	include("../conexion/conexion.php");
	if($idConsola==0 AND $idCategoria==0){
		$queryJuegos=  mysqli_query($conexion,"SELECT * FROM juego ") or die(mysqli_error());
	}
	elseif($idConsola==0 AND $idCategoria!=0){
		$queryJuegos=  mysqli_query($conexion,"SELECT * FROM juego WHERE categoria_id=$idCategoria") or die(mysqli_error());
	}
	else{
		$queryJuegos=  mysqli_query($conexion,"SELECT * FROM juego WHERE consola_id$idConsola=$idConsola and categoria_id=$idCategoria") or die(mysqli_error());
	}
	$json = '{"Juegos" : [ ';
	
	while($row=mysqli_fetch_array($queryJuegos)){
		$json.= '{ "id" : "'.$row['id'].'" , "codigo" : "'.$row['cod'].'" , "categoria_id" : "'.$row['categoria_id'].'" , "imagen" : "'.$row['imagen'].'" , "nombre" : "'.$row['nombre'].'" , "lanzamiento" : "'.$row['lanzamiento'].'" , "descripcion"  : "'.$row['descripcion'].'" , "cantidad" : "'.$row['cantidad'].'" , "voto" : "'.$row['voto'].'" },';
	}
	$json= substr($json,0,-1);
	$json .=']}';
	echo $json;
	
?>