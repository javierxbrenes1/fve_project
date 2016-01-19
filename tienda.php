<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda verfruta express</title>
    </head>
    <!-- Links de css -->
        <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/funciones.js" type="text/javascript"></script>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <!-- Google fonts -->	
	<link href='https://fonts.googleapis.com/css?family=Crete+Round:400,400italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300' rel='stylesheet' type='text/css'>
    <body>
        <div id="TobBar">
            <img src="#" class="pull-left"/>
            <ul class="list-inline pull-right">
                <li><i class="fa fa-shopping-cart"></i>  Carrito</li>
                <li><i class="fa fa-check"></i>  Checkout</li>
            </ul>
        </div>
        <nav class="navbar navbar-default BarraCategorias">
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
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Buscar Producto" name="q">
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
              <li data-target="#carousel-example-generic" data-slide-to="4"></li>
            </ol>

             
            <div class="carousel-inner" style='height: auto'>
                <div class="item active">
                    <img  src="assets/images/slider3.jpg" height="150" alt="...">
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
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h2 id="lblCatProd">Ofertas</h2>
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
        </section>
        <footer class="footer">
            <div class="container-fluid text-right">
                <p>Tienda Online  Verfruta-Express &copy; 2016 | Trabajamos para usted con <i class="fa fa-heart"></i></p>
            </div>
        </footer>
    </body>
</html>
