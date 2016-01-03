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
        //echo count($Productos);
        //echo $Productos["nombre"][0];
//        foreach($Productos as $C)
//        {
//            echo "hola";
//            echo $C["nombre"];
//        }
        
        $vloCodHtml = "<div>";
        $vloCodHtml = $vloCodHtml.'<table class="table table-striped"';
        foreach($Productos as $vloFila)
        {
            $Subtotal = $vloFila['cantidad']*$vloFila['precio'];
            $vloCodHtml = $vloCodHtml."<tr>";
            $vloCodHtml = $vloCodHtml."<td>".'<img class="img-circle" width="50" height="50" src="Assets/img/'.$vloFila['img'].'">'."</td>";
            $vloCodHtml = $vloCodHtml."<td>"."<p>".$vloFila['nombre']."</p>"."</td>";
            $vloCodHtml = $vloCodHtml."<td>"."<p>".$vloFila['cantidad']."</p>"."</td>";
            $vloCodHtml = $vloCodHtml."<td>"."<p>".$Subtotal."</p>"."</td>";
            $vloCodHtml = $vloCodHtml."</tr>";
        }
        $vloCodHtml = $vloCodHtml.'</table>';
        $vloCodHtml = $vloCodHtml."</div>";
        echo $vloCodHtml;
    }
  
    //include 'Carrito.php';
    //echo $vloCarrito->articulos_total();
