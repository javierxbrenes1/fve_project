<?php
if(!class_exists('Carrito')){ 
    include 'Carrito.php'; 
}
include '../model/email/class.phpmailer.php';
class Notificacion
{
    //Contructor
    function Notificacion(){}
    
    function NotificarPedidoPorCorreo($pvcMensaje)
    {
        try
        {
            $vloMail = new PHPMailer();
            
        }catch(Exception $ex)
        {
            
        }
    }
    
    
}

