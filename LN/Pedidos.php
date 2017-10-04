<?php
    //Valida la existencia de la instancia de carrito
    if(!class_exists('Carrito')){ 
        include 'Carrito.php'; 
    }
    if(!class_exists('Zonas')){ 
    include '../model/Zonas.php'; 
}
    include '../model/ADPedidos.php';
    include 'Notificacion.php';
/**
 *Desarrollador: Javier Brenes
 *        Fecha: 9/Enero/2016
 * Descripcion: Script de logica de negocio que se encarga de almacenar 
 * los pedidos a nivel de BD y de notificar al cliente su pedido asi como a la parte 
 * encargada de preparar el pedido
 */
    
   
//Obtiene los valores enviados desde el post
$vlcNombre = $_GET['clienteNombre'];
$vlcEmail = $_GET['Email'];
$vlnTelPrinc = $_GET['TelPrincipal'];
$vlcTelSec = $_GET['TelSecundario'];
$vlnZona = $_GET['Zona'];
$vlcDireccion = $_GET['Direccion'];

$vloObjeto = (object) array('codigo'=>'99', 'mensaje'=>'', 'Tipo' => '', 'Titulo' => '', 'Boton' => '');
 
try{
//Crea instancia del carrito 
$vloCarrito = new Carrito();
//Crea instancia de ADPedidos
$vloADPedidos = new ADPedidos();
//Obtener el total de articulos
$vlnCantTotalArt = $vloCarrito->articulos_total();
//Si al menos existe un articulo 
if($vlnCantTotalArt > 0){
    //Obtener el monto total a pagar
    $vlnMontoTotalCarrito = $vloCarrito->precio_total();
    //Obtiene los articulos almacenados
    $VloArticulosComprados = $vloCarrito->get_content();
    /*********************** PRIMER PASO ALMACENAR EL PEDIDO *************************/
    //Obtiene el id del pedido 
    $vlcIDPedido = $vloADPedidos->InicializarPedido($vlcNombre, $vlcEmail, $vlnTelPrinc, 
                                                    $vlcTelSec, $vlcDireccion, $vlnZona, 
                                                    $vlnCantTotalArt, $vlnMontoTotalCarrito);

    if($vlcIDPedido!=''){
        //Envia a guardar el detalle
        $vloADPedidos->GuardarDetalle($vlcIDPedido,$VloArticulosComprados);

        /***********************SEGUNDO PASO ENVIAR EL PEDIDO POR CORREO********************/ 
        $vloZonas = new Zonas();
        $vlnSubtotal = 0;
        $vlnFormatoSubTotal = '';
        $vlcZonaNombre = $vloZonas->ObtenerDescripcionZona($vlnZona);
        //define la fecha
        $vldhoy = getdate();
        //crea fecha de solicitud de pedido
        $vlcFechaPedido = $vldhoy['mday'].'/'.$vldhoy['mon'].'/'.$vldhoy['year']; 
        $vlcBody = '<div style="margin:0 auto; border: #fff solid 2px; border-radius: 10px; box-shadow: 2px 2px 5px #888888; width: 400px; height: auto; text-align: center">';
        $vlcBody= $vlcBody.'<div style="background-color: #088A08; margin-top: 0; border-radius:10px 10px 0px 0px; position: relative; display: inline-block; color: #fff;">';
        $vlcBody= $vlcBody.'<p>Saludos '.$vlcNombre.', gracias por comprar a travez de frutas y verduras express. A continuaci&oacute;n el detalle de su pedido.</p>';
        $vlcBody= $vlcBody.'</div>';
        $vlcBody= $vlcBody.'<hr align="center" width="99%">';
        $vlcBody= $vlcBody.'<div style="text-align: left;">';
        $vlcBody= $vlcBody.'<p><strong>Pedido N&uacute;mero: </strong>'.$vlcIDPedido.'</p>'; 
        $vlcBody= $vlcBody.'<p><strong>Fecha del pedido: </strong>'.$vlcFechaPedido.'</p>';
        $vlcBody= $vlcBody.'<p><strong>Zona de pedido: </strong>'.$vlcZonaNombre.'</p>';
        $vlcBody= $vlcBody.'<p><strong>Direcci&oacute;n: </strong>'.$vlcDireccion.'</p>';
        $vlcBody= $vlcBody.'<p><strong>N&uacute;m. de tel&eacute;fono: </strong>'.$vlnTelPrinc.'</p>';
        if($vlcTelSec!='')
        {
            $vlcBody= $vlcBody.'<p><strong>N&uacute;m. de tel&eacute;fono Secundario: </strong>'.$vlcTelSec.'</p>';
        }
        $vlcBody= $vlcBody.'</div>';
        $vlcBody= $vlcBody.'<hr align="center" width="99%">';
        $vlcBody= $vlcBody.'<hr align="center" width="99%">';
        $vlcBody= $vlcBody.'<div style="text-align: center;">';
        $vlcBody= $vlcBody.'<table align="center" style="border-collapse: collapse;">';
        $vlcBody= $vlcBody.'<th style="text-align: left; padding: 5px 10px 5px 0px; border-bottom: 0.2px solid #000;">Cant.</th>';
        $vlcBody= $vlcBody.'<th style="text-align: left; padding: 5px 10px 5px 0px; border-bottom: 0.2px solid #000;">Producto</th>';
        $vlcBody= $vlcBody.'<th style="text-align: left; padding: 5px 10px 5px 0px; border-bottom: 0.2px solid #000;">Precio unit.</th>';
        $vlcBody= $vlcBody.'<th style="text-align: left; padding: 5px 10px 5px 0px; border-bottom: 0.2px solid #000;">Subtotal</th>';

        foreach($VloArticulosComprados as $vloFila)
        {
            $vlnSubtotal = $vloFila['cantidad'] * $vloFila['precio'];
            $vlnFormatoSubTotal =  number_format ( $vlnSubtotal, 2 , "." , ",");
            $vlcBody= $vlcBody.'<tr>';
            $vlcBody= $vlcBody.'<td style="text-align: left; padding: 5px 10px 5px 0px; border-bottom: 0.2px solid #000;">'.$vloFila['cantidad'].' '.$vloFila['unidad'].'</td>';
            $vlcBody= $vlcBody.'<td style="text-align: left; padding: 5px 10px 5px 0px; border-bottom: 0.2px solid #000;">'.$vloFila['nombre'].'</td>';
            $vlcBody= $vlcBody.'<td style="text-align: left; padding: 5px 10px 5px 0px; border-bottom: 0.2px solid #000;">'.number_format ($vloFila['precio'], 2 , "." , ",").'</td>';
            $vlcBody= $vlcBody.'<td style="text-align: left; padding: 5px 10px 5px 0px; border-bottom: 0.2px solid #000;"> '.$vlnFormatoSubTotal.'</td>';
            $vlcBody= $vlcBody.'</tr>';
        }
        $vlcBody= $vlcBody.'</table>';
        $vlcBody= $vlcBody.'</div>';
        $vlcBody= $vlcBody.'<div style="text-align: right;">';
        $vlcBody= $vlcBody.'<p style="margin-right: 50px; font-size: 20px;">';
        $vlcBody= $vlcBody.'<strong>Total: </strong> '.number_format ( $vlnMontoTotalCarrito, 2 , "." , ",");;
        $vlcBody= $vlcBody.'</p>';
        $vlcBody= $vlcBody.'</div>';
        $vlcBody= $vlcBody.'<hr align="center" width="99%">';
        $vlcBody= $vlcBody.'<hr align="center" width="99%">';
        $vlcBody= $vlcBody.'<p>';
        $vlcBody= $vlcBody.'<H4>Gracias por su compra</H4>';
        $vlcBody = $vlcBody.'Se le recuerda que los pedidos seran entregados los dias viernes,sabados y domingos, uno de nuestros agentes se pondra en contacto con usted.';
        $vlcBody = $vlcBody.'</p>';        
        $vlcBody= $vlcBody.'</div>';

        //crea clase de notificacion 
        $vloNotificacion = new Notificacion();
        //Obtiene el resultado de la notificacion
        $vlcCorreoInterno = 'pedidos@verfrutaexpress.com';
       $vlbSeNotifico =  $vloNotificacion->NotificarPedidoPorCorreo($vlcBody, $vlcEmail, $vlcCorreoInterno, $vlcIDPedido);

       if($vlbSeNotifico)
       {
            $vloCarrito->destroy();
            $vloObjeto = (object) array('codigo'=>'0', 'mensaje'=>'Puedes revisar tú correo electrónico, allí encontrarás un mensaje de nuestra parte.', 
                'Tipo' => 'success', 'Titulo' => 'Pedido enviado satisfactoriamente', 'Boton' => 'ok');
            
       }else
       {
           $vloObjeto = (object) array('codigo'=>'1', 'mensaje'=>'Hubo un error mientras se intentaba enviar el pedido, intenta nuevamente o ponte en contacto con nosotros.', 
                'Tipo' => 'error', 'Titulo' => 'Error.!', 'Boton' => 'ok');
       }
    }else 
    {
        $vloObjeto = (object) array('codigo'=>'2', 'mensaje'=>'Hubo un error mientras se intentaba enviar el pedido, intenta nuevamente o ponte en contacto con nosotros.', 
                'Tipo' => 'error', 'Titulo' => 'Error.!', 'Boton' => 'ok');
    }
}else
{
    $vloObjeto = (object) array('codigo'=>'3', 'mensaje'=>'Debes agregar al menos un producto, una vez lo hayas seleccionado puedes enviar el pedido.', 
                'Tipo' => 'warning', 'Titulo' => 'Alerta', 'Boton' => 'ok');
    
}    
} catch (ErrorException $ex){
    $vloObjeto = (object) array('codigo'=>'-2', 'mensaje'=>'Hubo un error, trata de enviar tu pedido nuevamente', 
                'Tipo' => 'error', 'Titulo' => 'Error enviando el pedido', 'Boton' => 'ok');
}

echo json_encode($vloObjeto);




