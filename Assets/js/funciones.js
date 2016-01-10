
$("document").ready(function(){
    
    $(".btnComprar").click(pAgregarProd);
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
    
});

function PLimpiarCampos()
{
    $("#txtNomCli").val("");
    $("#txtEmail").val("");
    $("#txtTel").val("");
    $("#txtTelAux").val("");
    $("#txtDir").val("");
}

function pAgregarProd()
{
    var vlnCant = ObtenerCant($(this).val());
    if(vlnCant.length > 0)
    {
        $("#carrito").load("LN/Almacen.php?id="+$(this).val()+"&cant="+vlnCant);
        //alert("debe guardar");
    }else
    {
        alert("Indique Cantidad");
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
    return vlnElementoCorrecto.value;
}

