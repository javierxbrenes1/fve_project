
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Links de css -->
        <link href="Assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="Assets/css/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="Assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="Assets/js/bootstrap.min.js" type="text/javascript"></script>
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
       

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalLogin">
  Launch demo modal
</button>

<!-- Modal -->
   <div class="modal fade" id="modalLogin">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          
            <div class="modal-header" style="background-color: #3e8f3e;">
              <h4>Frutas y verduras Express</h4> 
          </div>
          
          <div class="modal-body">
            <form method="POST" data-toggle="validator" role="form">
              <div class="form-group">
                <!-- Ingrese su nombre-->
                <label for="txtNomCli" class="control-label">Nombre</label>
                <input type ="text" class="form-control" id="txtNomCli" placeholder= "&#xf007; Ingrese su nombre.." required/>
              </div>
              <div class="form-group"> 
                <label for="txtEmail" required>Email</label>
                <input type="email" class="form-control" id ="txtEmail"
                placeholder="&#xf003; Escribe tu email..." required>
              </div>
              <div class="form-group">  
                  <label for="txtTel">Teléfono Principal</label>
                  <input type="text" class="form-control" id="txtTel" 
                         placeholder="&#xf095; Escribe tu teléfono principal..." required>
              </div>
              <div class="form-group">  
                  <label for="txtTelAux">Teléfono Secundario</label>
                  <input type="text" class="form-control" id="txtTel" 
                         placeholder="&#xf095; Escribe tu teléfono secundario...">
              </div>
                <div class="form-group">  
                  <label for="txtDir">Direccion Exacta</label>
                  <textarea name="textarea" class="form-control" 
                            rows="3" cols="50" required></textarea>
              </div>
              <button type="submit" class="btn btn-success btn-block">Enviar Pedido</button>
           </div>
              <div class="modal-footer">
                  
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

</body>
</html>
