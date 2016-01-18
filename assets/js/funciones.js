
$("document").ready(function(){
    
    //$(".btnComprar").click(pAgregarProd);
    $("#FormPedido").submit(function(e){
        $.ajax({
                    type: "POST",
                    url: "LN/Pedidos.php",
                    data: $("#FormPedido").serialize(),
                    success: function(data)
                    {
                        
                        $('#modalEnvio').modal('hide');
                        PLimpiarCampos();
                        alert(data);
                        location.reload();
                    }
                    
                });
        e.preventDefault();
    });
    $(".btnCarrito").click(function () {
        
        var vlnAncho = 300;
        var vlnVelocidad = 500;
        var vlcEasing = "easeInOutCubic"
        var pnlCarrito = $("#pnlCarrito");
        var pnlPagina = $("#pnlPagina");

        if (($("#pnlPagina").position().left == 0)) {
            //abrir
            pnlCarrito.animate({ right: "+=300" }, vlnVelocidad, vlcEasing, function () { });
            pnlPagina.animate({ left: "-=300" }, vlnVelocidad, vlcEasing, function () { });
        }
        else {
            //cerrar
            pnlCarrito.animate({ right: "-=300" }, vlnVelocidad, vlcEasing, function () { });
            pnlPagina.animate({ left: "+=300" }, vlnVelocidad, vlcEasing, function () { });
        }
    });
    
    
    $("#lstCat").on("click","li",function(){
       var id = $(this).val();
       $("#pnlProdCategoria").load("LN/Categoria.php?id="+id);
    });
    
});




function VerOcultarCarrito()
{
        var vlnAncho = 300;
        var vlnVelocidad = 500;
        var vlcEasing = "easeInOutCubic"
        var pnlCarrito = $("#pnlCarrito");
        var pnlPagina = $("#pnlPagina");

        if (($("#pnlPagina").position().left == 0)) {
            //abrir
            pnlCarrito.animate({ right: "+=300" }, vlnVelocidad, vlcEasing, function () { });
            pnlPagina.animate({ left: "-=300" }, vlnVelocidad, vlcEasing, function () { });
        }
        else {
            //cerrar
            pnlCarrito.animate({ right: "-=300" }, vlnVelocidad, vlcEasing, function () { });
            pnlPagina.animate({ left: "+=300" }, vlnVelocidad, vlcEasing, function () { });
        }
}
function PLimpiarCampos()
{
    $("#txtNomCli").val("");
    $("#txtEmail").val("");
    $("#txtTel").val("");
    $("#txtTelAux").val("");
    $("#txtDir").val("");
}

function pAgregarProd(pvnID)
{
    var vlntxtCant = ObtenerCant(pvnID);
   
    if(vlntxtCant.value.length > 0)
    {
        $("#carrito").load("LN/Almacen.php?id="+pvnID+"&cant="+vlntxtCant.value);
       
        $("html, body").animate({scrollTop:"0px"});
        // VerOcultarCarrito();
    }else
    {
        //alert("Indique Cantidad");
        vlntxtCant.focus();
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
            vlnElementoCorrecto = vloElementos[vlnI];
            break;
        }
    }
    return vlnElementoCorrecto;
}

