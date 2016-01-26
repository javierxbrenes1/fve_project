<?php ob_start();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
        <title>Tienda verfruta express</title>
    </head>
    <!-- Links de css -->
        <script src="assets/lib/sweetalerts/sweetalert.min.js" type="text/javascript"></script>
        <link href="assets/lib/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/estilos.css" rel="stylesheet" type="text/css"/>
        
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.numeric.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        
        <script src="assets/js/funciones.js" type="text/javascript"></script>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Google fonts -->	
	<link href='https://fonts.googleapis.com/css?family=Crete+Round:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
        <body>
     <div id="wrapper">   
        <div id="TopBar">
            <img src="assets/img/index.jpg" height="40" width="40" class="img-circle pull-left img-logo"/>
            <ul class="list-inline pull-right">
                <?php 
                    if(!class_exists('Carrito')){ 
                        include 'LN/Carrito.php';
                    }
                    
                    $vloCarrito = new Carrito();
                    $vlnTotalArt = $vloCarrito->articulos_total();
                    $vlnConc = "";
                    if($vlnTotalArt > 0) { $vlnConc = " (".$vlnTotalArt.")";}
                ?>
                <li class="btnCarrito"><i class="fa fa-shopping-cart"></i>  Carrito <?php echo $vlnConc;?></li>
                <li data-toggle="modal" data-target="#modalEnvio"><i class="fa fa-check"></i>  Aceptar pedido</li>
            </ul>
        </div>
         <div class="pull-right Back">
             <a href="#Menu"> <i class="fa fa-arrow-up"></i> </a>
         </div> 
         <nav class="navbar navbar-default BarraCategorias" id="Menu">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse Categorias">
                    <ul class="nav navbar-nav" id="lstCat">
                        <li value="0"><a>Ofertas</a></li>
                        <li value="1"><a>Vegetales</a></li>
                        <li value="3"><a>Mini-Vegetales</a></li>
                        <li value="2"><a>Frutas</a></li>
                        <li value="4"><a>Otros productos</a></li>
                    </ul>
                     <div class="col-sm-3 col-md-3 pull-right">
                         <form class="navbar-form" role="form" id="BuscarProd">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar Producto" id="txtParam">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </nav>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
             
            <ol class="carousel-indicators hidden-xs" >
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
              <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ol>

             
            <div class="carousel-inner" style='height: auto'>
                <div class="item active">
                  <img  class="img-responsive" src="assets/images/slider3.jpg" height="150" alt="...">
                </div>
                <div class="item">
                  <img class="img-responsive" src="assets/images/slider1.jpg" height="150" alt="...">
                </div>
                <div class="item">
                  <img class="img-responsive" src="assets/images/slider2.jpg" height="150" alt="...">
                </div>
                <div class="item">
                  <img class="img-responsive" src="assets/images/slider4.jpg" height="150" alt="...">
                </div>
            </div>
        </div>  
         <div id="content"> 
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 id="lblCatProd">Ofertas</h2>
                        <div class="border-green"></div>
                    </div>
                </div>
                <hr />
                <div class="row" id="pnlProdCategoria">
                    <?php
                    if(!class_exists('Productos')){ 
                        include 'model/Productos.php';
                    }
                    $vloProductos = new Productos();
                    //Obtiene las filas devueltas.
                    $resultado = $vloProductos->ProductosEnPromocion();
                    //verificar si se devolvieron registros
                    $vloCantRegistros = mysql_num_rows($resultado);
                    if($vloCantRegistros>0){
                    while($vloResultado = mysql_fetch_array($resultado))
                    {
                    ?>
                    <div class="col-md-3 col-sm-4 col-xs-12 text-center Producto">
                        <div class="fve-borde-beneficios">
                            <div class="pnlMarco">    
                                <div>
                                    <img class="img-responsive center-block imgProd"  src="assets/img/<?php echo $vloResultado['prod_rut_img']; ?>"/>
                                </div>
                                <div >
                                    <p class="ProdNom"><strong><?php echo $vloResultado['prod_nom']?></strong></p>
                                </div>
                                <div>
                                    <input type="text" class="form-control txtCantidad decimal" maxlength="5" id="<?php echo $vloResultado['prod_id']; ?>"/>
                                    <label class="lblKilo"> <?php echo $vloResultado['prod_unit_med'] ?></label>
                                    <p class="PrecioArticulo">Precio: ₡ <?php echo $vloResultado['prod_prc_act']?></p>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-success btnComprar" onclick="pAgregarProd(<?php echo $vloResultado['prod_id'];?>)"value="<?php echo $vloResultado['prod_id'];?>" />
                                        <i class="fa fa-cart-plus"></i> Agregar
                                    </button>
                                </div>
                                <div class="EnOferta">
                                <p>oferta</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <?php        
                    } //Fin de while
                    } //fin if si hubieron filas
                    else  //si no hay filas 
                    {?>
                        <!--crea un h1 indicando que no hay articulos en promocion-->
                        <h1 class="text-center">No hay productos en promoción</h1>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
                 
        </div>
         <div id="push"></div>     
    </div>
    <div id="footer">
        <div class="container-fluid text-right">
            <p>Tienda Online  Verfruta-Express &copy; 2016 | Trabajamos para usted con <i class="fa fa-heart"></i></p>
        </div>
    </div>
    <div class="modal fade" id="modalEnvio">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          
            <div class="modal-header" style="background-color: #6A5854; color:#fff; text-align: center; border-radius: 2px;">
                <p class="pull-right CerrarModal">X</p>  
              <h4>Verfruta Express.</h4> 
          </div>
          
          <div class="modal-body">
              <form data-toggle="validator" role="form" id="FormPedido">
              <div class="form-group">
                <!-- Ingrese su nombre-->
                <label for="txtNomCli" class="control-label">Nombre</label>
                <input type ="text" class="form-control" id="txtNomCli" name="clienteNombre" placeholder= "&#xf007; Ingrese su nombre.." required oninvalid="this.setCustomValidity('Por Favor ingrese un nombre válido')" oninput="setCustomValidity('')" />
              </div>
              <div class="form-group"> 
                <label for="txtEmail" required>Email</label>
                <input type="email" class="form-control" id ="txtEmail" name="Email"
                placeholder="&#xf003; Escribe tu email..." required oninvalid="this.setCustomValidity('Por Favor ingrese un correo electronico válido')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">  
                  <label for="txtTel">Teléfono Principal</label>
                  <input type="text" pattern="^[2|8|7|6]\d{7}$" class="form-control" id="txtTel" name="TelPrincipal"
                         placeholder="&#xf095; Tel. Principal. Ejm:(88888888)" required oninvalid="this.setCustomValidity('Por Favor ingrese un teléfono válido para comunicarnos con usted, en formato (88888888).')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">  
                  <label for="txtTelAux">Teléfono Secundario</label>
                  <input type="text" pattern="^[2|8|7|6]\d{7}$" class="form-control" id="txtTelAux" name="TelSecundario"
                         placeholder="&#xf095; Tel. Secundario.">
              </div>
                <!--<div class="form-group">-->  
                  <!--<label for="cboZona">Zona de entrega: </label>-->
                  <?php
                    include 'model/Zonas.php';
                    //crea instancia de Zonas
                    $vloZonas = new Zonas();
                    //Obtiene las zonas
                    $vloZonasDeEntrega = $vloZonas->ObtenerZonas();
                    $vlnTotReg = mysql_num_rows($vloZonasDeEntrega);
                    if($vlnTotReg > 0)
                    {
                  ?>
                  <div class="form-group">
                      <label for="cboZona">Zona de entrega: </label>
                      <select id="cboZona" name="Zona" class="form-control"required>
                       <?php
                        while($vloFila = mysql_fetch_array($vloZonasDeEntrega))
                        {
                            echo '<option value="'.$vloFila['zon_id'].'">'.$vloFila['zon_nom'].'</option>';
                        }
                       ?>
                      </select>
                  </div>
                  <?php
                  }
//                    }else
//                    {
//                        echo "no hay zonas";
//                    }
                    //crea el objeto 
                  ?>
                  
              <!--</div> -->
                <div class="form-group">  
                    <label for="txtDir">Direcci&oacute;n Exacta</label>
                  <textarea id="txtDir" name="Direccion" class="form-control" 
                            rows="3" cols="50" required oninvalid="this.setCustomValidity('Por Favor ingrese su dirección de forma correcta para hacer llegar su pedido.')" oninput="setCustomValidity('')"></textarea>
              </div>
              <button type="submit" class="btn btn-success btn-block" id="btnEnviarPedido">Enviar Pedido</button>
           </div>
              <div class="modal-footer">
                  
              </div>
            </form>
          </div>
        </div>
      </div>        
    </body>
</html>
<?php ob_end_flush();