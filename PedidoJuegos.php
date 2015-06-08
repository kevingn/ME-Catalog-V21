<?php
	include_once "conexion/conexion.php";

	$id = "NULL";
	$cod = @$_POST['txtcod'];
	$jid = @$_POST['txtjid'];
	$cat = @$_POST['txtcat'];
	$fec = "NULL";
	$jue = @$_POST['txtjue'];
	$nom = @$_POST['txtnom'];
	$can = @$_POST['txtcan'];
	$pag = @$_POST['txtpag'];
	$est = "ACTIVO";
	$btn = @$_POST['btn'];
	$borrar = @$_GET['borrar'];
	$idJuego = @$_GET['idjuego'];

	if ($btn == 1) {

	    $sql="INSERT INTO tmp_pedido_juego VALUES ($id,'$jid','$cod','$cat',$fec,'$jue','$nom','$can','$pag','$est')";
        $cs=mysqli_query($conexion,$sql) or die(mysqli_error());
        //$sql="INSERT INTO tmp_cliente VALUES ($id,'$nom')";
        //$cs=mysqli_query($conexion,$sql) or die(mysqli_error());
    }
    if ($btn == 2) {
    	

    	$sql1="INSERT INTO tmp_pedido_juego VALUES ($id,'$jid','$cod','$cat',$fec,'$jue','$nom','$can','$pag','$est')";
        $cs1=mysqli_query($conexion,$sql1) or die(mysqli_error());
        if($sql1){
    	$sql2="INSERT INTO pedido_juego (SELECT NULL,juego_id,juego_cod,juego_categoria_id,fecha_hora,nombre_juego,nombre_cliente,cantidad,estado_pago,estado FROM tmp_pedido_juego)";
    	$cs2=mysqli_query($conexion,$sql2) or die(mysqli_error());
    	mysqli_query($conexion,"TRUNCATE TABLE tmp_pedido_juego");
    }
    }
    if ($borrar == 1) {
     	
		$sql="DELETE FROM tmp_pedido_juego WHERE id=$idJuego";
    	$cs=mysqli_query($conexion,$sql) or die(mysqli_error());
     }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>