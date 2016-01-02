
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Links de css -->
        <link href="Assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="Assets/css/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="Assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="Assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="Assets/js/funciones.js" type="text/javascript"></script>
        <link href="Assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container-fluid">  
            <div class="container">    
                <?php
                include 'model/Productos.php';
                $vloProductos = new Productos();
                $resultado = $vloProductos->Catalogo(true);
                while($vloResultado = mysql_fetch_array($resultado))
                {
                ?>
                <div class="col-md-3 col-sm-4 col-xs-6 text-center Producto">
                    <div class="img-responsive">
                        <img class="img-thumbnail imgProd" src="Assets/img/<?php echo $vloResultado['prod_rut_img']; ?>"/>
                    </div>
                    <div >
                        <p class="ProdNom"><?php echo $vloResultado['prod_nom']?></p>
                    </div>
                    <div>
                        <input type="text" class="form-control txtCantidad" id="<?php echo $vloResultado['prod_id']; ?>"/>
                        <label class="lblKilo">.KG</label>
                        <p class="PrecioArticulo">Precio: ₡ <?php echo $vloResultado['prod_prc_act']?></p>
                    </div>
                    <div>
                        <button type="button" class="btn btn-success btnComprar" value="<?php echo $vloResultado['prod_id'];?>" />
                            <i class="fa fa-cart-plus"></i> Agregar
                        </button>
                    </div>
                </div>
                <?php        
                } //Fin de while
                ?>
            </div>
            <div id = "carrito">
                <div>
                    <p>Carrito</p>
                </div>
            </div>
        </div>    
        <button onclick="LimpiarCarrito()"> Limpiar Carrito </button>
        <button onclick="OcultarCarrito()">Ocultar Carrito </button>
</body>
</html>
