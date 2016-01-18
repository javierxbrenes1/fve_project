<?php
//Archivos a incluir
include 'AD.php';

    class Productos
    {
        //Constructor
        function __construct(){}
        
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
        
        public function ProductosEnPromocion(){
            try{
                $AccesoAdatos = new AD();
                $vlcScript = "SELECT * "
                        . "     FROM fve_prod "
                        . "    WHERE prod_prm = 1 "
                        . "      AND prod_sts = 1 ";
                 return $AccesoAdatos->RetornarResultado($vlcScript) ;
            } catch (Exception $ex) {

            }
        }
        
        public function ObtenerCategorias()
        {
            try{
                $AccesoAdatos = new AD();
                $vlcScript = "SELECT * "
                        . "     FROM fve_tip_prod ";
                 return $AccesoAdatos->RetornarResultado($vlcScript) ;
            } catch (Exception $ex) {

            }
        }
        
        public function ProductosPorCategoria($pvnCategoria)
        {
             try{
                $AccesoAdatos = new AD();
                $vlcScript = "SELECT * "
                        . "     FROM fve_prod "
                        . "    WHERE prod_sts = 1"
                        . "      AND tip_prod_id= '".$pvnCategoria."';";
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
