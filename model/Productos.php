<?php
//Archivos a incluir
include 'AD.php';

    class Productos
    {
        //Constructor
        function Productos(){}
        
        public function Catalogo($pvbActivos)
        {
            
            try{
                $AccesoAdatos = new AD();
                $vlcScript = "SELECT * "
                        . "     FROM fve_prod ";
                if($pvbActivos)
                {
                    $vlcScript = $vlcScript." WHERE prod_sts = '1';";
                }
                
                return $AccesoAdatos->RetornarResultado($vlcScript) ;
            } catch (Exception $ex) {

            }
            
        }
        
        public function ObtenerDetallesArt($pvcID)
        {
            try{
                $AccesoDatos = new AD();
                $vlcScript = "SELECT * FROM fve_prod WHERE prod_id ="."'".$pvcID."'";
                return $AccesoDatos->RetornarResultado($vlcScript);
            }catch(Exception $e){}
        }
    }
