<?php
if(!class_exists('Carrito')){ 
    include 'Carrito.php'; 
}
require_once('../model/email/class.phpmailer.php');
class Notificacion
{
    //Contructor
    function __construct(){}
    
    function NotificarPedidoPorCorreo($pvcMensaje,$pvcCorreoCliente,$pvcCorreoPedidos,$pvcIDPedido)
    {
        try
        {
            
            $mail = new PHPMailer();
            //indico a la clase que use SMTP
            $mail->IsSMTP();
            //permite modo debug para ver mensajes de las cosas que van ocurriendo
            //$mail->SMTPDebug = 2;
            //Debo de hacer autenticación SMTP
            $mail->SMTPAuth = true;
            $mail->SMTPSecure= "ssl";
            //indico el servidor de Gmail para SMTP
            $mail->Host = "smtp.gmail.com";
            //indico el puerto que usa Gmail
            $mail->Port= 465;
            //indico un usuario / clave de un usuario de gmail
            $mail->Username = "verfrutaexpress@gmail.com"; //"chory521@gmail.com";
            $mail->Password= "verfrutaexpress2016";//"hardcorepunk506xxx";
            $mail->SetFrom('verfrutaexpress@gmail.com', 'Pedidos Verfruta express');
            //Se lo envia a la persona que se encarga de los pedidos
            $mail->AddBCC($pvcCorreoPedidos,"Pedidos Verfruta Express");
            $mail->AddBCC("pedidosverfrutaexpress@gmail.com","Pedidos Verfruta Express");
            $mail->Subject = "Solicitud de Pedido ".$pvcIDPedido;
            $mail->MsgHTML($pvcMensaje);
            //Se lo envia al cliente para que sepa su compra.
            //$address = $pvcCorreoCliente;
            $mail->AddAddress($pvcCorreoCliente);
            if(!$mail->Send()) {
                return false;
            } else {
                return true;
            } 
        }catch(Exception $ex)
        {
            
        }
    }
    
    
}

