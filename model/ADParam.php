<?php
/*
  developer: Javier Brenes
  date: 03/11/2017
  Objective: this class manages the params request.
*/
if(!class_exists('AD')){
    include 'AD.php';
}

class ADParam{
  //Constructor
  function __construct(){}

  function getParam($pvcParamCode){
  try {
      //variable
      $vloName = '';
      //Create an AD Object
      $vloAD = new AD();
      //Create the query
      $vlcQuery = "CALL ObtenerParametro('" . $pvcParamCode . "')";
      //get the result from AD instance
      $vloResultado = $vloAD->RetornarResultado($vlcQuery);
      //validate if We got any row into the result variable
      if($vloResultado->num_rows > 0){
        while($vloFila  = mysqli_fetch_array($vloResultado))
        {
          $vloName = $vloFila['param_val'];
        }
      }
      return $vloName;
    } catch (Exception $e) {
        return '';
    }
  }
}

 ?>
