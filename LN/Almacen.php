<?php
    include 'Carrito.php';
    include '../model/Productos.php';
    $vloProdId = $_GET['id'];
    $vloProdCantidad = $_GET['cant'];
    $vloCarrito = new Carrito();
    $vloProd =  Array();
    if($vloProdId==-1 && $vloProdCantidad==-1)
    {
        $vloCarrito->destroy();
        echo "Carrito limpio";
    }
    else
    {
        //Busca el producto
        $vloProducto = new Productos();
        $ProductoSeleccionado = $vloProducto->ObtenerDetallesArt($vloProdId);
        
        while($vloFila  = mysql_fetch_array($ProductoSeleccionado))
        {
            $vloProd = array("id" => $vloProdId,
                             "cantidad" => $vloProdCantidad,
                             "precio" => $vloFila['prod_prc_act'],
                             "nombre" => $vloFila['prod_nom'],
                             "img" => $vloFila['prod_rut_img'] );
        }

        $vloCarrito->add($vloProd);
        $total = $vloCarrito->articulos_total();
        $vloCodHtml  = "";
        //Crear el codigo html que se muestra en el carrito 
        $Productos = $vloCarrito->get_content();
        //Recorre los productos
        for($vloI = 0; $vloI < count($Productos);$vloI++)
        {
            $Subtotal = $Productos['cantidad'][$vloI]*$Productos['prod_prc_act'][$vloI];
//            $vloCodHtml = $vloCodHtml."<div>"
//                    . "<p>".$Productos['prod_nom'][$vloI]."</p> ".
//                      "<p>".$Productos['cantidad'][$vloI]."</p>".
//                      "<p>".$Subtotal."</p>"
//                    . "</div>";
            echo "hola";
        }
        echo $vloCodHtml;
    }
  
    //include 'Carrito.php';
    //echo $vloCarrito->articulos_total();
