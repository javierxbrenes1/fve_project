
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Links de css -->
        <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/funciones.js" type="text/javascript"></script>
        <script src="assets/js/jquery.meanmenu.js"></script>
	<script src="assets/js/bootstrap-select.js"></script>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        
        <!-- Google fonts -->	
	<link href='https://fonts.googleapis.com/css?family=Crete+Round:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
    </head>
    <body style="overflow-x:hidden;">
        
        <div class="barra-superior">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6 pull-right">
                        <ul class="pull-right lstEncabezado">
                            <li  class="btnCarrito"><i class="fa fa-shopping-cart"></i> Carrito (X)</li>
                            <li><i class="fa fa-check"></i> Aceptar Pedido</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="TiendaDetalle">
            <div id="pnlPagina">
                <div class="imgLogo">
                    <img class="img-responsive center-block" src="http://lorempixel.com/400/200/" width="300" height="300"/> 
                </div>
                <nav role="navigation" class="navbar navbar-default mnuCategoria">
                        <div class="navbar-header">
                            <button type="button"  data-target="#navbarCollapse" data-toggle="collapse" aling="center" class="navbar-toggle BotonMenu">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbarCollapse" class="collapse navbar-collapse Categorias">
                            <ul class="nav navbar-nav" id="lstCat">
                                <li value="0">Ofertas</li>
                                <li value="1">Vegetales</li>
                                <li value="3">Mini Vegetales</li>
                                <li value="2">Frutas</li>
                                <li value="4">Productos Varios</li>
                            </ul>
                        </div>
                </nav>
                <div class="container">
                <div class="row Productos">
                    <div id="lblCatProd" class="col-md-12 text-center">
                        <h3>Ofertas de la semana</h3>
                        <hr />
                    </div>
                </div>
                
                <div class="row Productos" id="pnlProdCategoria">
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
                    <div class="col-md-3 col-sm-4 col-xs-6 text-center Producto">
                        <div class="pnlMarco">    
                            <div>
                                <img class="img-responsive center-block imgProd"  src="assets/img/<?php echo $vloResultado['prod_rut_img']; ?>"/>
                            </div>
                            <div >
                                <p class="ProdNom"><?php echo $vloResultado['prod_nom']?></p>
                            </div>
                            <div>
                                <input type="text" class="form-control txtCantidad" id="<?php echo $vloResultado['prod_id']; ?>"/>
                                <label class="lblKilo">. <?php echo $vloResultado['prod_unit_med'] ?></label>
                                <p class="PrecioArticulo">Precio: ₡ <?php echo $vloResultado['prod_prc_act']?></p>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success btnComprar" value="<?php echo $vloResultado['prod_id'];?>" />
                                    <i class="fa fa-cart-plus"></i> Agregar
                                </button>
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
            </div>    
        <!-- Carrito de compras -->
            <div id="pnlCarrito">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-9">
                            <h4>Carrito de compras</h4>
                        </div>
                        <div class="col-xs-3">
                            <h4 class="pull-right"><a class="btnCarrito">X</a></h4>
                        </div>
                        <div class="col-xs-12"><hr /></div>
                    </div>
                </div>
            </div>
     </div>
<!-- Modal -->
   <div class="modal fade" id="modalEnvio">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          
            <div class="modal-header" style="background-color: #3e8f3e;">
              <h4>Frutas y verduras Express</h4> 
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
                  <input type="text" class="form-control" id="txtTel" name="TelPrincipal"
                         placeholder="&#xf095; Escribe tu teléfono principal..." required oninvalid="this.setCustomValidity('Por Favor ingrese un teléfono válido para comunicarnos con usted')" oninput="setCustomValidity('')">
              </div>
              <div class="form-group">  
                  <label for="txtTelAux">Teléfono Secundario</label>
                  <input type="text" class="form-control" id="txtTelAux" name="TelSecundario"
                         placeholder="&#xf095; Escribe tu teléfono secundario...">
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
                      <select id="cboZona" name="Zona" required>
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
