
$("document").ready(function(){
     
   
     $(".Back").hide();
    
     MostrarMenu();
    
    document.oncontextmenu = function() {return false;} 
    
    $("#FormPedido").submit(function(e){
        $('#modalEnvio').modal('hide');
        BloquearPantalla();
        $.ajax({
                    type: "GET",
                    url: "LN/Pedidos.php",
                    data: $("#FormPedido").serialize(),
                    error: function(error){
                        DesbloquearPantalla();
                        Mensaje("Error.!","","Error al enviar el pedido: "+error,"ok");
                    },
                    success: function(data)
                    {
                        if(testJSON(data))
                        {
                            vloObj = JSON.parse(data);
                            if(vloObj.codigo === "0"){
                                PLimpiarCampos();
                                Mensaje(vloObj.Titulo, vloObj.mensaje, vloObj.Tipo, vloObj.Boton, function(){location.reload();});
                            }else{
                                Mensaje(vloObj.Titulo, vloObj.mensaje, vloObj.Tipo, vloObj.Boton);
                            }
                        }else{
                            Mensaje("Error", 
                            "Un error ocurrio durante el envio del pedido, vuelte a intentarlo o contacta con nosotros.",
                            "error", "ok");
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
        $("#lblCatProd").text("Resultado de la búsqueda");
        $("#pnlProdCategoria").load("LN/Categoria.php?id="+vlcParametro, function(){
             var pnlbloqueo = $(".block-loading");
             pnlbloqueo.remove();
             
        });
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
       $("#pnlProdCategoria").load("LN/Categoria.php?id="+id,
       function(){  $('.decimal').numeric();    // números
                    $('.decimal').numeric('.'); // números con separador decimal
                    var pnlbloqueo = $(".block-loading");
                    pnlbloqueo.remove();
                });
                                                                         
           /*setTimeout(function(){
               var pnlbloqueo = $(".block-loading");
               pnlbloqueo.remove();
           },2500);  
            */
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

function testJSON(text){
    try{
        JSON.parse(text);
        return true;
    }
    catch (error){
        return false;
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
    var vlotxtCant = $(".txtCantidad", '#' + pvnID);
    var vlotxtObs = $(".txtObservacion", '#' + pvnID);
    if(vlotxtCant !== undefined )
    {
        if(vlotxtCant.val().length > 0 && parseFloat(vlotxtCant.val()) !== 0)
        {
            var vloTextObservacion = (vlotxtObs !== undefined) ? vlotxtObs.val() : "";
            
            $.ajax({
                url: 'LN/Almacen.php',
                type:"POST",
                data: {id: pvnID, cant: vlotxtCant.val(), obs: vloTextObservacion},
                success: function(data){
                   $(".btnCarrito").html(data);
                   vlotxtCant.val("");
                   vlotxtObs.val("");
                },
                error: function(){
                    //Mensaje
                }
            });
            
        }else
        {
            vlotxtCant.focus();
        }
    }
}

function Mensaje(pvcTitulo,pvcTexto,pvcTipo,pvcBoton, pvcFuncion = function(){}){
    swal({
        title: pvcTitulo,
        text:pvcTexto,
        icon: pvcTipo,
        confirmButtonText: pvcBoton
    }).then(pvcFuncion);
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

function ElimProd(vloIdProd)
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
        