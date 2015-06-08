<?php
	include_once "conexion/conexion.php";

	$id = $_POST['txtid'];
	$cod = $_POST['txtcod'];
	$jid = $_POST['txtjid'];
	$cat = $_POST['txtcat'];
	$fec = $_POST['txtfec'];
	$jue = $_POST['txtjue'];
	$nom = $_POST['txtnom'];
	$can = $_POST['txtcan'];
	$pag = $_POST['txtpag'];
	$est = $_POST['txtest'];
	$btn = $_POST['btn'];

	if($btn == "MODIFICAR"){
		$sql="UPDATE pedido_juego SET fecha_hora='$fec',nombre_cliente='$nom',cantidad='$can',estado_pago='$pag',estado='$est' WHERE id=$id";
        $cs=mysqli_query($conexion,$sql) or die(mysqli_error());
	}
	if ($btn == "CERRAR"){
		$sql="UPDATE pedido_juego SET estado='CERRADO' WHERE id=$id";
        $cs=mysqli_query($conexion,$sql) or die(mysqli_error());
	}    

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>