<!DOCTYPE html>
<?php
  include_once "../../conexion/conexion.php";
  $cont=0;
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

    <title>Calogo Modo Experto ADMIN</title>

    <!-- Custom CSS -->
    <link href="css/shop-adminpage.css" rel="stylesheet">

        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<?PHP
  if(isset($_POST["btn1"])){
  $btn=$_POST["btn1"];
    if($btn=="Eliminar"){
    $id=$_POST['txtid'];
      
    $sql="DELETE FROM juego WHERE id ='$id'";
    
    $cs=mysqli_query($conexion,$sql);
    echo "<script> alert('Se elimnino correctamente');</script>";
    }
  }
 ?>
<body>
<form id="form1" action="listar_juegos.php" method="POST">
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
                <a class="navbar-brand" href="#">Modo Experto - Catalogo ADMIN</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li ><a href="">PC</a></li>
                    <li ><a href="">XBOX 360</a></li>
                    <li ><a href="">PLAY 3</a></li>
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
                                  <li><a href="juego.php">Agregar / Modificar Juegos</a></li>
                                  <li><a href="listar_juegos.php">Listar Juegos</a></li>
                                </ul>
                              </li>
                            <li ><a href="../categoria/categoria.php">CATEGORIAS</a></li>
                            <li ><a href="../consola/consola.php">CONSOLAS</a></li> 
                        </ul>
                    </div>
                    <div class="col-md-9">
                                 <table  class="table table-bordered table-striped" >
                  <tr >
               <th width="90%"  >
                      <h1 align="center">LISTADO JUEGOS</h1>
                        <center>
                        <form name="form3" method="post" action="" class="form-search">
                            <input type="text" SIZE="40"  name="buscar" autocomplete="off"  placeholder="Buscar por nombre o codigo" onKeyUp="this.value=this.value.toUpperCase();">
                         <button type="submit" name="buton" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> BUSCAR</button>
                      </form>
                        </center>
                    </th>
                  </tr>
                </table>
<br>
              <table class="table table-hover table-bordered table-striped" style="border-collapse:collapse;">
      <thead>
      <tr>
        <th>Codigo</th>
        <th>Titulo</th>
        <th>Lanzamiento</th>
        <th>Cantidad</th>
        <th>Valoracion</th>
      </tr>
      </thead>
          
      <tbody>
                     <?php
            if(!empty($_POST['buscar'])){
            $buscar=limpiar($_POST['buscar']);
            $pame=mysqli_query($conexion,"SELECT * FROM juego WHERE nombre LIKE '%$buscar%' or cod='$buscar' ORDER BY nombre"); 
          }else{
            $pame=mysqli_query($conexion,"SELECT * FROM juego ORDER BY nombre");    
          }   
          while($row=mysqli_fetch_array($pame)){
            echo "<input type='hidden' class='form-control' name='txtid' id='txtid' value='$row[id]'>";
          ?>
                  <tr data-toggle="collapse" data-target="<?php echo '.art'.$cont;?>" class="accordion-toggle" aria-expanded="false">
                    <td><?php echo $row['cod']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['lanzamiento']; ?></td>
                    <td><?php echo $row['cantidad']; ?></td>
                    <td><?php echo $row['voto']; ?></td>
                  </tr>
        <td class="accordian-body collapse <?php echo 'art'.$cont;?>" colspan="7">
            <div class="media" style="padding: 10px;">
                <div class="col-xs-9 media-right text-right">
                        <?php echo "<a href='../../intranet/juego/juego.php?cod=$row[cod]' class='btn btn-primary'>MODIFICAR</a> ";?>
                        <button type="submit" name="btn1" value="Eliminar" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> ELIMINAR</button>
                        </form>
                </div>
            </div>    
        </td>
              <?php $cont = $cont + 1; } ?>
      </tr>
</tbody>
</table>
        </div>
      </div>
    </div>
    
 <script src="http://code.jquery.com/jquery-latest.min.js"></script>
 <script src="../../js/bootstrap.min.js"></script>
    
  </body>
</html>