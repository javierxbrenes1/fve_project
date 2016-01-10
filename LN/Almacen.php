<?php
    //Zona de includes necesarios para este script
    include 'Carrito.php';
    include '../model/Productos.php';
    //Obtiene los datos por el metodo GET
    $vlcProdId = $_GET['id'];
    $vlnProdCantidad = $_GET['cant'];
    //Crea instancia de Carrito
    $vloCarrito = new Carrito();
    //Crea un nuevo arreglo de datos
    $vloProd =  Array();
    //Crea Variable para el codigo html a devolver
    $vlcCodHtml  = "";
    if($vlcProdId==-1 && $vlnProdCantidad==-1)
    {
        $vloCarrito->destroy();
        echo 'Carrito destruido';
    }
    else
    {
        //Busca el producto
        //Crea una instancia de producto
        $vloProducto = new Productos();
        //Busca el producto por el id
        $ProductoSeleccionado = $vloProducto->ObtenerDetallesArt($vlcProdId);
        
        //Si el producto existe 
        if(mysql_num_rows($ProductoSeleccionado) > 0)
        {
            //Ingresa el articulo al carrito
            while($vloFila  = mysql_fetch_array($ProductoSeleccionado))
            {
                //Crea un array con los datos del carrito
                $vloProd = array("id" => $vlcProdId,
                                 "cantidad" => $vlnProdCantidad,
                                 "precio" => $vloFila['prod_prc_act'],
                                 "nombre" => $vloFila['prod_nom'],
                                 "img" => $vloFila['prod_rut_img'] );
            }
            //Agrega el carrito    
            $vloCarrito->add($vloProd);
        }
        
        // Obtiene el total de productos en el carrito
        $vlntotal = $vloCarrito->articulos_total();
        //Si hay mas de un articulo
         if($vlntotal > 0)
         {
            //Crear el codigo html que se muestra en el carrito 
            $Productos = $vloCarrito->get_content();
            $vlcCodHtml = "<div>";
            $vlcCodHtml = $vlcCodHtml.'<table class="table table-striped"';
            foreach($Productos as $vloFila)
            {
                $Subtotal = $vloFila['cantidad']*$vloFila['precio'];
                $vlcCodHtml = $vlcCodHtml."<tr>";
                $vlcCodHtml = $vlcCodHtml."<td>".'<img class="img-circle" width="50" height="50" src="Assets/img/'.$vloFila['img'].'">'."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".$vloFila['nombre']."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".$vloFila['cantidad']."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."<td>"."<p>".$Subtotal."</p>"."</td>";
                $vlcCodHtml = $vlcCodHtml."</tr>";
            }
            $vlcCodHtml = $vlcCodHtml.'</table>';
            $vlcCodHtml = $vlcCodHtml."</div>";
         }
        echo $vlcCodHtml;
        
    }
  
    
