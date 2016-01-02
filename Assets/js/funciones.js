$("document").ready(function(){
    $(".btnComprar").click(anade);
    $("#carrito").hide();
    
});

function mostrarCarrito()
{
    $("#carrito").show();
}

function OcultarCarrito()
{
    $("#carrito").hide();
}
function anade()
{
    var cant = ObtenerCant($(this).val());
    if(cant.length > 0){
    $("#carrito").load("LN/Almacen.php?id="+$(this).val()+"&cant="+cant);
    $("#carrito").show();}else {alert("error");}
    
}

function LimpiarCarrito()
{
    $("#carrito").load("LN/Almacen.php?id=-1&cant=-1");
}

function ObtenerCant(vloIdProd)
{
    var Elementos = $(".txtCantidad");
    var tot = Elementos.length;
    var elementoCorrecto;
    for(var i = 0;i<=tot;i++)
    {
        if(Elementos[i].id == vloIdProd)
        {
            elementoCorrecto = Elementos[i];
            break;
        }
    }
    return elementoCorrecto.value;
    
}

