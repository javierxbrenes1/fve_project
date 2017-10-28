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

        $vlntotalReg = $vloCarrito->articulos_total();
        $vloDetCarrito = include 'MostrarCarrito.php';
        if($vlbRes)
        {
          echo $vloDetCarrito."|".$vlntotalReg;
        }else{
            echo $vloDetCarrito."|".$vlntotalReg."|El producto no pudo eliminarse.";
        }


}
