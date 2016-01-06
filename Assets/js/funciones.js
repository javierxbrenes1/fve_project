
$("document").ready(function(){
    $(".btnComprar").click(pAgregarProd);
});


function pAgregarProd()
{
    var vlnCant = ObtenerCant($(this).val());
    if(vlnCant.length > 0)
    {
        $("#carrito").load("LN/Almacen.php?id="+$(this).val()+"&cant="+cant);
    }else
    {
        
    }
}


function ObtenerCant(vloIdProd)
{
    var vloElementos = $(".txtCantidad");
    var vlnTotElementos = vloElementos.length;
    var vlnElementoCorrecto;
    for(var vlnI = 0;vlnI<=vlnTotElementos;vlnI++)
    {
        if(vloElementos[vlnI].id == vloIdProd)
        {
            elementoCorrecto = vloElementos[vlnI];
            break;
        }
    }
    return vlnElementoCorrecto.value;
}
