<!DOCTYPE html>
<?php
    require("conexion/conexion.php");
    $start = 0;
    $copias = 1;
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Calogo Modo Experto</title>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
    body {
    background: url('images/<?php echo $con; ?>');
    background-repeat:no-repeat;
    background-position: center center;
    background-attachment: fixed;
    background-size: cover;
}
    </style>
    <link href="css/shop-homepage.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-trans navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img style="height: 3.5em;width: 16em;" src="images/logome.png">
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				<?php 
					$queryConsole=mysqli_query( $conexion," SELECT * FROM consola ")or die(mysqli_error());
					while( $fetch = mysqli_fetch_array($queryConsole) ){
							echo '<li><a href="javascript:void(0);" imagen="'.$fetch['imagen'].'" onclick="postConsola('.$fetch['id'].',$(this))" > '.$fetch['nombre'].' </a></li>';
					}	
				?>
                </ul>
                    <div class="col-sm-3 col-md-3 pull-right">
                        <form class="navbar-form form-search"  method="POST" action="">
                            <div class="input-group">
                                <input id="formbus" type="text" class="form-control" placeholder="Buscar" name="busqueda">
                            </div>
                        </form>
                    </div>      
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                    <div id="scrollthis" class="list-group fixed" style="height:85%; overflow: hidden; overflow-y: auto;">
                        <div class="list-group-item">
                            <p class="lead">Categorias</p>
                            <p>Pedido</p>
                            <a class="btn btn-danger btn-xs" href="CerrarPedido.php?btn=1">Cancelar</a><a class="btn btn-primary btn-xs pull-right" href="CerrarPedido.php?btn=2">Confirmar</a>
                        </div>
                        <?php       
                                $sql=mysqli_query($conexion,"SELECT * FROM categoria");
                                while($row=mysqli_fetch_array($sql))
								{
									
                                $cont = 0;
                                    $sql2=mysqli_query($conexion,"SELECT categoria_id FROM juego WHERE categoria_id='$row[id]'");
                                    while($row2=mysqli_fetch_array($sql2))
                                    {
                                        $cont = $cont+1;
                                    }
                                        if($cont==1){
                                    }
                                    else{
                                            echo "<a href='javascript:void(0);'  class='list-group-item' onclick='postCategory(".$row['id'].")' >$row[nombre]<span class='badge' id='contJuegos' idCategoria='".$row['id']."'>$cont</span></a>";
                                    }
                            } 
                        ?>
                    </div>
            </div>
            <div class="col-md-9">
                <div class="row" id="insertGame">
                </div>
            </div>
        </div>
    </div>
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
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/jquery.lazyload.js"></script>
    <script>
        var consolaActual=0;
        $('#formbus').change(function(){
        var bus = $("#formbus").val();
        $.post("ajax/juegosBusqueda.php",{ busqueda : bus , idConsola : consolaActual }).done(function(data){
        bgConsole="";
                $('#insertGame').html("");
                json=jQuery.parseJSON(data);
                var objeto=json.Juegos;
                for(i=0; i<= (objeto.length -1); i++){
                    id=objeto[i].id;
                    nombre=objeto[i].nombre;
                    codigo=objeto[i].codigo;
                    imagen=objeto[i].imagen;
                    categoria_id=objeto[i].categoria_id;
                    lanzamiento=objeto[i].lanzamiento;
                    descripcion=objeto[i].descripcion;
                    cantidad=objeto[i].cantidad;
                    voto=objeto[i].voto;
                    strStar='';
                    strStarEm='';
                    for(j=1; j<= voto; j++){ 
                    strStar+='<span class="glyphicon glyphicon-star"></span>';
                    }
                    for(j=1; j<= 5 - voto; j++){ 
                    strStarEm+='<span class="glyphicon glyphicon-star-empty"></span>';
                    }
                    $('#insertGame').append('\
                        \
                        <div class="col-sm-4 col-lg-4 col-md-4">\
                         <div class="thumbnail">\
                            <img class="lazy" style="height: 26em" src="images/grey.gif" data-original="'+imagen+'" alt="">\
                            <button id="modalPedido" type="button" style="display: block; width: 100%;background: #222;border: 0px; border-radius: 0px 0px 5px 5px;" class="btn btn-info btn-lg modalPedido" data-toggle="modal" data-target="#myModal'+id+'">Encargar</button>\
                        </div>\
                        </div>\
                        \
                            <div id="myModal'+id+'" class="modal fade" role="dialog">\
                              <div class="modal-dialog">\
                                <div class="modal-content">\
                                  <div class="modal-header">\
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>\
                                    <h4 class="modal-title">Opciones para pedir tu juego</h4>\
                                  </div>\
                                <div class="modal-body">\
                                    <form action="PedidoJuegos.php" id="FormPedidoJuegos" method="post" class="form-horizontal">\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">CODIGO</label>\
                                            <div class="col-xs-5">\
                                                <input type="text" class="form-control" name="txtcod" readonly value="'+codigo+'"/>\
                                                <input type="hidden" class="form-control" name="txtcat" id="txtcat" value="'+categoria_id+'">\
                                                <input type="hidden" class="form-control" name="txtjid" id="txtjid" value="'+id+'">\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">JUEGO</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control" name="txtjue" readonly value="'+nombre+'"/>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">CANTIDAD</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control" name="txtcan" value="<?php echo $copias ?>"/>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">NOMBRE</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control txtnombre" name="txtnom" placeholder="Ingrese su nombre" />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">FORMA DE PAGO</label>\
                                            <div class="col-xs-5">\
                                                <select name="txtpag" id="txtpag" class="form-control">\
                                                    <option value="PAGADO">LO DEJO PAGADO</option>\
                                                    <option value="NO PAGO">LO PAGO CUANDO RETIRO</option>\
                                                </select>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <div class="panel panel-info">\
                                                <div class="panel-heading">Juegos a Comprar</div>\
                                                    <ul class="list-group listadoPedidoTmp">\
                                                    </ul>\
                                                </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <div class="col-xs-9 col-xs-offset-3">\
                                                <button type="submit" class="btn btn-success" name="btn" value="1">Seguir Comprando</button>\
                                                <button type="submit" class="btn btn-info" name="btn" value="2">Confirmar Pedido</button>\
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>\
                                            </div>\
                                        </div>\
                                    </form>\
                                </div>\
                              </div>\
                            </div>\
                            \
                    ');
                    
                }
            });
        });

        postConsola(0,"");
        var consolaActual=0;
        function postCategory(idCategoria){
            $.post("ajax/juegosCategoria.php",{ idCategoria : idCategoria , idConsola : consolaActual }).done(function(data){
                bgConsole="";
                $('#insertGame').html("");
                json=jQuery.parseJSON(data);
                var objeto=json.Juegos;
                for(i=0; i<= (objeto.length -1); i++){
                    id=objeto[i].id;
                    nombre=objeto[i].nombre;
                    codigo=objeto[i].codigo;
                    imagen=objeto[i].imagen;
                    categoria_id=objeto[i].categoria_id;
                    lanzamiento=objeto[i].lanzamiento;
                    descripcion=objeto[i].descripcion;
                    cantidad=objeto[i].cantidad;
                    voto=objeto[i].voto;
                    strStar='';
                    strStarEm='';
                    for(j=1; j<= voto; j++){ 
                    strStar+='<span class="glyphicon glyphicon-star"></span>';
                    }
                    for(j=1; j<= 5 - voto; j++){ 
                    strStarEm+='<span class="glyphicon glyphicon-star-empty"></span>';
                    }
$('#insertGame').append('\
                        \
                        <div class="col-sm-4 col-lg-4 col-md-4">\
                         <div class="thumbnail">\
                            <img class="lazy" style="height: 26em" src="images/grey.gif" data-original="'+imagen+'" alt="">\
                            <button id="modalPedido" type="button" style="display: block; width: 100%;background: #222;border: 0px; border-radius: 0px 0px 5px 5px;" class="btn btn-info btn-lg modalPedido" data-toggle="modal" data-target="#myModal'+id+'">Encargar</button>\
                        </div>\
                        </div>\
                        \
                            <div id="myModal'+id+'" class="modal fade" role="dialog">\
                              <div class="modal-dialog">\
                                <div class="modal-content">\
                                  <div class="modal-header">\
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>\
                                    <h4 class="modal-title">Opciones para pedir tu juego</h4>\
                                  </div>\
                                <div class="modal-body">\
                                    <form action="PedidoJuegos.php" id="FormPedidoJuegos" method="post" class="form-horizontal">\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">CODIGO</label>\
                                            <div class="col-xs-5">\
                                                <input type="text" class="form-control" name="txtcod" readonly value="'+codigo+'"/>\
                                                <input type="hidden" class="form-control" name="txtcat" id="txtcat" value="'+categoria_id+'">\
                                                <input type="hidden" class="form-control" name="txtjid" id="txtjid" value="'+id+'">\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">JUEGO</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control" name="txtjue" readonly value="'+nombre+'"/>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">CANTIDAD</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control" name="txtcan" value="<?php echo $copias ?>"/>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">NOMBRE</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control txtnombre" name="txtnom" placeholder="Ingrese su nombre" />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">FORMA DE PAGO</label>\
                                            <div class="col-xs-5">\
                                                <select name="txtpag" id="txtpag" class="form-control">\
                                                    <option value="PAGADO">LO DEJO PAGADO</option>\
                                                    <option value="NO PAGO">LO PAGO CUANDO RETIRO</option>\
                                                </select>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <div class="panel panel-info">\
                                                <div class="panel-heading">Juegos a Comprar</div>\
                                                    <ul class="list-group listadoPedidoTmp">\
                                                    </ul>\
                                                </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <div class="col-xs-9 col-xs-offset-3">\
                                                <button type="submit" class="btn btn-success" name="btn" value="1">Seguir Comprando</button>\
                                                <button type="submit" class="btn btn-info" name="btn" value="2">Confirmar Pedido</button>\
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>\
                                            </div>\
                                        </div>\
                                    </form>\
                                </div>\
                              </div>\
                            </div>\
                            \
                    ');
                    
                }
            });
        }
        function postConsola(id,t){
            $.post("ajax/listarJuegos.php",{ id : id }).done(function(data){
            consolaActual=id;
            bgConsole="";
            if(t!=""){  bgConsole=t.attr("imagen"); }
            else{ bgConsole="images/fondo.jpg";}
            
            $("body").attr("style" , "background:url("+bgConsole+");background-repeat:no-repeat;background-position: center center;background-attachment: fixed;background-size: cover;");
            
            $("span[id='contJuegos']").each(function(){
                $(this).html("");
            })
            
                $('#insertGame').html("");
                json=jQuery.parseJSON(data);
                var objeto=json.Juegos;
                for(i=0; i<= (objeto.length -1); i++){
                    id=objeto[i].id;
                    nombre=objeto[i].nombre;
                    codigo=objeto[i].codigo;
                    imagen=objeto[i].imagen;
                    categoria_id=objeto[i].categoria_id;
                    lanzamiento=objeto[i].lanzamiento;
                    descripcion=objeto[i].descripcion;
                    cantidad=objeto[i].cantidad;
                    voto=objeto[i].voto;
                    strStar='';
                    strStarEm='';
                    $("#contJuegos[idCategoria='"+categoria_id+"']").append("*");
                    for(j=1; j<= voto; j++){ 
                    strStar+='<span class="glyphicon glyphicon-star"></span>';
                    }
                    for(j=1; j<= 5 - voto; j++){ 
                    strStarEm+='<span class="glyphicon glyphicon-star-empty"></span>';
                    }
                    //<span class="glyphicon glyphicon-star-empty"></span>
                    $('#insertGame').append('\
                        \
                        <div class="col-sm-4 col-lg-4 col-md-4">\
                         <div class="thumbnail">\
                            <img class="lazy" style="height: 26em" src="images/grey.gif" data-original="'+imagen+'" alt="">\
                            <button id="modalPedido" type="button" style="display: block; width: 100%;background: #222;border: 0px; border-radius: 0px 0px 5px 5px;" class="btn btn-info btn-lg modalPedido" data-toggle="modal" data-target="#myModal'+id+'">Encargar</button>\
                        </div>\
                        </div>\
                        \
                            <div id="myModal'+id+'" class="modal fade" role="dialog">\
                              <div class="modal-dialog">\
                                <div class="modal-content">\
                                  <div class="modal-header">\
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>\
                                    <h4 class="modal-title">Opciones para pedir tu juego</h4>\
                                  </div>\
                                <div class="modal-body">\
                                    <form action="PedidoJuegos.php" id="FormPedidoJuegos" method="post" class="form-horizontal">\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">CODIGO</label>\
                                            <div class="col-xs-5">\
                                                <input type="text" class="form-control" name="txtcod" readonly value="'+codigo+'"/>\
                                                <input type="hidden" class="form-control" name="txtcat" id="txtcat" value="'+categoria_id+'">\
                                                <input type="hidden" class="form-control" name="txtjid" id="txtjid" value="'+id+'">\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">JUEGO</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control" name="txtjue" readonly value="'+nombre+'"/>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">CANTIDAD</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control" name="txtcan" value="<?php echo $copias ?>"/>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">NOMBRE</label>\
                                            <div class="col-xs-5">\
                                                <input type="txt" class="form-control txtnombre" name="txtnom" placeholder="Ingrese su nombre" />\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <label class="col-xs-3 control-label">FORMA DE PAGO</label>\
                                            <div class="col-xs-5">\
                                                <select name="txtpag" id="txtpag" class="form-control">\
                                                    <option value="PAGADO">LO DEJO PAGADO</option>\
                                                    <option value="NO PAGO">LO PAGO CUANDO RETIRO</option>\
                                                </select>\
                                            </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <div class="panel panel-info">\
                                                <div class="panel-heading">Juegos a Comprar</div>\
                                                    <ul class="list-group listadoPedidoTmp">\
                                                    </ul>\
                                                </div>\
                                        </div>\
                                        <div class="form-group">\
                                            <div class="col-xs-9 col-xs-offset-3">\
                                                <button type="submit" class="btn btn-success" name="btn" value="1">Seguir Comprando</button>\
                                                <button type="submit" class="btn btn-info" name="btn" value="2">Confirmar Pedido</button>\
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>\
                                            </div>\
                                        </div>\
                                    </form>\
                                </div>\
                              </div>\
                            </div>\
                            \
                    ');
                }

                $('.modalPedido').click(function() {
                      // Enviamos el formulario usando AJAX
                            $.ajax({
                                type: 'POST',
                                url: "ajax/listadoPedidoTmp.php",
                                data: $(this).serialize(),
                                // Mostramos un mensaje con la respuesta de PHP
                                success: function(data) {
                                    $('.listadoPedidoTmp').html("");
                                    json=jQuery.parseJSON(data);
                                    var objeto=json.Pedidos;
                                    for(i=0; i<= (objeto.length -1); i++){
                                        id=objeto[i].id;
                                        juego_cod=objeto[i].juego_cod;
                                        nombre_juego=objeto[i].nombre_juego;
                                        nombre_cliente=objeto[i].nombre_cliente;
                                        $('.listadoPedidoTmp').append('\
                                                <li class="list-group-item">'+nombre_juego+' <a class="btn btn-xs btn-danger pull-right" name="borrar" href="PedidoJuegos.php?borrar=1&idjuego='+id+'">Borrar</a></li>\
                                            ');
                                        $('.txtnombre').val(nombre_cliente);
                                    }
                                    }
                            })        
                });

                $("span[id='contJuegos']").each(function(){
                    str=$(this).html();
                    split=str.split("*");
                    splitLen = split.length -1;
                    $(this).html(splitLen);
                });
            });
        }
    </script>
    <script type="text/javascript">
    $(document).ready(function() { 
        $("#scrollthis").niceScroll({cursorcolor:"#222"});
      }
    );
    </script>
    <script type="text/javascript">
    $(function(){
        $("img.lazy").lazyload();
            effect : "fadeIn"
    });
    </script>

</html>
