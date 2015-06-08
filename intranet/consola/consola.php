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
        <link href="../../bootstrap-fileinput-master/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="../../bootstrap-fileinput-master/js/fileinput.js" type="text/javascript"></script>
        <script src="../../bootstrap-fileinput-master/js/fileinput_locale_es.js" type="text/javascript"></script>
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>


</head>
<?php
$varb=@$_GET['id'];
$var="";
$var1="";

if(isset($_POST["btn1"])){
    $btn=$_POST["btn1"];
    $bus=$_POST["txtbus"];
    if($btn=="Buscar"){
        
        $sql="SELECT * FROM consola WHERE id='$bus'";
        $cs=mysqli_query($conexion,$sql);
        while($resul=mysqli_fetch_array($cs)){
            $var = $resul[0];
            $var1 = $resul[1];
            }
            
                    }
        
    if($btn=="Nuevo"){
        
                    $sql="SELECT max(id +1) from consola";
                    $cs = mysqli_query($conexion,$sql);
                      if ($row = mysqli_fetch_row($cs)) {
                              $var = trim($row[0]);
                                        }
            
        }
        if($btn=="Agregar"){
                    if(isset($_POST['txtnom'])){
            if(!empty($_POST['txtid'])){
        $id=limpiar($_POST['txtid']);
    }
    else {
        $id = "NULL";
    }

        $nom = $_POST["txtnom"];

        $sql="INSERT INTO consola VALUES ($id, '$nom')";
        $cs=mysqli_query($conexion,$sql);
        echo "<script> alert('Se inserto; correctamente');</script>";
        }
        else{
        echo "<script> alert('Error al insertar datos');history.back();</script>";
        }
        }
        
        if($btn=="Actualizar"){
                    if(isset($_POST['txtnom'])){
        $id=$_POST['txtid'];

        $nom = $_POST["txtnom"];

        $sql="UPDATE consola SET nombre='$nom' WHERE id='$id'";
        
        $cs=mysqli_query($conexion,$sql);
        echo "<script> alert('Se actualizo correctamente');</script>";
        }
        else{
        echo "<script> alert('Error al actualizar datos');</script>";
        }
        }
        if($btn=="Eliminar"){
        $id = $_POST["txtid"];
            
        $sql="DELETE FROM consola WHERE id='$id'";
        
        $cs=mysqli_query($conexion,$sql);
        echo "<script> alert('Se elimnino correctamente');</script>";
        }
    }
?>


<body>
<form id="form1" action=""  method="POST">
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
                                  <li><a href="../juego/juego.php">Agregar / Modificar Juegos</a></li>
                                  <li><a href="../juego/listar_juegos.php">Listar Juegos</a></li>
                                </ul>
                              </li>
                            <li ><a href="../categoria/categoria.php">CATEGORIAS</a></li>
                            <li ><a href="consola.php">CONSOLAS</a></li> 
                        </ul>
                    </div>
                    <div class="col-md-9">
                            <center><h2>ADMINISTRAR CATEGORIAS</center></h2>
                        
                        <table  class="table table-bordered table-striped" >
                            <tr>
                                <th width="90%"  >
                                
                                    <center>
                                        <form action="" method="POST" class="form-search">
                                            <input type="text" name="txtbus"  SIZE="40"  autocomplete="off"  value="<?php echo $varb?>" placeholder="Buscar por codigo" onKeyUp="this.value=this.value.toUpperCase();">
                                            <button type="submit" name="btn1"  value="Buscar" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> BUSCAR</button>
                                        </form>
                                    </center>
                                </th>
                            </tr>
                        </table>                 
                        <div class="col-md-4 form-group">
                            <label>CONSOLA:</label>
                            <input type="text" class="form-control" name="txtnom" id="txtnom" maxlength='50'  SIZE="50" value="<?php echo $var1?>" onKeyPress="keynumeros();" placeholder="ingrese aqui el titulo" >
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="hidden" class="form-control" name="txtid" id="txtid" maxlength='50'  SIZE="50" value="<?php echo $var?>">
                        </div>
                        <div class="col-md-9 form-group">
                            <button type="submit" name="btn1" value="Nuevo" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-file"></span> NUEVO</button>
                            <button type="submit" name="btn1" value="Eliminar" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> ELIMINAR</button>
                            <button type="submit" name="btn1" value="Actualizar" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-pencil"></span> ACTUALIZAR</button>
                            <button type="submit" name="btn1" value="Agregar" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span> GUARDAR</button>
                        </div>
                            <table class="table table-hover table-bordered table-striped" style="border-collapse:collapse;">
                                  <thead>
                                  <tr>
                                    <th>Codigo</th>
                                    <th>Titulo</th>

                                  </tr>
                                  </thead>
                                      
                                  <tbody>
                                                 <?php
                                        if(!empty($_POST['buscar'])){
                                        $buscar=limpiar($_POST['buscar']);
                                        $pame=mysqli_query($conexion,"SELECT * FROM consola WHERE nombre LIKE '%$buscar%' or id='$buscar' ORDER BY nombre"); 
                                      }else{
                                        $pame=mysqli_query($conexion,"SELECT * FROM consola ORDER BY nombre");    
                                      }   
                                      while($row=mysqli_fetch_array($pame)){
                                      ?>
                                              <tr data-toggle="collapse" data-target="<?php echo '.art'.$cont;?>" class="accordion-toggle" aria-expanded="false">
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $row['nombre']; ?></td>
                                              </tr>
                                    <td class="accordian-body collapse <?php echo 'art'.$cont;?>" colspan="2">
                                        <div class="media" style="padding: 10px;">
                                            <div class="col-xs-9 media-right text-right">
                                                    <?php echo "<a href='../../intranet/consola/consola.php?id=$row[id]' class='btn btn-primary'>MODIFICAR</a> ";?>
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
    </div>
</form>

            <!-- /.container -->

    <div class="container">
                <hr>
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
</html>