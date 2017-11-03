<?php
//Archivos a incluir
include 'AD.php';

    class Productos
    {
        var $ERROR_MESSAGE   = "Ocurrio un error, lo lamentamos.!,favor noticarlo al siguiente correo electronico: soporte@verfrutaexpress.com";
        //Constructor
        function __construct(){}

        public function Catalogo($pvbActivos)
        {
            global $ERROR_MESSAGE;
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

                echo $ERROR_MESSAGE;

            }

        }


        public function BuscarProductos($pvcbuscar)
        {
            global $ERROR_MESSAGE;
            try {

                $AD = new AD();

                $vloConexion = $AD->ObtenerConexion();

                $param = mysqli_real_escape_string($vloConexion, $pvcbuscar);

                $vlcScript = "SELECT * "
                        . "     FROM fve_prod "
                        . "    WHERE prod_nom like '%".$param."%'"
                        . "      AND prod_sts = 1";
                $resultado = mysqli_query($vloConexion, $vlcScript);
                $vloConexion->close();
                return $resultado;
            } catch (Exception $exc) {
                echo $ERROR_MESSAGE;
            }
        }

        public function ProductosEnPromocion(){
            global $ERROR_MESSAGE;
            try{
                $AccesoAdatos = new AD();
                $vlcScript = "SELECT * "
                        . "     FROM fve_prod "
                        . "    WHERE prod_prm = '1' "
                        . "      AND prod_sts = '1' ";
                 return $AccesoAdatos->RetornarResultado($vlcScript) ;
            } catch (Exception $ex) {
                 echo $ERROR_MESSAGE;
            }
        }

        public function ObtenerCategorias()
        {
            global $ERROR_MESSAGE;
            try{
                $AccesoAdatos = new AD();
                $vlcScript = "SELECT * "
                        . "     FROM fve_tip_prod ";
                 return $AccesoAdatos->RetornarResultado($vlcScript) ;
            } catch (Exception $ex) {
                 echo $ERROR_MESSAGE;
            }
        }

        public function ProductosPorCategoria($pvnCategoria)
        {
            global $ERROR_MESSAGE;
             try{
                $AccesoAdatos = new AD();
                $vlcScript = "SELECT * "
                        . "     FROM fve_prod "
                        . "    WHERE prod_sts = 1"
                        . "      AND tip_prod_id= '".$pvnCategoria."';";
                 return $AccesoAdatos->RetornarResultado($vlcScript) ;
            } catch (Exception $ex) {
                 echo $ERROR_MESSAGE;
            }
        }

        public function ObtenerDetallesArt($pvcID)
        {
            global $ERROR_MESSAGE;
            try{
                $AccesoDatos = new AD();
                $vlcScript = "SELECT * FROM fve_prod WHERE prod_id ="."'".$pvcID."'";
                return $AccesoDatos->RetornarResultado($vlcScript);
            }catch(Exception $e){echo $ERROR_MESSAGE; }
        }
    }
