<?php
//verific la instancia de 
if(!class_exists('Carrito')){ 
        include 'Carrito.php'; 
}
    
$vlcCodProduct = $_POST['id'];

if($vlcCodProduct!="")
{
    $vloCarrito = new Carrito();
    $vlbRes = $vloCarrito->remove_producto($vlcCodProduct);
    if($vlbRes)
    {
        $vlntotalReg = $vloCarrito->articulos_total();
        $vloDetCarrito = include 'MostrarCarrito.php'; 
        echo $vloDetCarrito."|".$vlntotalReg;
    }
   
}

