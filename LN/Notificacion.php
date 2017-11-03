<?php
if(!class_exists('Carrito')){
    include 'Carrito.php';
}
require_once('../model/email/class.phpmailer.php');
require_once('../model/ADParam.php');
class Notificacion
{
    //Contructor
    function __construct(){}

    function NotificarPedidoPorCorreo($pvcMensaje,$pvcCorreoCliente,$pvcIDPedido)
    {
        try
        {
            //Create the ADParams object
            $vloParams = new ADParam();
            //Get the send mauil
            $vlcCorreoSaliente = $vloParams->getParam('CORREO_SALIENTE');
            $vlcPWD = $vloParams->getParam('PWD_CORREO');
            $pvcCorreoPedidos = $vloParams->getParam('REM_CORRES');
            $mail = new PHPMailer();
            //indico a la clase que use SMTP
            $mail->IsSMTP();
            //Debo de hacer autenticación SMTP
            $mail->SMTPAuth = true;
            $mail->SMTPSecure= $vloParams->getParam('SMTP_SEG');
            //indico el servidor de Gmail para SMTP
            $mail->Host = $vloParams->getParam('SMTP');
            //indico el puerto que usa Gmail
            $mail->Port= $vloParams->getParam('PORT_SMTP');
            //indico un usuario / clave de un usuario de gmail
            $mail->Username = $vlcCorreoSaliente;
            $mail->Password= $vlcPWD;
            $mail->SetFrom($vlcCorreoSaliente, 'Pedidos Verfruta express');
            //Se lo envia a la persona que se encarga de los pedidos
            $mail->AddBCC($pvcCorreoPedidos,"Pedidos Verfruta Express");
            $mail->Subject = "Solicitud de Pedido ".$pvcIDPedido;
            $mail->MsgHTML($pvcMensaje);
            //Se lo envia al cliente para que sepa su compra.
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
