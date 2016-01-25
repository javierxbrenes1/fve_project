<?php
if(!class_exists('Productos')){ 
    include '../model/Productos.php';
}
//String para contatenar el html
$ResultadoConsulta = '';
//Obtiene el id de la categoria
$vloParametro = $_GET['id'];
//Instancia de productos
$vloProductos = new Productos();
//Si el id es 0 devuelve todos los articulos con oferta
if(is_numeric($vloParametro)){
    if($vloParametro == 0){
        //Articulso con oferta
        $resultado = $vloProductos->ProductosEnPromocion();

    }else
    {
       //Articulos de la seccion definida
       $resultado = $vloProductos->ProductosPorCategoria($vloParametro);
    }
}else
{
    
    $resultado = $vloProductos->BuscarProductos($vloParametro);
}
//etiqueta para la unidad de medida
$lblUnidMed = ' ';
//verificar si se devolvieron registros
$vloCantRegistros = mysql_num_rows($resultado);
if($vloCantRegistros>0){
while($vloResultado = mysql_fetch_array($resultado))
{
    $lblUnidMed = ' '.$vloResultado['prod_unit_med'].' ';
    $ResultadoConsulta = $ResultadoConsulta.'<div class="col-md-3 col-sm-4 col-xs-12 text-center Producto">';
    $ResultadoConsulta = $ResultadoConsulta.'<div class="fve-borde-beneficios">';
    $ResultadoConsulta = $ResultadoConsulta.'<div class="pnlMarco">';    
    $ResultadoConsulta = $ResultadoConsulta.'<div>';
    $ResultadoConsulta = $ResultadoConsulta.'<img class="img-responsive center-block imgProd"  src="assets/img/'.$vloResultado['prod_rut_img'].'"/>';
    $ResultadoConsulta = $ResultadoConsulta.'</div>';
    $ResultadoConsulta = $ResultadoConsulta.'<div >';
    $ResultadoConsulta = $ResultadoConsulta.'<p class="ProdNom"><strong>'.$vloResultado['prod_nom'].'</strong></p>';
    $ResultadoConsulta = $ResultadoConsulta.'</div>';
    $ResultadoConsulta = $ResultadoConsulta.'<div>';
    $ResultadoConsulta = $ResultadoConsulta.'<input type="text" class="form-control txtCantidad decimal" id="'.$vloResultado['prod_id'].'"/>';
    $ResultadoConsulta = $ResultadoConsulta.' <label class="lblKilo">'.$lblUnidMed.'</label>';
    $ResultadoConsulta = $ResultadoConsulta.'<p> <p><p class="PrecioArticulo">Precio: ₡ '.$vloResultado['prod_prc_act'].'</p>';
    $ResultadoConsulta = $ResultadoConsulta.'</div>';
    $ResultadoConsulta = $ResultadoConsulta.'<div>';
    $ResultadoConsulta = $ResultadoConsulta.'<button type="button" class="btn btn-success btnComprar" onclick="pAgregarProd('.$vloResultado['prod_id'].')" value="'.$vloResultado['prod_id'].'">';
    $ResultadoConsulta = $ResultadoConsulta.'<i class="fa fa-cart-plus"></i> Agregar';
    $ResultadoConsulta = $ResultadoConsulta.'</button>';
    $ResultadoConsulta = $ResultadoConsulta.'</div>';
    $ResultadoConsulta = $ResultadoConsulta.'</div>';
    
    if($vloResultado['prod_prm'] == 1)
    {
        $ResultadoConsulta = $ResultadoConsulta.'<div class="EnOferta"><p>oferta</p></div>';
    }
    $ResultadoConsulta = $ResultadoConsulta.'</div>';
    $ResultadoConsulta = $ResultadoConsulta.'</div>';
} 
} 
else{  
    //crea un h1 indicando que no hay articulos en promocion-->
    $ResultadoConsulta = '<h1 class="text-center">No se encontrarón productos</h1>';

}
//Devuelve el resultado
echo $ResultadoConsulta;
