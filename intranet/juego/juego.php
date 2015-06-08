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
$varb=@$_GET['cod'];
$m=@$_GET['m'];
$var="";
$var1="";
$var2="";
$var3="";
$var4="";
$var5="";
$var6="";
$var7="";
$var8="";
$var9="";
$var10="";
$var11="";
$var12="";
$var13="";

if(isset($_POST["btn1"])){
    $btn=$_POST["btn1"];
    $bus=$_POST["txtbus"];
    if($btn=="Buscar"){
        
        $sql="SELECT * FROM juego WHERE cod='$bus'";
        $cs=mysqli_query($conexion,$sql);
        while($resul=mysqli_fetch_array($cs)){
            $var = $resul[0];
            $var1 = $resul[1];
            $var2 = $resul[2];
            $var3 = $resul[3];
            $var4 = $resul[4];
            $var5 = $resul[5];
            $var6 = $resul[6];
            $var7 = $resul[7];
            $var8 = $resul[8];
            $var9 = $resul[9];
            $var10 = $resul[10];
            $var11 = $resul[11];
            $var12 = $resul[12];
            $var13 = $resul[13];
            }
            
                    }
        
    if($btn=="Nuevo"){
        
                    $sql="SELECT max(id +1) from juego";
                    $cs = mysqli_query($conexion,$sql);
                      if ($row = mysqli_fetch_row($cs)) {
                              $var = trim($row[0]);
                                        }
            
        }
        if($btn=="Agregar"){
            if(isset($_POST['txtcod']) && !empty($_POST['txtcod']) &&
                isset($_POST['txtnom']) && !empty($_POST['txtnom']) &&
                isset($_POST['txtdes']) && !empty($_POST['txtdes']) &&
                isset($_POST['txtvot']) && !empty($_POST['txtvot'])){
        if(!empty($_POST['txtid'])){
        $id=limpiar($_POST['txtid']);
    }
    else {
        $id = "NULL";
    }
        $cod = $_POST["txtcod"];
        $cat = $_POST["txtcat"];
                if(!empty($_POST['chccon1'])){
        $con1=limpiar($_POST['chccon1']);
    }
    else {
        $con1 = "NULL";
    }
                if(!empty($_POST['chccon2'])){
        $con2=limpiar($_POST['chccon2']);
    }
    else {
        $con2 = "NULL";
    }
                if(!empty($_POST['chccon3'])){
        $con3=limpiar($_POST['chccon3']);
    }
    else {
        $con3 = "NULL";
    }
                if(!empty($_POST['chccon4'])){
        $con4=limpiar($_POST['chccon4']);
    }
    else {
        $con4 = "NULL";
    }
                    if(!empty($_POST['chccon5'])){
        $con5=limpiar($_POST['chccon5']);
    }
    else {
        $con5 = "NULL";
    }
        $file = "images/".$_POST["txtfil"];
        $nom = $_POST["txtnom"];
        $lan = $_POST["txtlan"];
        $des = $_POST["txtdes"];
        $can = $_POST["txtcan"];
        $vot = $_POST["txtvot"];


        $sql="INSERT INTO juego VALUES ($id,'$cod','$cat',$con1,$con2,$con3,$con4,$con5,'$file','$nom','$lan','$des','$can','$vot')";
        $cs=mysqli_query($conexion,$sql);
        echo "<script> alert('Se inserto; correctamente');</script>";
        }
        else{
        echo "<script> alert('Error al insertar datos');history.back();</script>";
        }
        }
        
        if($btn=="Actualizar"){
                if(isset($_POST['txtcod']) && !empty($_POST['txtcod']) &&
                isset($_POST['txtnom']) && !empty($_POST['txtnom']) &&
                isset($_POST['txtdes']) && !empty($_POST['txtdes']) &&
                isset($_POST['txtid']) && !empty($_POST['txtid']) &&
                isset($_POST['txtvot']) && !empty($_POST['txtvot'])){
    
        $id= $_POST['txtid'];
        $cod = $_POST["txtcod"];
        $cat = $_POST["txtcat"];
                if(!empty($_POST['chccon1'])){
        $con1=limpiar($_POST['chccon1']);
    }
    else {
        $con1 = "NULL";
    }
                if(!empty($_POST['chccon2'])){
        $con2=limpiar($_POST['chccon2']);
    }
    else {
        $con2 = "NULL";
    }
                if(!empty($_POST['chccon3'])){
        $con3=limpiar($_POST['chccon3']);
    }
    else {
        $con3 = "NULL";
    }
                if(!empty($_POST['chccon4'])){
        $con4=limpiar($_POST['chccon4']);
    }
    else {
        $con4 = "NULL";
    }
                    if(!empty($_POST['chccon5'])){
        $con5=limpiar($_POST['chccon5']);
    }
    else {
        $con5 = "NULL";
    }
        $file = "images/".$_POST["txtfil"];
        $nom = $_POST["txtnom"];
        $lan = $_POST["txtlan"];
        $des = $_POST["txtdes"];
        $can = $_POST["txtcan"];
        $vot = $_POST["txtvot"];
    
        $sql="UPDATE juego SET cod=$cod,categoria_id=$cat,consola_id1=$con1,consola_id2=$con2,consola_id3=$con3,consola_id4=$con4,consola_id5=$con5,imagen='$file',nombre='$nom',lanzamiento=$lan,descripcion='$des',cantidad='$can',voto='$vot' WHERE id=$id";
        
        $cs=mysqli_query($conexion,$sql);
        echo "<script> alert('Se actualizo correctamente');</script>";
        }
        else{
        echo "<script> alert('Error al actualizar datos');</script>";
        }
        }
        if($btn=="Eliminar"){
        $id=$_POST["txtid"];
            
        $sql="DELETE FROM juego WHERE id ='$id'";
        
        $cs=mysqli_query($conexion,$sql);
        echo "<script> alert('Se elimnino correctamente');</script>";
        }
    }
?>


<body>
<form id="form1" action=""  enctype="multipart/form-data" method="POST">
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
                            <center><h2>DATOS DE JUEGOS</center></h2>
                        
                        <table  class="table table-bordered table-striped" >
                            <tr>
                                <th width="90%"  >
                                
                                    <center>
                                        <form action="juego.php" method="POST" class="form-search">
                                            <input type="text" name="txtbus"  SIZE="40"  autocomplete="off"  value="<?php echo $varb?>" placeholder="Buscar por codigo" onKeyUp="this.value=this.value.toUpperCase();">
                                            <button type="submit" name="btn1"  value="Buscar" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> BUSCAR</button>
                                        </form>
                                    </center>
                                </th>
                            </tr>
                        </table>                 
                        <div class="col-md-4 form-group">
                            <label>CODIGO:</label>
                            <input type="text" class="form-control" name="txtcod" id="txtcod" maxlength='50'  SIZE="50" value="<?php echo $var1?>" placeholder="ingrese aqui el codigo" onKeyUp="this.value=this.value.toUpperCase();" >
                        </div>

                        <div class="col-md-4 form-group">
                            <label>TITULO:</label>
                            <input type="text" class="form-control" name="txtnom" id="txtnom" maxlength='50'  SIZE="50" value="<?php echo $var9?>" onKeyPress="keynumeros();" placeholder="ingrese aqui el titulo" >
                        </div>
                        <div class="col-md-4 form-group">
                            <label>CATEGORIA:</label><br />
                            <b><?php 
                                $sql="SELECT * FROM categoria";
                                $res=@mysqli_query($conexion,$sql);
                                if(!$res){
                                echo " fallo";
                                }
                                else{
                                echo "<select  class='form-control' name='txtcat' >";
                                ?>
                                <option value="<?php echo $var2 ?>"><?php $sql2="SELECT * FROM categoria WHERE id='$var2'"; $res2=@mysqli_query($conexion,$sql2); while ($fila2=mysqli_fetch_array($res2)){ echo $fila2['nombre'];}
?></option>";
                                <?php
                                while ($fila=mysqli_fetch_array($res)){
                                echo "<option value='$fila[id]'>$fila[nombre]</option>";
                                }
                                echo "</select>";
                                }
                                ?>
                            </b>
                        </div>
                        <div class="col-md-8 form-group">
                            <label>DESCRIPCION:</label>
                            <textarea type="text" class="form-control" name="txtdes"  id="txtdes"  placeholder="Ingrese aqui la descripcion" ><?php echo $var11?></textarea>
                        </div>
                        <div class="col-md-4 form-group">
                        <label>FECHA DE LANZAMIENTO:</label>
                            <input type="date" class="form-control" name="txtlan"  id="txtlan"  value="<?php echo $var10?>" >
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="form-group">
                                <input id="file-5" class="file" type="file" name="images[]" multiple data-preview-file-type="any" data-upload-url="../../upload.php" data-preview-file-icon="" onchange="enviarFileName(this.value)">
                                <input type="hidden" class="form-control" name="txtfil" id="txtfil" value="">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <center>
                            <label>CONSOLA:</label>
                            <br />
                            
                            <label class="checkbox-inline">
                              <input type="checkbox" name="chccon1" id="chccon1" value="1" <?php if($var3 == 1){ echo 'checked'; }?>> PC
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" name="chccon2" id="chccon2" value="2" <?php if($var4 == 2){ echo 'checked'; }?>> XBOX 360
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" name="chccon3" id="chccon3" value="3" <?php if($var5 == 3){ echo 'checked'; }?>> PLAYSTATION 3
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" name="chccon4" id="chccon4" value="4" <?php if($var6 == 4){ echo 'checked'; }?>> PLAYSTATION 4
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" name="chccon5" id="chccon5" value="5" <?php if($var7 == 5){ echo 'checked'; }?>> WII
                            </label>
                            </center>
                        </div>
                        <div class="col-md-4 form-group">
                            <label>VALORACION:</label>
                            <input type="text"  class="form-control" name="txtvot" id="txtvot" value="<?php echo $var13?>" placeholder="ingrese aqui su mail" >
                        </div>
                        <div class="col-md-4 form-group">
                            <label>TAMAÑO EN GB:</label>
                            <input type="text"  class="form-control" name="txtcan" id="txtcan" value="<?php echo $var12?>" placeholder="ingrese aqui el tamaño en GB" >
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

<script>
    $("#file-0").fileinput({
        'allowedFileExtensions' : ['jpg', 'png','gif'],
    });
    $("#file-1").fileinput({
        uploadUrl: '../../upload.php', // you must set a valid URL here else you will get an error
        allowedFileExtensions : ['jpg', 'png','gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function(filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
    /*
    $(".file").on('fileselect', function(event, n, l) {
        alert('File Selected. Name: ' + l + ', Num: ' + n);
    });
    */
    $("#file-3").fileinput({
        showUpload: false,
        showCaption: false,
        browseClass: "btn btn-primary btn-lg",
        fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
    });
    $("#file-4").fileinput({
        uploadExtraData: {kvId: '10'}
    });
    $(".btn-warning").on('click', function() {
        if ($('#file-4').attr('disabled')) {
            $('#file-4').fileinput('enable');
        } else {
            $('#file-4').fileinput('disable');
        }
    });    
    $(".btn-info").on('click', function() {
        $('#file-4').fileinput('refresh', {previewClass:'bg-info'});
    });
    /*
    $('#file-4').on('fileselectnone', function() {
        alert('Huh! You selected no files.');
    });
    $('#file-4').on('filebrowse', function() {
        alert('File browse clicked for #file-4');
    });
    */
    $(document).ready(function() {
        $("#test-upload").fileinput({
            'showPreview' : false,
            'allowedFileExtensions' : ['jpg', 'png','gif'],
            'elErrorContainer': '#errorBlock'
        });
        /*
        $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
            alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
        });
        */
    });
function enviarFileName(){
var path = document.getElementById("file-5").value
var fileName = path.match(/[^\/\\]+$/);
document.getElementById("txtfil").value=fileName;
console.log(fileName);
};
    </script>

</html>