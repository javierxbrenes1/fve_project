<?php
    class AD
    {
        //Propiedades del objeto
        var $server;
	var $username;
	var $pass;
	var $database;
        var $vcoConexion;
        var $vcoSelBD;
        //constructor
       function AD(){
           $server = "localhost";
           $username = "root";
           $pass = "";
           $database = "DB_FVE";
           $vcoConexion = mysql_connect($server,$username,$pass) or die('Error en la conexion');
           $vcoSelBD = mysql_select_db($database,$vcoConexion) or die ('Error al conectar a la bd');
       }
       
       //Funciones para ejecutar comandos sin esperar una respuesta 
       public function EjecutarComando($pvoComando)
       {
           try{
               
               //define el script q debe ejecutar
                $vloScript = mysql_query($pvoComando);
                //Returna el total del lineas afectadas
                return mysql_affected_rows($vloScript);
           }catch(Exception $ex){
            
           }
       }
       
       public function RetornarResultado($pvoComando)
       {
           try{
                //Define el query que ejecutara
                $vloScript = mysql_query($pvoComando);
                
                if(!$vloScript)
                {
                    die("Error running $vloScript: " . mysql_error());
                }
                mysql_close();
                //retorna un arreglo con el resultado
                return $vloScript;
           }catch(Exception $ex)
           {
               
           }
            
       }
    } 
