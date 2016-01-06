<?php
if(!class_exists('AD')){ 
    include 'AD.php'; 
}

class Zonas {
    function Zonas(){}
    
    public function ObtenerZonas()
    {
        try {
            //Crea instancia de Acceso a datos
            $AccesoDatos = new AD();
            //Crea el script a ejecutar
            $vlcScript = "SELECT * FROM fve_zon";
            //retornar datos
            return $AccesoDatos->RetornarResultado($vlcScript);
        } catch (Exception $exc) {
            //Lanza la excepcion
            echo $exc->getTraceAsString();
        }
    }
}
