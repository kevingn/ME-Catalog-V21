<?php
	include_once "conexion/conexion.php";

	$btn = $_GET['btn'];

	if ($btn == 1) {

	    mysqli_query($conexion,"TRUNCATE TABLE tmp_pedido_juego");
    }
    if ($btn == 2) {
    	
    	$sql="INSERT INTO pedido_juego (SELECT NULL,juego_id,juego_cod,juego_categoria_id,fecha_hora,nombre_juego,nombre_cliente,cantidad,estado_pago,estado FROM tmp_pedido_juego)";
    	$cs=mysqli_query($conexion,$sql) or die(mysqli_error());
    	mysqli_query($conexion,"TRUNCATE TABLE tmp_pedido_juego");
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>