<?php  

require("conexion/conexion.php");
$sql=mysqli_query($conexion,"SELECT * FROM pedido_juego ");
                                            while($row=mysqli_fetch_array($sql))
                                            {
if($row['estado'] == 'CERRADO'){ echo "selected"; }
}

?>