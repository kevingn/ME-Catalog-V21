<?php 
	include("../conexion/conexion.php");

	$queryPedidos=  mysqli_query($conexion,"SELECT * FROM tmp_pedido_juego") or die(mysqli_error());
	$json = '{"Pedidos" : [ ';
	
	while($row=mysqli_fetch_array($queryPedidos)){
		$json.= '{ "id" : "'.$row['id'].'" , "juego_id" : "'.$row['juego_id'].'" , "juego_cod" : "'.$row['juego_cod'].'" , "juego_categoria_id" : "'.$row['juego_categoria_id'].'" , "fecha_hora" : "'.$row['fecha_hora'].'" , "nombre_juego" : "'.$row['nombre_juego'].'" , "nombre_cliente"  : "'.$row['nombre_cliente'].'" , "cantidad" : "'.$row['cantidad'].'" , "estado_pago" : "'.$row['estado_pago'].'", "estado" : "'.$row['estado'].'"  },';
	}
	$json= substr($json,0,-1);
	$json .=']}';
	echo $json;
		
?>