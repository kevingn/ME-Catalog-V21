<!DOCTYPE html>
<?php
  include_once "conexion/conexion.php";
  $ac=0;
  $ce=0;
?>
<html lang="en">

<head>
<style media="print">
#goBack,#printRow {
   display:none;
}
</style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <title>Calogo Modo Experto ADMIN</title>
    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
<body>
<form id="form1" action="admin.php" method="POST">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="admin.php"><img style="height: 3.5em;width: 16em;" src="images/logome.png"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                </ul>  
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Page Content -->
    <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <p class="lead">Administrar Modulos</p>
                        <ul class="nav nav-pills nav-stacked">
                              <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="">ADMINISTRAR JUEGOS
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                  <li><a href="intranet/juego/juego.php">Agregar / Modificar Juegos</a></li>
                                  <li><a href="intranet/juego/listar_juegos.php">Listar Juegos</a></li>
                                </ul>
                              </li>
                            <li ><a href="intranet/categoria/categoria.php">CATEGORIAS</a></li>
                            <li ><a href="intranet/consola/consola.php">CONSOLAS</a></li> 
                        </ul>
                    </div>             
                    <div class="col-md-9">
                        <?php       
                                $sql=mysqli_query($conexion,"SELECT * FROM pedido_juego WHERE estado='ACTIVO'");
                                while($row=mysqli_fetch_array($sql))
                                {
                                    
                                $ac = $ac + 1;

                            }
                        ?>
                            <div class="block">
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr >
                                                <th colspan="7"> PEDIDOS JUEGOS ACTIVOS<span class="badge badge-info pull-right"><?php echo $ac ?></span></th>
                                            </tr>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Juego</th>
                                                <th>Cantidad</th>
                                                <th>Cliente</th>
                                                <th>Pago</th>
                                                <th>Fecha - Hora</th>
                                                <th>Modificar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php       
                                            $sql=mysqli_query($conexion,"SELECT * FROM pedido_juego WHERE estado='ACTIVO' ORDER BY fecha_hora DESC LIMIT 12");
                                            while($row=mysqli_fetch_array($sql))
                                            {
                                            echo "<tr>
                                                    <td>$row[juego_cod]</td>
                                                    <td>$row[nombre_juego]</td>
                                                    <td>$row[cantidad]</td>
                                                    <td>$row[nombre_cliente]</td>
                                                    <td>$row[estado_pago]</td>
                                                    <td>$row[fecha_hora]</td>
                                                    <td> <button type='button' class='btn btn-sm btn-info' data-toggle='modal' data-target='#myModal$row[id]'> Modificar </button> </td>
                                                  </tr>";
                                              }
                                              ?>
                                        </tbody>
                                    </table>
                                    <?php       
                                            $sql=mysqli_query($conexion,"SELECT * FROM pedido_juego WHERE estado='CERRADO'");
                                            while($row=mysqli_fetch_array($sql))
                                            {
                                                
                                            $ce = $ce + 1;

                                        }
                                    ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr >
                                                <th colspan="6"> PEDIDOS JUEGOS CERRADOS<span class="badge badge-info pull-right"><?php echo $ce ?></span></th>
                                            </tr>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Juego</th>
                                                <th>Cantidad</th>
                                                <th>Cliente</th>
                                                <th>Pago</th>
                                                <th>Fecha - Hora</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php       
                                            $sql=mysqli_query($conexion,"SELECT * FROM pedido_juego WHERE estado='CERRADO' ORDER BY fecha_hora DESC LIMIT 12");
                                            while($row=mysqli_fetch_array($sql))
                                            {
                                            echo "<tr>
                                                    <td>$row[juego_cod]</td>
                                                    <td>$row[nombre_juego]</td>
                                                    <td>$row[cantidad]</td>
                                                    <td>$row[nombre_cliente]</td>
                                                    <td>$row[estado_pago]</td>
                                                    <td>$row[fecha_hora]</td>
                                                  </tr>";
                                              }
                                              ?>
                                        </tbody>
                                    </table>
                                        <?php       
                                            $sql=mysqli_query($conexion,"SELECT * FROM pedido_juego WHERE estado='ACTIVO' ORDER BY fecha_hora DESC");
                                            while($row=mysqli_fetch_array($sql))
                                            {
                                            echo "
                                            <div id='myModal$row[id]' class='modal fade' role='dialog'>
                                                <div class='modal-dialog'>
                                                    <div class='modal-content'>
                                                      <div class='modal-header'>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                        <h4 class='modal-title'>Modificar Pedido Juegos</h4>
                                                      </div>
                                                        <div class='modal-body'>
                                                            <form action='ModificarPedidoJuegos.php' id='FormPedidoJuegos' method='post' class='form-horizontal'>
                                                                <div class='form-group'>
                                                                    <label class='col-xs-3 control-label'>CODIGO</label>
                                                                    <div class='col-xs-5'>
                                                                        <input type='text' class='form-control' name='txtcod' readonly value='$row[juego_cod]'>
                                                                        <input type='hidden' class='form-control' name='txtcat' id='txtcat' value='$row[juego_categoria_id]'>
                                                                        <input type='hidden' class='form-control' name='txtjid' id='txtjid' value='$row[juego_id]'>
                                                                        <input type='hidden' class='form-control' name='txtid' id='txtid' value='$row[id]'>
                                                                        <input type='hidden' class='form-control' name='txtfec' id='txtfec' value='$row[fecha_hora]'>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label class='col-xs-3 control-label'>JUEGO</label>
                                                                    <div class='col-xs-5'>
                                                                        <input type='txt' class='form-control' name='txtjue' readonly value='$row[nombre_juego]'>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label class='col-xs-3 control-label'>CANTIDAD</label>
                                                                    <div class='col-xs-5'>
                                                                        <input type='txt' class='form-control' name='txtcan' value='$row[cantidad]'>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label class='col-xs-3 control-label'>NOMBRE</label>
                                                                    <div class='col-xs-5'>
                                                                        <input type='txt' class='form-control' name='txtnom' value='$row[nombre_cliente]'>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label class='col-xs-3 control-label'>FORMA DE PAGO</label>
                                                                    <div class='col-xs-5'>
                                                                        <select name='txtpag' id='txtpag' class='form-control'>
                                                                            <option value='PAGADO'>LO DEJO PAGADO</option>
                                                                            <option value='NO PAGO'>LO PAGO CUANDO RETIRO</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <label class='col-xs-3 control-label'>ESTADO</label>
                                                                    <div class='col-xs-5'>
                                                                        <select name='txtest' id='txtest' class='form-control'>
                                                                            <option value='ACTIVO'>ACTIVO</option>
                                                                            <option value='SUSPENDIDO'>SUSPENDIDO</option>
                                                                            <option value='CERRADO'>CERRADO</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class='form-group'>
                                                                    <div class='col-xs-12 col-xs-offset-3'>
                                                                        <button type='submit' class='btn btn-danger' name='btn' value='CERRAR'>Cerrar Pedido</button>
                                                                        <button type='submit' class='btn btn-success' name='btn' value='MODIFICAR'>Modificar</button>
                                                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                            }
                                        ?>
                                </div>
                            </div>
                    </div>                   
                </div>
        </div>
</form>
    <!-- /.container -->
    <div class="container">
                <!-- Footer -->
                <footer>
                    <div class="row">
                        <div class="col-lg-12">
                            <center><p>Copyright &copy; Link State - 2015</p></center>
                        </div>
                    </div>
                </footer>
    </div>
    <!-- /.container -->
</body>
    <script src="bootstrap-fileinput-master/js/fileinput.js" type="text/javascript"></script>
    <script src="bootstrap-fileinput-master/js/fileinput_locale_es.js" type="text/javascript"></script>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</html>