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
              $params = parse_ini_file("BD.ini");

               $Host = $params['Host'];
               $User = $params['User'];
               $Pass = $params['Pass'];
                 $BD = $params['BD'];

            $vloConexion = new mysqli($Host,$User,$Pass, $BD);

            if ($vloConexion->connect_errno > 0) {
                     die("Falló la conexión: [". $vloConexion->connect_error . "]");
            }
            /* cambiar el conjunto de caracteres a utf8 */
            $vloConexion->set_charset("utf8");

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
