
$("document").ready(function(){
     
   
     $(".Back").hide();
    
     MostrarMenu();
    
    //document.oncontextmenu = function() {return false;} 
    
    $("#FormPedido").submit(function(e){
        $('#modalEnvio').modal('hide');
        BloquearPantalla();
        $.ajax({
                    type: "POST",
                    url: "LN/Pedidos.php",
                    data: $("#FormPedido").serialize(),
                    error: function(error){
                        DesbloquearPantalla();
                        Mensaje("Error.!","","Error al enviar el pedido: "+error,"ok");
                    },
                    success: function(data)
                    {
                        if(data == "0")
                        {
                            
                            PLimpiarCampos();
                            Mensaje("Pedido enviado satisfactoriamente",
                            "Puedes revisar tú correo electronico, allí encontraras un mensaje de nuestra parte.",
                            "success","ok");
                            setTimeout(function(){location.reload();},3000);
                       }
                       else if(data == "1" || data == "2")
                       {
                            Mensaje("Error.!","Hubo un error mientras se intentaba enviar el pedido, intenta nuevamente o ponte en contacto con nosotros.","error","ok");
                       }
                       else if(data="3")
                       {
                           Mensaje("Alerta","Debes agregar al menos un producto, una vez lo hayas seleccionado puedes enviar el pedido.",
                                   "warning","ok");
                       }
                       DesbloquearPantalla();
                    }
                    
                });
        e.preventDefault();
    });
    
    $("#BuscarProd").submit(function(e)
    {
        BloquearPantalla();
        var vlcParametro = $("#txtParam").val();
        $("#pnlProdCategoria").load("LN/Categoria.php?id="+vlcParametro);
        $("#lblCatProd").text("Resultado de la búsqueda");
        setTimeout(function(){
               var pnlbloqueo = $(".block-loading");
               pnlbloqueo.remove();
           },2200); 
        e.preventDefault();
    });
    
    $("#lstCat").on("click","li",function(){
       BloquearPantalla();
       var id = $(this).val();
       switch(id){
           case 0:
               $("#lblCatProd").text("Ofertas");
               break;
           case 1:
               $("#lblCatProd").text("Vegetales");
               break;
           case 3:
               $("#lblCatProd").text("Mini-Vegetales");
               break;
           case 2:
               $("#lblCatProd").text("Frutas");
               break;
           case 4:
               $("#lblCatProd").text("Otros Productos");
               break;
       }
       $("#pnlProdCategoria").load("LN/Categoria.php?id="+id,function(){  $('.decimal').numeric();    // números
                                                                          $('.decimal').numeric('.'); // números con separador decimal
                                                                          });
                                                                          
           setTimeout(function(){
               var pnlbloqueo = $(".block-loading");
               pnlbloqueo.remove();
           },2500);  
            
          $(this).scrollTop(0);  
       
    });
    
    $(".btnCarrito").click(function(){
        $("#lblCatProd").text("Productos Seleccionados");
        $("#pnlProdCategoria").load("LN/MostrarCarrito.php");
    });
    
    $('.navbar-nav').on('click', function(){ 
        if($('.navbar-header .navbar-toggle').css('display') !='none'){
            $(".navbar-header .navbar-toggle").trigger( "click" );
        }
    });
    
    $('.decimal').numeric();    // números
    $('.decimal').numeric('.');
    
     // Define manejador de scroll para mostrar la barra de menú
    $(window).scroll(function () {
        MostrarMenu();
    });
    
    $(".CerrarModal").click(function(){
        $('#modalEnvio').modal('hide');
    });
 });

$(window).on('beforeunload', function(){
  $(window).scrollTop(0);
});

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
    var vlotxtCant = ObtenerCant(pvnID);
   
    if(vlotxtCant.value.length > 0 && parseInt(vlotxtCant.value) != 0)
    {
        $(".btnCarrito").load("LN/Almacen.php?id="+pvnID+"&cant="+vlotxtCant.value);
        vlotxtCant.value = "";
    }else
    {
        vlotxtCant.focus();
    }
}

function Mensaje(pvcTitulo,pvcTexto,pvcTipo,pvcBoton){
    swal({
        title: pvcTitulo,
        text:pvcTexto,
        type: pvcTipo,
        confirmButtonText: pvcBoton
    });
}

function BloquearPantalla()
{
    var form = $("#wrapper");
    var block = $('<div class="block-loading"/>');
    form.append(block);
}

function DesbloquearPantalla()
{
    var pnlbloqueo = $(".block-loading");
    pnlbloqueo.remove();
}

function pMostrarCarrito()
{
    $("#pnlProdCategoria").load("LN/MostrarCarrito.php");
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

function ElimProd(vloIdProd,e)
{
    $.ajax({
        type: "POST",
        url: "LN/MantCarrito.php",
        data: {id: vloIdProd},
        success: function(data)
        {
            //alert(data);
            var array = data.split("|");
                //alert(array[0].substring(0,(array[0].length)-1));
                $("#pnlProdCategoria").html(array[0].substring(0,(array[0].length)-1));
                var vlnTexto = '<i class="fa fa-shopping-cart"></i>  Carrito';
                if(array[1] != "0"){
                   vlnTexto = vlnTexto + " (" + array[1] + ")"; 
                }

                $(".btnCarrito").html(vlnTexto);
        }

    });
    e.preventDefault();
    //$("#pnlProdCategoria").load("LN/MantCarrito.php?id="+vloIdProd);
}

function MostrarMenu()
{
    // Obtiene el alto del scroll
    var vlnScroll = $(this).scrollTop();
    // Si el scroll es mayor a 100
    if (vlnScroll > 100)
    // Muestra barra de menú
        $(".Back").fadeIn();
    else
    // Oculta la barra de menú
        $(".Back").fadeOut();
}

function VerOfertas()
{
    BloquearPantalla();
    $("#lblCatProd").text("Ofertas");
    $("#pnlProdCategoria").load("LN/Categoria.php?id=0",function(){  $('.decimal').numeric();    // números
                                                                          $('.decimal').numeric('.'); // números con separador decimal
                                                                          });
    setTimeout(function(){
               var pnlbloqueo = $(".block-loading");
               pnlbloqueo.remove();
           },2200);       
           
    $(this).scrollTop(0);         
}
        