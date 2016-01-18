
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/estilos.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/funciones.js" type="text/javascript"></script>
        <script src="assets/js/jquery.meanmenu.js"></script>
	<script src="assets/js/bootstrap-select.js"></script>
    <style>
        #productos
        {
            width: 100%;
            height: 100%;
            display: inline-block;
            position: relative;
            background-color: #090;
            
        }
        
        #carrito
        {
            width: 100px;
            height: 100px;
            position: absolute;
            right: -100px;
            top:50px;
            background-color: #269abc;
        }
        #BarraSuperior{
            position: fixed;
            background-color: #898989;
            width: 100%;
            height: 50px;
        }
        #Detalle
        {
            width: 50px;
            height: 2000px;
            background-color: #FFFF00;
        }
    </style>
    </head>
   
    <body style="overflow-x:hidden;">
        <div class="container-fluid" style="padding:0;">   
            <div class="col-md-12" style="padding:0;">
                <div id="productos">

                <div id="BarraSuperior">
                    <button onclick="xxx()">mostrar</button>
                    <button onclick="x()">ocultar</button>
                </div>

                <div id="Detalle">

                </div>
            </div>
        </div>      
        <div id="carrito">
            
        </div>
        </div>      
    </body>
    <script>
        $("document").Ready(function(){
            $("document").on("scroll",function(){
                var vlnScroll = $(this).scrollTop();
                 var alto = $(window).height();
                $("#carrito").css("top",(vlnScroll+(alto/2))+"px");  
            });
        });
        function xxx()
        {
            var vlnScroll = $(this).scrollTop();
            var derecho = $("#carrito").css("right");
            var alto = $(window).height();
        if(derecho === '-100px'){
            $("#carrito").css("top",(vlnScroll+(alto/2))+"px");    
            $("#carrito").animate({ right: "+=100" }, 500, "easeInOutCubic", function () { });
            //$("#carrito").css("right","0px");
        }else
        {
           $("#carrito").animate({ right: "-=100" }, 500, "easeInOutCubic", function () { }); 
        }
        }
        function x()
        {
            //$("#carrito").css("top","100px");
            //$("#carrito").css("right","-100px");
            $("#carrito").animate({ right: "-=100" }, 500, "easeInOutCubic", function () { });
           
        }
    </script>
</html>
