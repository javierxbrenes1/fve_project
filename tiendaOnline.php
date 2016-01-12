
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
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/funciones.js" type="text/javascript"></script>
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
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
                        <img class="img-thumbnail imgProd" src="assets/img/<?php echo $vloResultado['prod_rut_img']; ?>"/>
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
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalEnvio">
  Launch demo modal
</button>

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
    </div>

</body>
</html>
