<?php
if(!class_exists('Carrito')){ 
        include 'Carrito.php'; 
    }
    
    //Crea instancia de Carrito
    $vloCarrito = new Carrito();
    
// Obtiene el total de productos en el carrito
        $vlntotal = $vloCarrito->articulos_total();
        //Si hay mas de un articulo
         if($vlntotal > 0)
         {
            //Crear el codigo html que se muestra en el carrito 
            $Productos = $vloCarrito->get_content();
            $vlcCodHtml = '<div class="table-responsive" id="TablaCarrito">';
            $vlcCodHtml = $vlcCodHtml.'<table class="table">';
            $vlcCodHtml = $vlcCodHtml.'<thead>';
            $vlcCodHtml = $vlcCodHtml.'<th align="center"></th>';
            $vlcCodHtml = $vlcCodHtml.'<th align="center"></th>';
            $vlcCodHtml = $vlcCodHtml.'<th align="center">Producto</th>';
            $vlcCodHtml = $vlcCodHtml.'<th align="center">Cantidad</th>';
            $vlcCodHtml = $vlcCodHtml.'<th align="center">Precio unitario</th>';
            $vlcCodHtml = $vlcCodHtml.'<th align="center">Subtotal</th>';
            $vlcCodHtml = $vlcCodHtml.'<th align="center">Observación</th>';
            $vlcCodHtml = $vlcCodHtml.'<th align="center"></th>';
            $vlcCodHtml = $vlcCodHtml.'</thead>';
            $vlcCodHtml = $vlcCodHtml.'</tbody>';
            //Variables para el total
            $vlnTotalProductos = 0;
            $vlnMontoTotal = 0;
            foreach($Productos as $vloFila)
            {
                $vlnTotalProductos +=1;
                $vlnSubtotal = $vloFila['cantidad']*$vloFila['precio'];
                $vlcObservacion = $vloFila['Observacion'];
                $vlnMontoTotal += $vlnSubtotal;
                $vlnFormatoSubTotal =  number_format ( $vlnSubtotal, 2 , "." , ",");
                $vlnPrecioUnitario = number_format ( $vloFila['precio'], 2 , "." , ",");
                $vlcCodArticulo = $vloFila['id'];
                $vlcCodHtml = $vlcCodHtml."<tr>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".number_format ($vlnTotalProductos, 0 , "." , ",")."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>".'<img class="img-circle" width="50" height="50" src="assets/img/'.$vloFila['img'].'">'."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".$vloFila['nombre']."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".$vloFila['cantidad'].' '.$vloFila['unidad']."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".$vlnPrecioUnitario."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".$vlnFormatoSubTotal."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".$vlcObservacion."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."<td><span class=";
                $vlcCodHtml = $vlcCodHtml.'"table-remove glyphicon glyphicon-remove lblEliminarArt"';
                $vlcCodHtml = $vlcCodHtml."onclick=";
                $vlcCodHtml = $vlcCodHtml."ElimProd('".$vlcCodArticulo."')";
                $vlcCodHtml = $vlcCodHtml.';></span></td>';
                $vlcCodHtml = $vlcCodHtml."</tr>";
            }
            $vlcCodHtml = $vlcCodHtml.'<tr>';
            $vlcCodHtml = $vlcCodHtml.'<td> <h4> Total: </h4> </td>';
            $vlcCodHtml = $vlcCodHtml.'<td></td>';
            $vlcCodHtml = $vlcCodHtml.'<td></td>';
            $vlcCodHtml = $vlcCodHtml.'<td></td>';
            $vlcCodHtml = $vlcCodHtml.'<td><h4>'.number_format ( $vlnMontoTotal, 2, "." , ",").' COL.</h4> </td>';
            $vlcCodHtml = $vlcCodHtml.'<td><td>';
            $vlcCodHtml = $vlcCodHtml.'</tr>';
            $vlcCodHtml = $vlcCodHtml.'</tbody>';
            $vlcCodHtml = $vlcCodHtml.'</table>';
            $vlcCodHtml = $vlcCodHtml."</div>";
            
            //Al final se agrega un boton para desplegar el formulario de envio 
            
            $vlcCodHtml = $vlcCodHtml.'<button type="button" class="btn btn-success btn-lg pull-right" style="margin-bottom:20px; margin-left:20px;" onclick="VerOfertas();">
            <i class="fa fa-arrow-circle-left"></i>  Volver a comprar </button>';
            
            $vlcCodHtml = $vlcCodHtml.'<button type="button" class="btn btn-success btn-lg pull-right" data-toggle="modal" data-target="#modalEnvio" style="margin-bottom:20px;">
            <i class="fa fa-check"></i>  Aceptar pedido </button>';
            
         }
         else{
             
             $vlcCodHtml = '<h1 class="text-center"> El carrito se encuentra vacio.</h1>';
         }
         echo $vlcCodHtml;
        