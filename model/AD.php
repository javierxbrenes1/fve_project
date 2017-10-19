<?php
    class AD
    {
        
        //constructor
       function __construct() {
          
       }
       
       function __destruct()
       {
           
       }
       //Funciones para ejecutar comandos sin esperar una respuesta 
       public function EjecutarComando($pvoComando)
       {
           try{
               
               $vloConexion = $this->ObtenerConexion();
               /* comprobar la conexión */
               if(!$vloScript = $vloConexion->query($pvoComando))
                {
                   die("Falló la consulta: [" . $vloConexion->error . "]");
                }
                $vloConexion->close();
           }catch(Exception $ex){
            
           }
       }
       
       public function ObtenerConexion()
       {
           try
           {
               $Host = "localhost";//"verfrutaexpress.com";
               $User = "root";//"verfruta_AppUser";//"verfruta_usuario";//"verfruta_AppUser";
               $Pass = "";//"Pfgh%3209.790VerFruOn12";//'^b!0ediS$fbN';//"Pfgh%3209.790VerFruOn12";//^b!0ediS$fbN
                 $BD = "verfruta_Application";//"verfruta_Desarrollo"; //"verfruta_Application";
                 
            $vloConexion = new mysqli($Host,$User,$Pass, $BD);

            if ($vloConexion->connect_errno > 0) {
                     die("Falló la conexión: [". $vloConexion->connect_error . "]");
            }

            return $vloConexion;
           
           }catch(Exception $ex){
               echo "Error con la conexión";
           }
       }
       
       public function RetornarResultado($pvoComando)
       {
           try{
               
               $vloConexion = $this->ObtenerConexion();
               /* comprobar la conexión */
               if(!$vloScript = $vloConexion->query($pvoComando))
                {
                   die("Falló la consulta: [" . $vloConexion->error . "]");
                }
                //Cierra la conexion
                $vloConexion->close();
                //retorna un arreglo con el resultado
                return $vloScript;
           }catch(Exception $ex)
           {
               
           }
            
       }
    } 
